<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LayoutBuildTreeCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helper/Common/BuildTreeCate.php';
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
