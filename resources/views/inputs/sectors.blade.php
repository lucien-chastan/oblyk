<div class="input-field col s12 {{ $col }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($sectors as $sector)
            @php($selected = ($sector->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $sector->id }}">{{ ucfirst($sector->label) }}</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>