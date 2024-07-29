<input type="number" name="supplier_id_code" class="form-control form-control-sm mr-2" placeholder="xx" min="1"
    value="{{ request()->input('supplier_id_code') }}" style="max-width: {{ $maxwidth ?? 60 }}px" id="supplier_id_code">
<div class="mr-2">-</div>
<input type="number" name="relative_code" class="form-control form-control-sm mr-2" placeholder="xxx" min="1"
    value="{{ request()->input('relative_code') }}" style="max-width: {{ $maxwidth ?? 60 }}px">
