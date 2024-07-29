@extends('adminlte::page')
@section('content')
    <x-widget.alert />

    @php
        $heads = ['Cod', 'Nombre', 'Email', 'Fecha alta', 'Eliminado'];
        $buttons = [['route' => 'users.suppliers.create', 'iconroute' => 'fas fa-plus']];
        $actions = [
            'show' => ['route' => 'users.suppliers.show'],
            'edit' => ['route' => 'users.suppliers.edit'],
        ];
    @endphp

    <x-widget.card :$buttons icon="fas fa-users" title="Proveedores" model="suppliers" filter="users.partials.filter">

        <x-widget.table :$heads :pagination="$suppliers">
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>
                        <x-widget.actions :$actions :id="$supplier->id" :linkfield="$supplier->id" />
                    </td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>@formatDate($supplier->created_at)</td>
                    <td>@formatDate($supplier->deleted_at)</td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>
@stop
