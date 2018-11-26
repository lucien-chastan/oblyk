<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($rains as $rain)
            @php($selected = ($rain->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $rain->id }}">@lang('elements/rains.rains_' . $rain->id)</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>