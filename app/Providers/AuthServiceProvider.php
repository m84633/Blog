<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::resource('admin.posts', 'App\Policies\PostPolicy');
        Gate::define('tags', 'App\Policies\PostPolicy@tags');
        Gate::define('types', 'App\Policies\PostPolicy@types');
        Gate::define('usersadd', 'App\Policies\PostPolicy@usersadd');
        Gate::define('usersupdate', 'App\Policies\PostPolicy@usersupdate');
        Gate::define('usersdel', 'App\Policies\PostPolicy@usersdel');
        Gate::define('permissions', 'App\Policies\PostPolicy@permissions');
        Gate::define('roles', 'App\Policies\PostPolicy@roles');

    }
}
