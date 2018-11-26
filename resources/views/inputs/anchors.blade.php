<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($anchors as $key => $anchor)
            @php($selected = ($anchor->id == $value) ? 'selected' : '')
            <option class="left" data-icon="/img/relais-{{ ($key + 1) }}.png" {{ $selected }} value="{{ $anchor->id }}">@lang('elements/anchors.anchor_' . $anchor->id)</option>
        @endforeach
    </select>
    @if($label != '')
        <label>{{ $label }}</label>
    @endif
</div>