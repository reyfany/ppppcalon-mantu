<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // mendefinisikan role
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        Gate::define('isPenjual', function($user) {
            return $user->role == 'penjual';
        });

        Gate::define('isPembeli', function($user) {
            return $user->role == 'pembeli';
        });
        //
    }
}
