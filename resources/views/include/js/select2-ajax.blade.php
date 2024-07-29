@push('js')
    @once
        @section('plugins.Select2', true)
    @endonce
    <script>
        $('{{ $selector }}').val(null).trigger('change');

        $('{{ $selector }}').select2({
            minimumInputLength: '{{ $minimumInputLength }}',
            placeholder: '{{ $placeholder }}',
            ajax: {
                dataType: 'json',
                delay: 500,
                cache: true,
                url: '{{ url($url) }}',
                data: function(params) {
                    var dynamicDataFunction = {!! $data !!};
                    const mergedObj = Object.assign({}, dynamicDataFunction(), {
                        q: params.term
                    });
                    return mergedObj;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            res = {
                                text: item.nomenclatura,
                                id: item.calle.id
                            }
                            /* if (item.user_detail === null) {
                                res = {
                                    disabled: true,
                                    text: item.full_name,
                                    id: item.id
                                }
                            } else {
                                res = {
                                    text: item.full_name +
                                        ' - ' + item.user_detail.doc_number,
                                    id: item.id
                                }
                            } */
                            return res;
                        })
                    };
                }
            }
        }).on('select2:open', () => {
            if ($('{{ $selector }}').attr('multiple') === undefined) {
                document.querySelector('.select2-search__field').focus();
            }
        });
    </script>
@endpush
{{--
            var newOption = new Option('{{ $user->full_name }}', '{{ $user->id }}', false, false);
        $('{{ $selector }}').append(newOption).trigger('change');
        --}}
