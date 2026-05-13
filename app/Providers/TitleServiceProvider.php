<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TitleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/page-title.php',
            'page-title'
        );
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with([
                '__pageTitleDefault' => config('page-title.default'),
                '__pageTitleSeparator' => config('page-title.separator'),
            ]);
        });
    }
}
