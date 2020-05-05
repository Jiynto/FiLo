<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;

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

        //
    }



    public function registerPolicies()
    {
      Gate::define('isadmin', function ($user)
      {
        return $user->role;
      });

      Gate::define('isloggedin', function (?User $user)
      {
        return $user != null;
      });

      Gate::define('isOwner', function (?User $user, $userid)
      {
        return $user->id == $userid;
      });

    }
}
