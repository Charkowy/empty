@extends('adminlte::page')
@section('content')

    <x-widget.alert />

    @php
        $heads = ['Nombre'];
        $actions = [
            'show' => ['route' => 'admin.roles.show'],
            'edit' => ['route' => 'admin.roles.edit'],
        ];
        $buttons = [['route' => 'admin.roles.create', 'iconroute' => 'fas fa-plus']];
    @endphp

    <x-widget.card :$buttons icon="fas fa-id-card" title="Roles">

        <x-widget.table :$heads>
            @foreach ($roles as $role)
                <tr>
                    <td>
                        <x-widget.actions :$actions :id="$role->id" :linkfield="$role->id . '-' . $role->name" />
                    </td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>
@stop
