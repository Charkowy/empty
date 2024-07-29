@php
    use App\Apis\Georef\GeoStateApi;
    $states = (new GeoStateApi())->all()->get()->sortBy('nombre');
@endphp

<select class="form-control state-autocomplete" name="state" id="state" style="max-width: 160px">
    @if(is_null($statenombre))
        <option value=""></option>
    @endif
    @foreach ($states as $state)
        <option value="{{ $state->nombre }}" @selected(old('state', $statenombre ?? request()->input('state')) == $state->nombre)>{{ $state->nombre }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.state-autocomplete',
    'placeholder' => 'Provincias',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
