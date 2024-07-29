<div class="form-row">
    <div class="col-3">
        <label for="birthday" class="form-label">Fecha nacimiento</label>
        <input class="form-control datepicker @error('birthday') is-invalid @enderror" id="birthday" name="birthday"
            data-date-start-date="-90y" data-date-end-date="-18y"
            value="{{ old('birthday', $$model->user_detail->birthday ?? null) }}">
    </div>
    <div class="col-3">
        <label for="phone" class="form-label">Num telefónico</label>
        <input class="form-control @error('phone') is-invalid @enderror" type="number" id="phone" name="phone"
            min="1" value="{{ old('phone', $$model->user_detail->phone ?? null) }}" />
    </div>
    <div class="col-3">
        <label for="instagram" class="form-label">Instagram</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input class="form-control @error('instagram') is-invalid @enderror" type="text" id="instagram"
                name="instagram" value="{{ old('instagram', $$model->user_detail->instagram ?? null) }}" />
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-3">
        <label for="state" class="form-label">Provincia</label>
        <x-autocomplete.states :statenombre="$$model->user_detail->state ?? null" />
    </div>
    <div class="form-group col-6">
        <label for="address" class="form-label">Dirección</label>
        <x-autocomplete.address />
    </div>
</div>
<div class="form-row">
    <div class="col-3">
        <label for="city" class="form-label">Ciudad / Barrio</label>
        <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" name="city"
            value="{{ old('city', $$model->user_detail->city ?? null) }}" />
    </div>
    <div class="col-4">
        <label for="street" class="form-label">Calle, número, piso, dpto</label>
        <input class="form-control @error('street') is-invalid @enderror" type="text" id="street" name="street"
            value="{{ old('street', $$model->user_detail->street ?? null) }}" />
    </div>
    <div class="col-2">
        <label for="zip" class="form-label">Código postal</label>
        <input class="form-control @error('zip') is-invalid @enderror" type="text" id="zip" name="zip"
            value="{{ old('zip', $$model->user_detail->zip ?? null) }}" />
    </div>
</div>
@if (Route::currentRouteName() == 'nombre.ruta')
    <div class="form-row">
        <div class="col-12">
            <label for="observations">Observaciones</label>
            <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror"
                rows="3" placeholder="Observaciones ...">{{ old('observations', $$model->user_detail->observations ?? null) }}</textarea>
        </div>
    </div>
@endif
