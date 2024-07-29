<div class="form-row mt-3">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">

                @foreach (Spatie\Permission\Models\Role::all()->sortBy('name') as $role)
                    <div class="form-check">
                        <input name="roles[{{ $role->id }}]" class="form-check-input" type="checkbox"
                            value="{{ $role->id }}" id="rol_{{ $role->id }}"
                            {{ in_array($role->id, $userHasRoles ?? []) ? 'checked' : '' }} />
                        <label class="form-check-label" for="rol_{{ $role->id }}">
                            {{ __('role.' . $role->name) }}
                        </label>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
