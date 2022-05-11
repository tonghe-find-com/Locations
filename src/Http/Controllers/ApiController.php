<?php

namespace TypiCMS\Modules\Locations\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Locations\Models\Location;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Location::class)
            ->selectFields($request->input('fields.locations'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Location $location, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($location->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $location->setTranslation($key, $lang, $value);
                }
            } else {
                $location->{$key} = $content;
            }
        }

        $location->save();
    }

    public function destroy(Location $location)
    {
        $location->delete();
    }
}
