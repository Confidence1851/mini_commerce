<?php

namespace App\Providers;

use App\Helpers\GuestHelper;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        new GuestHelper;
        Schema::defaultStringLength("125");
        view()->composer('*',function($view){
            $view->with([
                "logo_image" => my_asset("logo.jpeg"),
                "logo_text_image" => my_asset("logo_text.png"),
                "logo_icon_image" => my_asset("logo_icon.jpeg"),
                'web_assets' => url('/').env('RESOURCE_PATH').'/web',
                'admin_assets' => url('/').env('RESOURCE_PATH').'/admin',
            ]);
        });

        view()->composer("web.layouts.includes.footer",function($view){
            $view->with([
                "product_categories" => ProductCategory::limit(4)->latest()->get(),
            ]);
        });

    }
}
