<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($starts as $key => $start)
            @php($selected = ($start->id == $value) ? 'selected' : '')
            <option class="left" data-icon="/img/start-{{ ($key + 1) }}.png" {{ $selected }} value="{{ $start->id }}">@lang('elements/starts.start_' . $start->id)</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>