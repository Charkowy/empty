@php
    if ($errors->any()) {
        $title = 'Errores';
        $status = 'danger';
        $msg = '<ul>';
        foreach ($errors->all() as $error) {
            $msg .= '<li>' . $error . '</li>';
        }
        $msg .= '</ul>';
    } elseif (session('status') !== null && session('msg') !== null) {
        $title = 'Correcto';
        $status = session('status');
        $msg = session('msg');
    }
@endphp

@if (isset($status) && isset($msg) && isset($title))
    <div class="card card-{{ $status }}">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">{!! $msg !!}
        </div>
    </div>
@endif
