<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\ModelHelper;

/**
 * Class ModelHelperServiceProvider
 * @package App\Providers
 */
class ModelHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ModelHelper', function()
        {

            return new ModelHelper;

        });
    }

   
}
