<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\CoursePolicy;
use App\Policies\UserPolicy;
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
        Category::class => CategoryPolicy::class,
        User::class => UserPolicy::class,
        Course::class => CoursePolicy::class
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
            return in_array($user->role_id, [1, 2]);
        });

        Gate::define('trainer', function (User $user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        Gate::define('user', function (User $user) {
            return in_array($user->role_id, [4]);
        });
    }
}
