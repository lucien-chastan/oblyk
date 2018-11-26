<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($points as $key => $point) {
            @php($selected = ($point->id == $value) ? 'selected' : '')
            <option class="left" data-icon="/img/point-{{ ($key + 1) }}.png" {{ $selected }} value="{{ $point->id }}">@lang('elements/points.point_' . $point->id)</option>
        @endforeach
    </select>
    @if($label != '')
        <label>{{ $label }}</label>
    @endif
</div>