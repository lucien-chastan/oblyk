<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @for ($i = 0 ; $i <= 2 ; $i++)
            @php($selected = ($i == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $i }}">@lang('elements/sex.sex_' . $i)</option>
        @endfor
    </select>
    <label>{{ $label }}</label>
</div>