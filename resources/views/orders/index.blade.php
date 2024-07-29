@extends('adminlte::page')
@section('content')

    <x-widget.alert />

    @php
        $heads = ['ID', 'Creado', 'Modificado', 'Comprador', 'Estado', 'Precio'];
        $buttons = [['route' => 'orders.sync-all-from-woo', 'iconroute' => 'fas fa-arrow-down']];
        $actions = [
            'show' => ['route' => 'orders.show'],
        ];
    @endphp

    <x-widget.card icon="fas fa-cart-shopping" title="Ordenes" :$buttons filter="orders.partials.filter">

        <x-widget.table :$heads {{-- :pagination="$orders" --}}>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <x-widget.actions :$actions :id="$order->id" :linkfield="$order->id" />
                    </td>
                    <td>@formatWooDate($order->date_created)</td>
                    <td>@formatWooDate($order->date_modified)</td>
                    <td>{{ $order->billing_email }}</td>
                    <td>{{ $order->status }}</td>
                    <td>@formatMoney($order->total)</td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>

@stop
