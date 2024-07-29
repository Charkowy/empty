@extends('adminlte::page')
@section('content')

    <x-widget.alert />

    @php
        $heads = ['Nombre', 'Email', 'Fecha alta', 'Eliminado'];
        $buttons = [['route' => 'users.customers.create', 'iconroute' => 'fas fa-plus']];
        $actions = [
            'show' => ['route' => 'users.customers.show'],
            'edit' => ['route' => 'users.customers.edit'],
        ];
    @endphp

    <x-widget.card :$buttons icon="fas fa-users" title="Compradores" filter="users.partials.filter" model="customers">

        <x-widget.table :$heads :pagination="$customers">
            @foreach ($customers as $customer)
                <tr>
                    <td>
                        <x-widget.actions :$actions  :id="$customer->id" :linkfield="$customer->name" />
                    </td>
                    <td>{{ $customer->email }}</td>
                    <td>@formatDate($customer->created_at)</td>
                    <td>@formatDate($customer->deleted_at)</td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>
@stop
