<?php

namespace app\Providers;
use App;
use App\Test\TestFacades;
use Illuminate\Support\ServiceProvider;

class TestFacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("test", function($id){
            return new TestFacades($id); //给这个Facade返回一个代理实例。所有对Facade的调用都会被转发到该类对象下。
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
