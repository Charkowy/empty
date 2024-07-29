@isset($prepend)
    <div class="row">
        @include($prepend)
    </div>
@endisset
<div class="row">
    <div class="col d-flex flex-column" style="max-height: 75vh">
        <div class="row flex-grow-1 overflow-auto" style="min-height:400px">
            <div class="col">

                @isset($heads)
                    <table class="table table-bordered table-hover table-head-fixed text-wrap">
                        <thead>
                            <tr>
                                @foreach ($heads as $item)
                                    <th>{!! $item !!}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            {{ $slot }}
                        </tbody>
                    </table>
                @else
                    {{ $slot }}
                @endisset

            </div>
        </div>
        @isset($pagination)
            <div class="row mt-2">
                <div class="col"> {{ $pagination->links() }}</div>
            </div>
        @endisset
    </div>
</div>

@include('include.css.table')
