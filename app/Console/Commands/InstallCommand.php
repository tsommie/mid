<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup application.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Prepare database...
        $this->info('Preparing database');
        $this->call('migrate:fresh');

        // Generating roles...
        $this->createRole();

        // Create Superuser
        $this->info('Creating a superuser');
        $user = $this->createSuperUser();

        $this->info('Assigning superuser role...');
        $user->assignRole('superuser');

        $this->info('All done!');
    }

    /**
     * @return void
     */
    public function createRole()
    {
        $roles = [
            ['name' => 'superuser'],
            ['name' => 'administrator'],
            ['name' => 'client'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }

    /**
     * Create a super user
     *
     * @return User
     */
    protected function createSuperUser()
    {
        return User::create([
            'name' => env('SUPERUSER_NAME', 'Test User'),
            'email' => env('SUPERUSER_EMAIL', 'testuser@test.com'),
            'password' => Hash::make(env('SUPERUSER_PASSWORD', 'password')),
            'email_verified_at' => now()
        ]);
    }
}
