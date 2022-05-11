<?php

namespace TypiCMS\Modules\Locations\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Locations\Composers\SidebarViewComposer;
use TypiCMS\Modules\Locations\Facades\Locations;
use TypiCMS\Modules\Locations\Models\Location;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.locations');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['locations' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'locations');

        $this->publishes([
            __DIR__.'/../database/migrations/create_locations_table.php.stub' => getMigrationFileName('create_locations_table'),
        ], 'migrations');
        
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/locations'),
        ], 'views');

        AliasLoader::getInstance()->alias('Locations', Locations::class);


        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('locations::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('locations');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Locations', Location::class);
    }
}
