@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    <div class="card card-success">

        <div class="card-header">
            <h3 class="card-title">Ordenes</h3>
        </div>

        <div class="card-body">

            <div class="callout callout-success">
                <div class="form-row">
                    <div class="form-group col-2">
                        <label for="customer_name">Comprador</label>
                        <div id="customer_name">{{ $order->customer->name }}</div>
                    </div>
                    <div class="form-group col-2">
                        <label for="status">Estado de la venta</label>
                        <div id="status">{{ $order->status }}</div>
                    </div>
                    <div class="form-group col-2">
                        <label for="date_paid">Fecha de pago</label>
                        <div id="date_paid">{{ $order->date_paid }}</div>
                    </div>
                </div>
            </div>

            @php
                $heads = ['SKU', 'Proveedor', 'Estado', 'Marca', 'Título', 'Precio'];
                $buttons = [];
                $actions = [];
            @endphp

            <x-widget.table :$heads>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->supplier->name }}</td>
                        <td>@statusBadge($product->status)</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>@formatMoney($product->regular_price)</td>
                    </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    <th colspan="3"></th>
                    <th>@formatMoney($order->products->sum('regular_price'))</th>
                </tr>
            </x-widget.table>

        </div>
    </div>


@stop
