<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($inclines as $key => $incline)
            @php($selected = ($incline->id == $value) ? 'selected' : '')
            <option class="left" data-icon="/img/incline-{{ ($key + 1) }}.png" {{ $selected }} value="{{ $incline->id }}">
                @lang('elements/inclines.incline_' . $incline->id)
            </option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>