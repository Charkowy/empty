<?php

namespace App\Listeners;

use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class CreateMenuItems
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BuildingMenu $event): void
    {
        //Elimino todos los items que estan cargados por archivo de configuracion
        //$event->menu->menu = [];
        $items_parent = MenuItem::whereNull('permission_id')
            ->orWhereIn('permission_id', auth()->user()->getAllPermissions()->pluck('id'))
            ->orderBy('position')
            ->get()->groupby('parent_id');

        foreach ($items_parent as $parent_id => $items) {
            unset($submenu);

            if (count($items) > 1) {
                foreach ($items as $item) {
                    if ($item->id != $item->parent_id) {
                        $submenu[] = [
                            'key' => $item->id,
                            'icon' => $item->icon,
                            'icon_color' => $item->icon_color,
                            'text' => $item->text,
                            'route' => $item->permission->name ?? '#',
                            'can' => $item->permission->name,
                            //'active' => [preg_replace('/\.[^.]*$/', '', $item->permission->name) . '*']
                            'active' => [str_replace('.', '/', str_replace(['.index', '.create', '.edit'], '', $item->permission->name)) . '*']
                        ];
                    } else {
                        $items[0] = $item;
                    }
                }
            }

            $item = $items[0];
            if (!is_null($item->role_id) && Auth::user()->hasRole($item->role->name)) {
                $menu = [
                    'key' => $item->id,
                    'header' => $item->text,
                ];
            } else if (is_null($item->permission)) {
                $menu = [
                    'key' => $item->id,
                    'icon' => $item->icon,
                    'icon_color' => $item->icon_color,
                    'text' => $item->text,
                ];
            } else if (auth()->user()->can($item->permission->name)) {
                $menu = [
                    'key' => $item->id,
                    'icon' => $item->icon,
                    'icon_color' => $item->icon_color,
                    'text' => $item->text,
                    'route' => $item->permission->name ?? '#',
                    'can' => $item->permission->name,
                    //'active' => [preg_replace('/\.[^.]*$/', '', $item->permission->name) . '*']
                    'active' => [str_replace('.', '/', str_replace(['.index', '.create', '.edit'], '', $item->permission->name)) . '*']
                ];
            }
            if (isset($submenu)) {
                $menu['submenu'] = $submenu;
            }

            $event->menu->add($menu);
        }
    }
}
