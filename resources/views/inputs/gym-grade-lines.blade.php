<div class="input-field col {{ $col }} {{ $class }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select id="{{ $id }}" class="input-data" name="{{ $name }}" onchange="{{ $onChange }}">
        @foreach ($gradeLines as $key => $gradeLine)
            @php($selected = ($gradeLine->id == $value) ? 'selected' : '')
            <option class="left circle" {{ $selected }} data-icon="/img/{{ str_replace('#', 'color-', $gradeLine->colors()[0]) }}.png" value="{{ $gradeLine->id }}">
                {{ $gradeLine->label }}
                @if($gradeLine->grade_val != 0)
                    (~{{ App\Route::valToGrad($gradeLine->grade_val, true) }})
                @endif
            </option>
        @endforeach
    </select>
    <label for="{{ $id }}" class="{{ $required ? 'required' : '' }}">{{ $label }}</label>
</div>