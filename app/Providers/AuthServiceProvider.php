<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('modules', function ($user, $permissionName) {
            $user = Auth::guard('web')->user();
            if ($user) {
                if($user->publish == 1) return false;
                $userCatalogue = $user->user_catalogues;

                if ($userCatalogue) {
                    $permissions = $userCatalogue->permissions;

                    if ($permissions->contains('canonical', $permissionName)) {
                        return true;
                    }
                }
            }
            return false;
        });
    }
}
