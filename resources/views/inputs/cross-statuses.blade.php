<div class="input-field col {{ $col }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($statuses as $status)
            @php($selected = ($status->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $status->id }}">@lang('elements/statuses.status_' . $status->id)</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>