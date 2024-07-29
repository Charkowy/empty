<select class="form-control month-autocomplete" name="month" id="month" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Mes</option>
    @foreach (App\Class\Util::getMonths() as $n => $ptmonth)
        <option value="{{ $n }}" @selected(old('month', $month ?? request()->input('month')) == $n)>{{ $ptmonth }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.month-autocomplete',
    'placeholder' => 'Mes',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
