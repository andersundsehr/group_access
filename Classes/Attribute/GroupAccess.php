<?php

namespace AUS\GroupAccess\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class GroupAccess
{
    /**
     * @param int[] $frontendUserGroupIds
     */
    public function __construct(public array $frontendUserGroupIds)
    {
    }
}
