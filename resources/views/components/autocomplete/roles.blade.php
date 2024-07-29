<select class="form-control role-autocomplete" name="role_id" id="role_id" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Roles</option>
    @foreach (Spatie\Permission\Models\Role::all()->sortBy('name') as $role)
        <option value="{{ $role->id }}" @selected(old('role_id', $roleid ?? request()->input('role_id')) == $role->id)>{{ __('role.' . $role->name) }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.role-autocomplete',
    'placeholder' => 'Roles',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
