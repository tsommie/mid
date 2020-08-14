<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 *
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Contracts\Repositories\UserRepositoryInterface::class, \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Contracts\Repositories\UserProfileRepositoryInterface::class, \App\Repositories\UserProfileRepository::class);
        $this->app->bind(\App\Contracts\Repositories\OrganizationRepositoryInterface::class, \App\Repositories\OrganizationRepository::class);
        $this->app->bind(\App\Contracts\Repositories\ClientRepositoryInterface::class, \App\Repositories\ClientRepository::class);
        //:end-bindings:
    }
}