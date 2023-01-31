<?php

namespace AUS\GroupAccess\Exception;

use TYPO3\CMS\Core\Error\Http\UnauthorizedException;

class GroupAccessException extends UnauthorizedException
{
    public function __construct(string $message, protected string $file, protected int $line)
    {
        parent::__construct($message, 1675160714);
    }
}
