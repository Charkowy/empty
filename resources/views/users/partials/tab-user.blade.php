<div class="form-row">
    <div class="col-6">
        <label for="first_name" class="form-label">Nombre</label>
        <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="first_name"
            name="first_name" value="{{ old('first_name', $$model->first_name ?? null) }}" />
    </div>
    <div class="col-6">
        <label for="last_name" class="form-label">Apellido</label>
        <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="last_name"
            name="last_name" value="{{ old('last_name', $$model->last_name ?? null) }}" />
    </div>
</div>
<div class="form-row">
    <div class="col-6">
        <label for="email" class="form-label">E-mail</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email"
            value="{{ old('email', $$model->email ?? null) }}" />
    </div>
    <div class="col-6">
        <label for="doc_number" class="form-label">DNI</label>
        <input class="form-control @error('doc_number') is-invalid @enderror" type="number" id="doc_number" min="1"
            name="doc_number" value="{{ old('doc_number', $$model->doc_number ?? null) }}" />
    </div>
</div>
<div class="form-row">
    <div class="col-6">
        <label for="password" class="form-label">Clave</label>
        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password"
            name="password" />
    </div>
    <div class="col-6">
        <label for="password_confirmation" class="form-label">Confirmar Clave</label>
        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
            id="password_confirmation" name="password_confirmation" />
    </div>
</div>
