<?php

namespace AUS\GroupAccess\EventListener;

use AUS\GroupAccess\Attribute\GroupAccess;
use AUS\GroupAccess\Exception\GroupAccessException;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Error\Http\UnauthorizedException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Event\Mvc\BeforeActionCallEvent;

class BeforeActionCallEventListener
{
    public function __invoke(BeforeActionCallEvent $event): void
    {
        $class = new \ReflectionClass($event->getControllerClassName());
        $classAttributes = $class->getAttributes(GroupAccess::class);
        $method = $class->getMethod($event->getActionMethodName());
        $methodAttributes = $method->getAttributes(GroupAccess::class);
        if (!$classAttributes && !$methodAttributes) {
            return;
        }

        $groupIds = $this->getCurrentUserGroupIds();

        $message = sprintf('Extbase "%s" action not allowed.', $event->getActionMethodName());
        $classDebugMessage = 'class Attribute allows: #[GroupAccess([%s])] given: %s';
        $this->validateAccess($classAttributes, $groupIds, $message, $classDebugMessage, $class->getFileName() ?: '', $class->getStartLine() - 1);

        $methodDebugMessage = 'method Attribute allows: #[GroupAccess([%s])] given: %s';
        $this->validateAccess($methodAttributes, $groupIds, $message, $methodDebugMessage, $method->getFileName() ?: '', $method->getStartLine() - 1);
    }

    /**
     * @return int[]
     */
    private function getCurrentUserGroupIds(): array
    {
        return GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('frontend.user', 'groupIds');
    }

    /**
     * @param \ReflectionAttribute<GroupAccess>[] $attributes
     * @param int[] $groupIds
     * @throws UnauthorizedException
     */
    protected function validateAccess(array $attributes, array $groupIds, string $message, string $debugMessage, string $file, int $line): void
    {
        foreach ($attributes as $attribute) {
            $groupAccess = $attribute->newInstance();
            $hasGroup = (bool)array_intersect($groupIds, $groupAccess->frontendUserGroupIds);

            if (!$hasGroup) {
                if (Environment::getContext()->isDevelopment()) {
                    $message .= "\n" . sprintf($debugMessage, implode(',', $groupAccess->frontendUserGroupIds), implode(',', $groupIds));
                }

                throw new GroupAccessException($message, $file, $line);
            }
        }
    }
}
