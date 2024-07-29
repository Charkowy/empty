<select class="form-control menu-item-autocomplete" name="menu_item_id" id="menu_item_id" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Item</option>
    @foreach (App\Models\MenuItem::all()->sortBy('name') as $menu_item)
        <option value="{{ $menu_item->id }}" @selected(old('menu_item_id', $menuitemid ?? request()->input('menu_item_id')) == $menu_item->id)>{{ $menu_item->text }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.menu-item-autocomplete',
    'placeholder' => 'Items',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
