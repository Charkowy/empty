<select class="@error('customer_id') is-invalid @enderror form-control customer-autocomplete" name="customer_id" id="customer_id" style="max-width: 160px">
    <option value="">Comprador</option>
    @foreach (App\Models\Customer::all()->sortBy('name') as $customer)
        <option value="{{ $customer->id }}" @selected(old('customer_id', $customerid ?? request()->input('customer_id')) == $customer->id)>{{ $customer->name }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.customer-autocomplete',
    'placeholder' => 'Comprador',
    'minimumInputLength' => 2,
])
@include('include.css.select2')
