@php
    $statuses = ['draft', 'pending', 'private', 'publish', 'refund'];
@endphp

<select class="@error('status') is-invalid @enderror form-control product-statuses-autocomplete mr-2" name="status"
    id="status" {{ $disabled ?? '' }} style="max-width: {{ $maxwidth ?? 110 }}px">
    <option value="">Estados</option>
    @foreach ($statuses as $ptstatus)
        <option value="{{ $ptstatus }}" @selected(old('status', $status ?? request()->input('status')) == $ptstatus)>{{ $ptstatus }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.product-statuses-autocomplete',
    'placeholder' => 'Estados',
    'minimumInputLength' => 0,
])
@include('include.css.select2')
