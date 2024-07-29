@php
    $categories = isset($onlyroot) && $onlyroot == 'true' ? App\Models\Category::whereIsRoot()->get() : App\Models\Category::all();
@endphp

<select class="form-control category-autocomplete" name="category_id" id="category_id" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Categorías</option>
    @foreach ($categories->sortBy('name') as $category)
        <option value="{{ $category->id }}" @selected(old('category_id', $categoryid ?? request()->input('category_id')) == $category->id)>{{ $category->name }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.category-autocomplete',
    'placeholder' => 'Categorías',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
