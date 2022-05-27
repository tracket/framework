<?php

use Tracket\Permissions\Models\Permission;
use Tracket\Permissions\Models\Role;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $superadmin = Role::create([
            'name' => Role::ROLE_SUPER_ADMIN,
            'display_name' => 'Super Admin',
            'description' => 'Use has full access to all features',
        ]);

        $hiringManager = Role::create([
            'name' => Role::ROLE_HIRING_MANAGER,
            'display_name' => 'Hiring Manager',
            'description' => 'User can manage their company and it\'s job listings',
        ]);

        $developer = Role::create([
            'name' => Role::ROLE_DEVELOPER,
            'display_name' => 'Developer',
            'description' => 'User can apply to jobs',
        ]);

        // TODO: Add permissions for developer and hiring manager roles

        $adminPortalView = Permission::create([
            'name'         => Permission::ADMIN_PORTAL_VIEW,
            'display_name' => 'admin::portal::view',
            'description'  => 'Access the admin portal',
        ]);

        $adminCompanyCreate = Permission::create([
            'name'         => Permission::ADMIN_COMPANIES_CREATE,
            'display_name' => 'admin::companies::create',
            'description'  => 'Create new companies via the admin portal',
        ]);

        $adminCompanyView = Permission::create([
            'name'         => Permission::ADMIN_COMPANIES_VIEW,
            'display_name' => 'admin::companies::view',
            'description'  => 'View companies via the admin portal',
        ]);

        $adminCompanyEdit = Permission::create([
            'name'         => Permission::ADMIN_COMPANIES_EDIT,
            'display_name' => 'admin::companies::edit',
            'description'  => 'Edit companies via the admin portal',
        ]);

        $adminCompanyDelete = Permission::create([
            'name'         => Permission::ADMIN_COMPANIES_DELETE,
            'display_name' => 'admin::companies::delete',
            'description'  => 'Delete companies via the admin portal',
        ]);

        $adminJobCreate = Permission::create([
            'name'         => Permission::ADMIN_JOBS_CREATE,
            'display_name' => 'admin::jobs::create',
            'description'  => 'Create new jobs via the admin',
        ]);

        $adminJobView = Permission::create([
            'name'         => Permission::ADMIN_JOBS_VIEW,
            'display_name' => 'admin::jobs::view',
            'description'  => 'View jobs via the admin portal',
        ]);

        $adminJobEdit = Permission::create([
            'name'         => Permission::ADMIN_JOBS_EDIT,
            'display_name' => 'admin::jobs::edit',
            'description'  => 'Edit jobs via the admin portal',
        ]);

        $adminJobDelete = Permission::create([
            'name'         => Permission::ADMIN_JOBS_DELETE,
            'display_name' => 'admin::jobs::delete',
            'description'  => 'Delete jobs via the admin portal',
        ]);

        $adminPageCreate = Permission::create([
            'name'         => Permission::ADMIN_PAGES_CREATE,
            'display_name' => 'admin::pages::create',
            'description'  => 'Create new pages via the admin',
        ]);

        $adminPageView = Permission::create([
            'name'         => Permission::ADMIN_PAGES_VIEW,
            'display_name' => 'admin::pages::view',
            'description'  => 'View pages via the admin portal',
        ]);

        $adminPageEdit = Permission::create([
            'name'         => Permission::ADMIN_PAGES_EDIT,
            'display_name' => 'admin::pages::edit',
            'description'  => 'Edit pages via the admin portal',
        ]);

        $adminPageDelete = Permission::create([
            'name'         => Permission::ADMIN_PAGES_DELETE,
            'display_name' => 'admin::pages::delete',
            'description'  => 'Delete pages via the admin portal',
        ]);

        $adminThemesUpload = Permission::create([
            'name'         => Permission::ADMIN_THEMES_UPLOAD,
            'display_name' => 'admin::themes::upload',
            'description'  => 'Upload themes via the admin portal',
        ]);

        $adminThemesView = Permission::create([
            'name'         => Permission::ADMIN_THEMES_VIEW,
            'display_name' => 'admin::themes::view',
            'description'  => 'View themes via the admin portal',
        ]);

        $adminThemesEdit = Permission::create([
            'name'         => Permission::ADMIN_THEMES_EDIT,
            'display_name' => 'admin::themes::edit',
            'description'  => 'Edit themes via the admin portal',
        ]);

        $adminThemesDelete = Permission::create([
            'name'         => Permission::ADMIN_THEMES_DELETE,
            'display_name' => 'admin::themes::delete',
            'description'  => 'Delete themes via the admin portal',
        ]);

        $adminSettingsEdit = Permission::create([
            'name'         => Permission::ADMIN_SETTINGS_EDIT,
            'display_name' => 'admin::settings::edit',
            'description'  => 'Edit settings via the admin portal',
        ]);

        $superadmin->attachPermissions([
            $adminPortalView,
            $adminCompanyCreate,
            $adminCompanyView,
            $adminCompanyEdit,
            $adminCompanyDelete,
            $adminJobCreate,
            $adminJobView,
            $adminJobEdit,
            $adminJobDelete,
            $adminPageCreate,
            $adminPageView,
            $adminPageEdit,
            $adminPageDelete,
            $adminThemesView,
            $adminThemesUpload,
            $adminThemesEdit,
            $adminThemesDelete,
            $adminSettingsEdit
        ]);

        $hiringManager->attachPermissions([
            $adminPortalView
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::query()->where('name', 'admin.portal.view')->delete();
        Permission::query()->where('name', 'admin.companies.create')->delete();
        Permission::query()->where('name', 'admin.companies.view')->delete();
        Permission::query()->where('name', 'admin.companies.edit')->delete();
        Permission::query()->where('name', 'admin.companies.delete')->delete();
        Permission::query()->where('name', 'admin.jobs.create')->delete();
        Permission::query()->where('name', 'admin.jobs.view')->delete();
        Permission::query()->where('name', 'admin.jobs.edit')->delete();
        Permission::query()->where('name', 'admin.jobs.delete')->delete();

        Role::query()->where('name', Role::ROLE_SUPER_ADMIN)->delete();
        Role::query()->where('name', Role::ROLE_HIRING_MANAGER)->delete();
        Role::query()->where('name', Role::ROLE_DEVELOPER)->delete();
    }
};
