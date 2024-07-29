<form autocomplete="off" action="{{ $route }}" method="POST" id="user_form">
    @method($method)
    @csrf

    <div class="card card-success card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="tabs-form" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-user" data-toggle="pill" href="#aria-user" role="tab"
                        aria-controls="aria-user" aria-selected="true">Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-user-details" data-toggle="pill" href="#aria-user-details"
                        role="tab" aria-controls="aria-user-details" aria-selected="false">Detalles</a>
                </li>

                @if ($model == 'supplier')
                    <li class="nav-item">
                        <a class="nav-link" id="tab-supplier-details" data-toggle="pill" href="#aria-supplier-details"
                            role="tab" aria-controls="aria-supplier-details" aria-selected="false">Bancarios</a>
                    </li>
                @endif
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
                @if ($model == 'supplier')
                    <div class="tab-pane fade" id="aria-supplier-details" role="tabpanel"
                        aria-labelledby="tab-supplier-details">
                        @include('users.partials.tab-supplier-details')
                    </div>
                @endif

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
