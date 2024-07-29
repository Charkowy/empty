<select class="@error('category_id') is-invalid @enderror form-control brand-autocomplete mr-2" name="category_id"
    id="category_id" style="max-width: 160px">
    <option value="">Marcas</option>
    @foreach (App\Models\Brand::all()->sortBy('name') as $brand)
        <option value="{{ $brand->id }}" @selected(old('category_id', $categoryid ?? request()->input('category_id')) == $brand->id)>{{ $brand->name }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.brand-autocomplete',
    'placeholder' => 'Marcas',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
