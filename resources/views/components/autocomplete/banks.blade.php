<select class="form-control bank-autocomplete" name="bank_id" id="bank_id" style="max-width: 160px">
    @foreach (App\Models\Bank::all()->sortBy('name') as $bank)
        <option value="{{ $bank->id }}" @selected(old('bank_id', $bankid ?? request()->input('bank_id')) == $bank->id)>{{ $bank->name }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.bank-autocomplete',
    'placeholder' => 'Bancos',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
