<?php

namespace TypiCMS\Modules\Locations\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Locations\Exports\Export;
use TypiCMS\Modules\Locations\Http\Requests\FormRequest;
use TypiCMS\Modules\Locations\Models\Location;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('locations::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' locations.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Location();

        return view('locations::admin.create')
            ->with(compact('model'));
    }

    public function edit(location $location): View
    {
        return view('locations::admin.edit')
            ->with(['model' => $location]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $location = Location::create($request->validated());

        return $this->redirect($request, $location);
    }

    public function update(location $location, FormRequest $request): RedirectResponse
    {
        $location->update($request->validated());

        return $this->redirect($request, $location);
    }
}
