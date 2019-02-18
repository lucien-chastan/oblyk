<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($receptions as $reception)
            @php($selected = ($reception->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $reception->id }}">@lang('elements/receptions.reception_' . $reception->id)</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>