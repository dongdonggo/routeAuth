<?php

namespace Dongdonggo\Routeauth;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RouteauthServiceProvider extends ServiceProvider
{
    
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        // 生成配置文件   
         $this->publishes([
                __DIR__.'/../config/code.php' => config_path('code.php'),
            ]);
         #路由
//         $this->loadRoutesFrom(__DIR__.'\admin.php');
        $this->publishes([__DIR__.'/../routes' => base_path('routes')], 'routeauth-routes');
         # 数据库文件
         $this->publishes([__DIR__.'/../migrations' => database_path('migrations')], 'routeauth-migrations');
         # Middleware
        $this->publishes([__DIR__.'/../Middleware' => app_path('Http\Middleware')], 'routeauth-Middleware');
        # Controllers
        $this->publishes([__DIR__.'/../Controllers' => app_path('Http\Controllers')], 'routeauth-Controllers');
        # Requests
        $this->publishes([__DIR__.'/../Requests' => app_path('Http\Requests')], 'routeauth-Requests');
        # provider
        $this->publishes([__DIR__.'/../Providers' => app_path('Providers')], 'routeauth-Providers');
        # tests
        $this->publishes([__DIR__.'/../tests' => base_path('tests')], 'routeauth-tests');
        # Exceptions
        $this->publishes([__DIR__.'/../Exceptions' => app_path('Exceptions')], 'routeauth-Exceptions');
        # Model
        $this->publishes([__DIR__.'/../Model' => app_path('Model')], 'routeauth-Exceptions');
        # helps
        $this->publishes([__DIR__.'/../Helps' => app_path('Helps')], 'routeauth-Exceptions');
        # config
        $this->publishes([__DIR__.'/app.php' => config_path('app.php')]);
//        $this->publishes([__DIR__.'/app.php' => config_path('routeauth.php')], 'config');
    }


    public function register()
    {
        $configPath = __DIR__ . '/app.php';
        $this->mergeConfigFrom($configPath,"app");
    }

  /*  public function boot(){
        $app = $this->app;
        $configPath = __DIR__ . '/../../../config/mslaravelsystem.php';
        $this->publishes([$configPath => $this->getConfigPath()],'config');
    }*/


//    public function register()
//    {
//        $this->mergeConfigFrom(
//            __DIR__.'\config.php', 'providers'
//        );
//    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        config(array_dot(config('admin.auth', []), 'auth.'));
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
