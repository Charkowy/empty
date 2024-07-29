@extends('adminlte::page')
@section('content')

    <x-widget.alert />

    @php
        $heads = ['Cod', 'Proveedor', 'Estado', 'Marca', 'Título', 'Ingreso', 'Actualizado', 'Precio'];
        $buttons = [
            ['route' => 'products.crud.create', 'iconroute' => 'fas fa-plus'],
            //['route' => 'products.crud.sync-all-to-woo', 'iconroute' => 'fas fa-arrow-up'],
            ['route' => 'products.crud.sync-all-from-woo', 'iconroute' => 'fas fa-arrow-down'],
        ];
        $actions = [
            'show' => ['route' => 'products.crud.show'],
            ['route' => 'divider'],
            'sync' => ['route' => 'products.crud.sync-from-woo', 'icon' => 'fas fa-rotate', 'text' => 'Sync'],
        ];
    @endphp

    <x-widget.card icon="fas fa-tshirt" title="Productos" :$buttons filter="products.crud.partials.filter">

        <x-widget.table :$heads :pagination="$products">
            @foreach ($products as $product)
                <tr>
                    <td>
                        <x-widget.actions :$actions :id="$product->id" :linkfield="$product->sku" />
                    </td>
                    <td>{{ $product->supplier->name }}</td>
                    <td>@statusBadge($product->status)</td>
                    <td>{{ $product->brand->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td>@formatDate($product->entry_date)</td>
                    <td>@formatDate($product->price_date)</td>
                    <td>@formatMoney($product->regular_price)</td>
                </tr>
            @endforeach
        </x-widget.table>
    </x-widget.card>

@stop
