@pushOnce('js')
    <script>
        $("form :input").prop('disabled', true);
        $("button[type=submit]").prop('disabled', true);
        $(".submit").append(
            '<a class="btn btn-primary" href="{{ route($route, $route_params ?? []) }}" role="button">Editar</a>');
    </script>
@endPushOnce
