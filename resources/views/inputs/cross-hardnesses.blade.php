<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($hardnesses as $hardness)
            @php($selected = ($hardness->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $hardness->id }}">@lang('elements/hardnesses.hardness_' . $hardness->id)</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>