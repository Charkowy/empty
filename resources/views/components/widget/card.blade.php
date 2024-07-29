<div class="card" style="min-height:550.25px">

    <div class="card-header d-flex">
        <h3 class="card-title mt-1" style="min-width: 200px">
            <i class="{{ $icon }}"></i> {{ $title }}
            @isset($buttons)
                @foreach ($buttons as $button)
                    @if (isset($button['route']))
                        @if (Route::has($button['route']))
                            <a href="{{ route($button['route']) }}" class="btn-success ml-2 btn-sm" role="button">
                                <i class="{{ $button['iconroute'] }}"></i>
                            </a>
                        @endif
                    @endif
                @endforeach
            @endisset
        </h3>

        @isset($filter)
            <form id="filter" class="input-group input-group-sm justify-content-end">
                @include($filter)
            </form>
        @endisset
    </div>

    <div class="card-body pb-0">
        {{ $slot }}
    </div>
</div>
