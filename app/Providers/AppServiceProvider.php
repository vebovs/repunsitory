<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        //\URL::forceScheme('https'); //For deployment using https
        //Schema::defaultStringLength(191);

        //\Illuminate\Pagination\AbstractPaginator::currentPathResolver(function () {
            /** @var \Illuminate\Routing\UrlGenerator $url */
           /*$url = app('url');
           return $url->current();
        });*/
    }
}
