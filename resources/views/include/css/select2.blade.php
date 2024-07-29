@pushOnce('css')
    <style type="text/css">
        .input-group-sm .select2-selection--single,
        .input-group-sm .select2-selection--multiple {
            height: calc(1.8125rem + 2px) !important;
            margin-right: 0.5rem !important;
            padding: 0.25rem 0.5rem;
            font-size: .875rem;
            line-height: 1.5;
            font-weight: 400;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-shadow: inset 0 0 0 transparent;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-group .select2-selection--single,
        .form-group .select2-selection--multiple {
            height: calc(2.25rem + 2px) !important;

        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b,
        .select2-container--default .select2-selection--multiple .select2-selection__arrow b {
            top: 60% !important;
            margin-left: -15px !important;
        }

        .select2-selection__choice {
            color: red !important;
            margin-top: 1px !important;
        }

        .select2-search__field {
            margin-top: 2px !important;
        }
    </style>
@endPushOnce
