@pushOnce('js')
    @section('plugins.DatePicker', true)
    <script>
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'es',
            autoclose: true,
            orientation: 'bottom',
        });
    </script>
@endPushOnce
