<div class="input-field col {{ $col }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select id="{{ $id }}" class="input-data" name="{{ $name }}" onchange="{{ $onChange }}">
        @foreach ($colors as $color)
            @php($selected = ($color == $value) ? 'selected' : '')
            <option class="left circle" {{ $selected }} data-icon="/img/{{ str_replace('#', 'color-', $color) }}.png" value="{{ $color }}">@lang('elements/colorList.' . $color)</option>
        @endforeach
    </select>
    <label for="{{ $id }}" class="{{ $required ? 'required' : '' }}">{{ $label }}</label>
</div>