<div class="input-field col {{ $col }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select id="input-data-gym-sector" class="input-data" name="{{ $name }}">
        @foreach ($sectors as $sector)
            @php($selected = ($sector->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $sector->id }}">{{ ucfirst($sector->label) }}</option>
        @endforeach
    </select>
    <label for="input-data-gym-sector">{{ $label }}</label>
</div>