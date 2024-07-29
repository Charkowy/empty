<select class="@error('supplier_id') is-invalid @enderror form-control supplier-autocomplete mr-2" name="supplier_id" id="supplier_id" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Proveedores</option>
    @foreach (App\Models\Supplier::all()->sortBy('name') as $supplier)
        <option value="{{ $supplier->id }}" @selected(old('supplier_id', $supplierid ?? request()->input('supplier_id')) == $supplier->id)>{{ $supplier->name }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.supplier-autocomplete',
    'placeholder' => 'Proveedores',
    'minimumInputLength' => 2,
])
@include('include.css.select2')
