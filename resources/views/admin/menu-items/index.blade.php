@extends('adminlte::page')
@section('content')
    <x-widget.alert />

    @php
        $heads = ['text', 'parent_id', 'permission_id', 'role_id', 'position', 'icon', 'icon_color'];
        $actions = [
            'show' => ['route' => 'admin.menu-items.show'],
            'edit' => ['route' => 'admin.menu-items.edit'],
            'destroy' => ['route' => 'admin.menu-items.destroy'],
        ];
        $buttons = [['route' => 'admin.menu-items.create', 'iconroute' => 'fas fa-plus']];
    @endphp

    <x-widget.card :$buttons icon="fas fa-bars" title="Menú Items">

        <x-widget.table :$heads>
            @foreach ($menu_items as $menu_item)
                <tr>
                    <td>
                        <x-widget.actions :$actions :id="$menu_item->id" :linkfield="$menu_item->id . '-' . $menu_item->text" />
                        {{ !is_null($menu_item->role_id) ? ' (H)' : '' }}
                    </td>
                    <td>{{ $menu_item->parent_id }}-{{ $menu_item->parent->text }}</td>
                    <td>{{ is_null($menu_item->permission) ? '-' : $menu_item->permission_id . '-' . $menu_item->permission->name }}
                    </td>
                    <td>{{ is_null($menu_item->role) ? '-' : $menu_item->role_id . '-' . $menu_item->role->name }}</td>
                    <td>{{ $menu_item->position }}</td>
                    <td>{{ $menu_item->icon }}</td>
                    <td>{{ $menu_item->icon_color }}</td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>
@stop
