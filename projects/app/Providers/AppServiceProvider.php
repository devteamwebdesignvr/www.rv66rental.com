<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Session;
use Illuminate\Support\Facades\View;
use App\Models\BasicSetting;

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
         Paginator::useBootstrap();
         $ar = BasicSetting::get();
         $setting_data=[];
         foreach($ar as $a){
            $setting_data[$a->name]=$a->value;
         }
         View::share('setting_data', $setting_data);
    }
}
