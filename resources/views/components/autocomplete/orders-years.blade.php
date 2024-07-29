<select class="form-control order-year-autocomplete" name="year" id="year" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Año</option>
    @foreach (App\Models\Order::avalibleYears()->get() as $ptyear)
        <option value="{{ $ptyear->year }}" @selected(old('year', $year ?? request()->input('year')) == $ptyear->year)>{{ $ptyear->year }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.order-year-autocomplete',
    'placeholder' => 'Año',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
