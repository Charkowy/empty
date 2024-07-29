<div class="card card-success">

    <div class="card-header">
        <h3 class="card-title">Permisos</h3>
    </div>

    <div class="card-body">

        <form autocomplete="off" action="{{ $route }}" method="POST" id="permission_form">
            @method($method)
            @csrf

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                        name="name" value="{{ old('name', $permission->name ?? null) }}" />
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
