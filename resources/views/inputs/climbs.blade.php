<div class="input-field col s12 {{ $col }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select onchange="optimisePopupRoute()" id="select-climbs-popup-route" class="input-data" name="{{ $name }}">
        @foreach ($climbs as $key => $climb)
            @if($key != 0)
                @php($selected = ($climb->id == $value) ? 'selected' : '')
                <option class="left" data-icon="/img/icon-climb-{{ ($key + 1) }}.png"
                        {{ $selected }} value="{{ $climb->id }}">
                    @lang('elements/climbs.climb_' . $climb->id)
                </option>
            @endif
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>