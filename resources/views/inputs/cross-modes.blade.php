<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($modes as $mode)
            @php($selected = ($mode->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $mode->id }}">@lang('elements/modes.mode_' . $mode->id)</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>