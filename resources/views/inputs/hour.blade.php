<div class="col {{ $col }}">
    <label>{{ $label }}</label>
    <select class="input-data" name="{{ $name }}">
        @for ($h = 0; $h <= 23; $h++)
            @php($selected = ($h == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $h }}">{{ $h }}</option>
        @endfor
    </select>
    <label>{{ $label }}</label>
</div>