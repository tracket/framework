<?php

namespace Tracket\Permissions\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    const ADMIN_PORTAL_VIEW = 'admin.portal.view';

    const ADMIN_COMPANIES_CREATE = 'admin.companies.create';
    const ADMIN_COMPANIES_VIEW   = 'admin.companies.view';
    const ADMIN_COMPANIES_EDIT   = 'admin.companies.edit';
    const ADMIN_COMPANIES_DELETE = 'admin.companies.delete';

    const ADMIN_JOBS_CREATE = 'admin.jobs.create';
    const ADMIN_JOBS_VIEW   = 'admin.jobs.view';
    const ADMIN_JOBS_EDIT   = 'admin.jobs.edit';
    const ADMIN_JOBS_DELETE = 'admin.jobs.delete';

    const ADMIN_PAGES_CREATE = 'admin.pages.create';
    const ADMIN_PAGES_VIEW   = 'admin.pages.view';
    const ADMIN_PAGES_EDIT   = 'admin.pages.edit';
    const ADMIN_PAGES_DELETE = 'admin.pages.delete';

    const ADMIN_THEMES_UPLOAD = 'admin.themes.upload';
    const ADMIN_THEMES_VIEW   = 'admin.themes.view';
    const ADMIN_THEMES_EDIT   = 'admin.themes.edit';
    const ADMIN_THEMES_DELETE = 'admin.themes.delete';

    const ADMIN_SETTINGS_EDIT   = 'admin.settings.edit';

    public $guarded = [];
}
