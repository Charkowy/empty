<div class="card card-success">

    <div class="card-header">
        <h3 class="card-title">Roles</h3>
    </div>

    <div class="card-body">

        <form autocomplete="off" action="{{ $route }}" method="POST" id="role_form">
            @method($method)
            @csrf

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                        name="name" value="{{ old('name', $role->name ?? null) }}" />
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    @php
                         $heads = ['X', 'Nombre'];
                    @endphp
                    <x-widget.table :$heads>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @checked($permission->has) />
                                </td>
                                <td>
                                    {{ $permission->name }}
                                </td>
                            </tr>
                        @endforeach
                    </x-widget.table>
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
