<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Permission ;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Contracts\Role as RoleContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Permission as PermissionContract;

class AppServiceProvider extends ServiceProvider
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

        $this->registerModelBindings();


        if (\Schema::hasTable('mail_settings')) {
            $mail_settings = \App\Models\MailSetting::first();
            if($mail_settings){
                $data = [
                    'driver'            => $mail_settings->mail_transport,
                    'host'              => $mail_settings->mail_host,
                    'port'              => $mail_settings->mail_port,
                    'encryption'        => $mail_settings->mail_encryption,
                    'username'          => $mail_settings->mail_username,
                    'password'          => $mail_settings->mail_password,
                    'from'              => [
                        'address'=> $mail_settings->mail_from_address,
                        'name'   => $mail_settings->mail_from_name
                    ]
                ];
                \Config::set('mail',$data);
            }
        }


        Paginator::useBootstrapFive();

        Blade::if('customer', function () {
           if(auth()->check()){
                if(! auth()->user()->is_admin){
                    return true;
                }
           }
        });


        View::composer(['admin.authorization.*','admin.users.admin'], function($view){
            $view->with([
                'roles' => Role::all(),
                'permissions' => Permission::all(),
            ]);
        });
        
    }



    protected function registerModelBindings()
    {
        $this->app->bind(PermissionContract::class, Permission::class);
        $this->app->bind(RoleContract::class, Role::class);
    }


}
