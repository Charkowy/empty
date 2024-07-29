<select class="form-control address-autocomplete" name="address" id="address" style="max-width: 160px">
</select>

@include('include.js.select2-ajax', [
    'selector' => '.address-autocomplete',
    'placeholder' => 'Dirección',
    'minimumInputLength' => 4,
    'url' => 'autocomplete/address',
    'data' => 'function() { return {max:500, state: $("#state").val()} }',
    'process' => '$("#state").val(); }',
])
@include('include.css.select2')
