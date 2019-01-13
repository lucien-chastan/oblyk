<div class="input-field col {{ $col }} {{ $class }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @for ($i = 1 ; $i <= 3 ; $i++)
            @php($selected = ($i == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $i }}">@lang('elements/gymRouteType.type_' . $i)</option>
        @endfor
    </select>
    <label>{{ $label }}</label>
</div>