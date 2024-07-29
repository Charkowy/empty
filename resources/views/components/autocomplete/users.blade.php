<select class="form-control user-autocomplete" name="user_id" id="user_id" style="max-width: {{ $maxwidth ?? 160 }}px">
    <option value="">Usuario</option>
    @foreach (App\Models\User::all()->sortBy('last_name') as $user)
        <option value="{{ $user->id }}" @selected(old('user_id', $userid ?? request()->input('user_id')) == $user->id)>{{ $user->name }}</option>
    @endforeach
</select>

@include('include.js.select2', [
    'selector' => '.user-autocomplete',
    'placeholder' => 'Usuario',
    'minimumInputLength' => 2,
])
@include('include.css.select2')
