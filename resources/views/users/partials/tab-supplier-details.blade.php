<div class="form-row">
    <div class="form-group col-4">
        <label for="bank_id" class="form-label">Banco</label>
        <x-autocomplete.banks :bankid="$$model->supplier_detail->bank_id ?? 1" />
    </div>
    <div class="col-4">
        <label for="cbu" class="form-label">CBU/CVU</label>
        <input class="form-control @error('cbu') is-invalid @enderror" type="text" id="cbu" name="cbu"
            value="{{ old('cbu', $$model->supplier_detail->cbu ?? null) }}" />
    </div>
    <div class="col-4">
        <label for="alias" class="form-label">Alias</label>
        <input class="form-control @error('alias') is-invalid @enderror" type="text" id="alias" name="alias"
            value="{{ old('alias', $$model->supplier_detail->alias ?? null) }}" />
    </div>
</div>
<div class="form-row">
    <div class="col-4">
        <label for="account_owner" class="form-label">Titular de cuenta</label>
        <input class="form-control @error('account_owner') is-invalid @enderror" type="text" id="account_owner"
            name="account_owner"
            value="{{ old('account_owner', $$model->supplier_detail->account_owner ?? null) }}" />
    </div>
    <div class="col-4">
        <label for="account_number" class="form-label">Número de cuenta</label>
        <input class="form-control @error('account_number') is-invalid @enderror" type="text" id="account_number"
            name="account_number"
            value="{{ old('account_number', $$model->supplier_detail->account_number ?? null) }}" />
    </div>
</div>
