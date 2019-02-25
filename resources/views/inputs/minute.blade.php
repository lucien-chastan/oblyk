<div class="col {{ $col }}">
    <label>{{ $label }}</label>
    <select class="input-data" name="{{ $name }}">
        @for ($m = 0; $m <= 59; $m++)
            @php($selected = ($m == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $m }}">{{ $m }}</option>
        @endfor
    </select>
    <label>{{ $label }}</label>
</div>