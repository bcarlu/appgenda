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

        /*Se crea gate para el role Administrador con el fin de definir los 
        modulos habilitados en la vista del panel de administracion*/
        Gate::define('is-admin', function ($user) {
            return $user->id_role == 1;
        });


        /*Se crea gate para el role Empleado con el fin de definir los 
        modulos habilitados en la vista del panel de administracion*/
        Gate::define('is-employee', function ($user) {
            return $user->id_role == 2;
        });
    }
}
