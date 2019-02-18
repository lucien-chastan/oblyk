<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($rocks as $rock)
            @php($selected = ($rock->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $rock->id }}">@lang('elements/rocks.rock_' . $rock->id)</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>