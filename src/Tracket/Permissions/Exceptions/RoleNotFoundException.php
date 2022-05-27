<?php

namespace Tracket\Permissions\Exceptions;

use Throwable;

class RoleNotFoundException extends \Exception
{
    public function __construct(string $roleName)
    {
        parent::__construct("Role '{$roleName}' does not exist.");
    }
}
