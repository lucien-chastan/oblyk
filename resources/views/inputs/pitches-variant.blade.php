<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select id="{{ $id }}" class="input-data" name="{{ $name }}" onchange="{{ $onChange }}">
        @foreach ($pitches as $key => $pitch)
            @php($selected = ($key == $value) ? 'selected' : '')
            <option class="left" {{ $selected }} value="{{ $key }}">L.{{ $key + 1 }} - {{ $pitch['grade'] }} ({{ $pitch['height'] }}m)</option>
        @endforeach
    </select>
    <label for="{{ $id }}" class="{{ $required ? 'required' : '' }}">{{ $label }}</label>
</div>