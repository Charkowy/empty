<select class="form-control permission-autocomplete" name="permission_id" id="permission_id" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Permisos</option>
    @foreach (Spatie\Permission\Models\Permission::all()->sortBy('name') as $permission)
        <option value="{{ $permission->id }}" @selected(old('permission_id', $permissionid ?? request()->input('permission_id')) == $permission->id)>{{ $permission->name }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.permission-autocomplete',
    'placeholder' => 'Permisos',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
