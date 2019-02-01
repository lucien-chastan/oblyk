<div class="input-field col {{ $col }} {{ $class }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @for ($i = 0 ; $i <= 2 ; $i++)
            @php($selected = ($i == $value) ? 'selected' : '')
            <option class="left circle" {{ $selected }} data-icon="/img/gym-type-{{ $i }}.png" {{ $selected }} value="{{ $i }}">@lang('elements/gymRouteType.type_' . $i)</option>
        @endfor
    </select>
    <label>{{ $label }}</label>
</div>