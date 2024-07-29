<form autocomplete="off" action="{{ $route }}" method="POST" id="supplier_form">
    @method($method)
    @csrf

    <div class="card card-success card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="tabs-form" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-user" data-toggle="pill" href="#aria-user" role="tab"
                        aria-controls="aria-user" aria-selected="true">Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-user-details" data-toggle="pill" href="#aria-user-details"
                        role="tab" aria-controls="aria-user-details" aria-selected="false">Usuario Detalles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-roles" data-toggle="pill" href="#aria-roles" role="tab"
                        aria-controls="aria-roles" aria-selected="false">Roles</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="tabs-form">

                <div class="tab-pane fade show active" id="aria-user" role="tabpanel" aria-labelledby="tab-user">
                    @include('users.partials.tab-user')
                </div>

                <div class="tab-pane fade" id="aria-user-details" role="tabpanel" aria-labelledby="tab-user-details">
                    @include('users.partials.tab-user-details')
                </div>

                <div class="tab-pane fade" id="aria-roles" role="tabpanel" aria-labelledby="tab-roles">
                    @include('users.partials.tab-roles')
                </div>

            </div>
            <div class="mt-3 form-row">
                <div class="col-6 submit">
                    <button type="submit" class="btn btn-primary me-2">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

@include('include.js.datepicker')
