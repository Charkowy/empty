@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    @php
        $buttons = [['route' => 'categories.sync-all-from-woo', 'iconroute' => 'fas fa-arrow-down']];
    @endphp
    <x-widget.card icon="fas fa-bars" title="Categorías" :$buttons>

        <div class="row">

            <div class="col-md-7">
                <div class="card card-success">

                    <div class="card-header">
                        <h3 class="card-title">Listado sincronizado al @formatDate($categories->first()->updated_at)</h3>
                    </div>

                    <div class="card-body">

                        <ul class="list-group">
                            @foreach ($categories as $category)
                                @include('categories.partials.category', ['category' => $category])
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>

        </div>
    </x-widget.card>
@stop
