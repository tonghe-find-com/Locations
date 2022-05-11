<?php

namespace TypiCMS\Modules\Locations\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read locations')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Locations'), function (SidebarItem $item) {
                $item->id = 'locations';
                $item->icon = config('typicms.locations.sidebar.icon');
                $item->weight = 30;
                $item->route('admin::index-locations');
                $item->append('admin::create-location');
            });
        });
    }
}
