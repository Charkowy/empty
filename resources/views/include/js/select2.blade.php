@push('js')
    @once
        @section('plugins.Select2', true)
    @endonce
    <script>
        $('{{ $selector }}').select2({
            minimumInputLength: {{ $minimumInputLength }},
            placeholder: '{{ $placeholder }}',
            allowClear: true
        }).on('select2:open', () => {
            if ($('{{ $selector }}').attr('multiple') === undefined) {
                document.querySelector('.select2-search__field').focus();
            }
        });
    </script>
@endpush
