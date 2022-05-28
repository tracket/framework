<?php

namespace Tracket\Permissions\Commands;

use Illuminate\Console\Command;
use Tracket\Permissions\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class RoleAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:assign {userId} {roleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $user = $userRepository->getById($this->argument('userId'));
        $role = $roleRepository->getByName($this->argument('roleName'));

        $user->attachRole($role);

        $this->info("Successfully assigned user {$user->getId()} to role {$role->getName()}");
    }
}
