<select class="form-control category-autocomplete mr-2" name="category_id[]" id="category_id" style="max-width: 400px" multiple>
    <option value="">Categorías</option>
    @foreach (App\Models\Category::whereIsRoot()->get()->sortBy('name') as $category_root)
        <optgroup label="{{ $category_root->name }}">
            @foreach ($category_root->children as $category)
                <option value="{{ $category->id }}" @selected(in_array($category->id, request()->input('category_id') ?? []) == true)>{{ $category->name }}</option>
            @endforeach
        </optgroup>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.category-autocomplete',
    'placeholder' => 'Categorías',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
