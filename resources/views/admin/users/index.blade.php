@extends('adminlte::page')
@section('content')

    <x-widget.alert />

    @php
        $heads = ['Nombre', 'Email', 'Roles', 'Fecha alta', 'Eliminado'];
        $buttons = [['route' => 'admin.users.create', 'iconroute' => 'fas fa-plus']];
        $actions = [
            'show' => ['route' => 'admin.users.show'],
            'edit' => ['route' => 'admin.users.edit'],
        ];
    @endphp

    <x-widget.card :$buttons icon="fas fa-users" title="Usuarios" filter="admin.users.partials.filter">

        <x-widget.table :$heads :pagination="$users">
            @foreach ($users as $user)
                <tr>
                    <td>
                        <x-widget.actions :$actions :id="$user->id" :linkfield="$user->name" />
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles_name }}</td>
                    <td>@formatDate($user->created_at)</td>
                    <td>@formatDate($user->deleted_at)</td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>
@stop
