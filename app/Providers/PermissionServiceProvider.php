<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->callAfterResolving('blade.compiler', function(BladeCompiler $bladeCompiler){
            return $this->registerBladeExtensions($bladeCompiler);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->registerModelBindings();

    }


    protected function registerModelBindings()
    {
        $this->app->bind(PermissionContract::class, Permission::class);
        $this->app->bind(RoleContract::class, Role::class);
    }


    protected function registerBladeExtensions($bladeCompiler)
    {
        
        $bladeCompiler->directive('role', function($arguments){
            list($role) = explode(',', $arguments);

            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";   
        });

        $bladeCompiler->directive('elserole', function($arguments){
            list($role) = explode(',', $arguments);

            return "<?php elseif(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        $bladeCompiler->directive('endrole', function () {
            return '<?php endif; ?>';
        });

    }

    
}
