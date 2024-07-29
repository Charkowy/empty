<input type="text" name="description" class="form-control form-control-sm mr-2" placeholder="Descripción"
    value="{{ request()->input('description') }}" style="max-width: {{ $maxwidth ?? 120 }}px">
