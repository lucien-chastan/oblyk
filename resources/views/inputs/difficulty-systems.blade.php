<div class="input-field col {{ $col }}">
    <p>
        {{ $label }}
    </p>
    @for ($i = 0; $i <= 3; $i++)
        @php($checked = ($i == $value) ? 'checked' : '')

        <p>
            <input class="input-data" name="{{ $name }}" {{ $checked }} type="radio" id="input-difficulty-system-{{ $i }}" value="{{ $i }}"/>
            <label for="input-difficulty-system-{{ $i }}">@lang('elements/difficulty-system.system_' . $i)</label>
        </p>
    @endfor
</div>