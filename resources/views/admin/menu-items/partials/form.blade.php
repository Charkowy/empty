<div class="card card-success">

    <div class="card-header">
        <h3 class="card-title">Menú Items</h3>
    </div>

    <div class="card-body">

        <form autocomplete="off" action="{{ $route }}" method="POST" id="menu_item_form">
            @method($method)
            @csrf

            <div class="form-row">
                <div class="form-group col-2">
                    <label for="text">Texto</label>
                    <input class="form-control @error('text') is-invalid @enderror" type="text" id="text"
                        name="text" value="{{ old('text', $menu_item->text ?? null) }}" />
                </div>

                <div class="form-group col-2">
                    <label for="parent_id">Padre</label>
                    <x-autocomplete.menu-items :menuitemid="$menu_item->parent_id ?? null" class="@error('parent_id')
is-invalid
@enderror" />
                </div>

                <div class="form-group col-2">
                    <label for="permission_id">Permiso</label>
                    <x-autocomplete.permissions :permissionid="$menu_item->permission_id ?? null"
                        class="@error('permission_id')
is-invalid
@enderror" />
                </div>

                <div class="form-group col-2">
                    <label for="position">Posición</label>
                    <input class="form-control @error('position') is-invalid @enderror" type="number" id="position"
                        name="position" value="{{ old('position', $menu_item->position ?? null) }}" min="1" />
                </div>

                <div class="form-group col-2">
                    <label for="icon">Icono</label>
                    <input class="form-control @error('icon') is-invalid @enderror" type="text" id="icon"
                        name="icon" value="{{ old('icon', $menu_item->icon ?? null) }}" />
                </div>

                <div class="form-group col-2">
                    <label for="icon_color">Color</label>
                    <input class="form-control @error('icon_color') is-invalid @enderror" type="text" id="icon_color"
                        name="icon_color" value="{{ old('icon_color', $menu_item->icon_color ?? null) }}" />
                </div>

            </div>

            <div class="form-row">
                <div class="col-12 submit">
                    <button type="submit" class="btn btn-primary me-2">Guardar</button>
                </div>
            </div>

        </form>
    </div>
</div>
