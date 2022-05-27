<?php

namespace Tracket\Permissions\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    const ROLE_SUPER_ADMIN    = 'super_admin';
    const ROLE_HIRING_MANAGER = 'hiring_manager';
    const ROLE_DEVELOPER      = 'developer';

    const ROLES = [
        self::ROLE_SUPER_ADMIN,
        self::ROLE_HIRING_MANAGER,
        self::ROLE_DEVELOPER,
    ];

    public function getName(): string
    {
        return $this->getAttribute('name');
    }
}
