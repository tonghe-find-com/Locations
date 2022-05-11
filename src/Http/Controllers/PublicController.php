<?php

namespace TypiCMS\Modules\Locations\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Locations\Models\Location;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $list = Location::published()->order()->with('image')->get();

        return view('locations::public.index')
            ->with(compact('list'));
    }
}
