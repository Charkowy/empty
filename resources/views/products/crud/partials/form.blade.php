<form autocomplete="off" action="{{ $route }}" method="POST" id="product_form">
    @method($method)
    @csrf

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Producto</h3>
        </div>

        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-3">
                    <label for="supplier_id">Proveedor</label>
                    <x-autocomplete.suppliers :maxwidth="200" :supplierid="$product->supplier_id ?? null" />
                </div>

                <div class="form-group col-2">
                    <label for="category_id">Marca</label>
                    <x-autocomplete.brands :categoryid="$product->brand->id ?? null" />
                </div>

                <div class="form-group col-5">
                    <label for="name">Nombre</label>
                    <input type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Nombre"
                        name="name" id="name" value="{{ old('name', $product->name ?? null) }}">
                </div>

                <div class="form-group col-2">
                    <label for="regular_price">Precio</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="@error('regular_price') is-invalid @enderror form-control"
                            placeholder="Precio" name="regular_price" id="regular_price"
                            value="{{ old('regular_price', $product->regular_price ?? null) }}">
                    </div>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control"
                        rows="5" placeholder="Descripción ...">{{ old('description', $product->description ?? null) }}</textarea>
                </div>
                <div class="form-group col-6">
                    <label for="observations">Observaciones</label>
                    <textarea name="observations" id="observations" class="form-control" rows="5" placeholder="Observaciones ...">{{ old('observations', $product->observations ?? null) }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12 submit">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>

        </div>
    </div>
</form>
