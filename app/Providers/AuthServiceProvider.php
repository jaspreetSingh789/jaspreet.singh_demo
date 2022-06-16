<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define(ability: 'admin', fn (User $user) => $user->role->name);
        // Gate::define(ability: 'tasks_create', function(User $user) { return $user->role->name });
        Gate::define('admin', function (User $user) {
            return in_array($user->role_id, [1]);
        });

        Gate::define('subadmin', function (User $user) {
            return in_array($user->role_id, [1,2]);
        });

        Gate::define('trainer', function (User $user) {
            return in_array($user->role_id, [1,2,3]);
        });
        
    }
}
