<?php

namespace TypiCMS\Modules\Locations\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Locations\Http\Controllers\AdminController;
use TypiCMS\Modules\Locations\Http\Controllers\ApiController;
use TypiCMS\Modules\Locations\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('locations')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-locations');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('locations', [AdminController::class, 'index'])->name('index-locations')->middleware('can:read locations');
            $router->get('locations/export', [AdminController::class, 'export'])->name('admin::export-locations')->middleware('can:read locations');
            $router->get('locations/create', [AdminController::class, 'create'])->name('create-location')->middleware('can:create locations');
            $router->get('locations/{location}/edit', [AdminController::class, 'edit'])->name('edit-location')->middleware('can:read locations');
            $router->post('locations', [AdminController::class, 'store'])->name('store-location')->middleware('can:create locations');
            $router->put('locations/{location}', [AdminController::class, 'update'])->name('update-location')->middleware('can:update locations');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('locations', [ApiController::class, 'index'])->middleware('can:read locations');
            $router->patch('locations/{location}', [ApiController::class, 'updatePartial'])->middleware('can:update locations');
            $router->delete('locations/{location}', [ApiController::class, 'destroy'])->middleware('can:delete locations');
        });
    }
}
