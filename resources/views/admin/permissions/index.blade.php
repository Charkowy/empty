@extends('adminlte::page')
@section('content')
    <x-widget.alert />

    @php
        $heads = ['Nombre'];
        $actions = [
            'show' => ['route' => 'admin.permissions.show'],
            'edit' => ['route' => 'admin.permissions.edit'],
        ];
        $buttons = [['route' => 'admin.permissions.create', 'iconroute' => 'fas fa-plus']];
    @endphp

    <x-widget.card icon="fas fa-fingerprint" title="Permisos" :$buttons>

        <x-widget.table :$heads>
            @foreach ($permissions as $permission)
                <tr>
                    <td>
                        <x-widget.actions :$actions :id="$permission->id" :linkfield="$permission->id . '-' . $permission->name" />
                    </td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>
@stop
