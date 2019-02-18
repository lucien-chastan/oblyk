<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select id="{{ $id }}" class="input-data" name="{{ $name }}" onchange="{{ $onChange }}">
        @foreach ($grades as $key => $grade)
            @php($selected = ($grade->id == $value) ? 'selected' : '')
            <option class="left" {{ $selected }} value="{{ $grade->id }}">{{ $grade->label }}</option>
        @endforeach
    </select>
    <label for="{{ $id }}" class="{{ $required ? 'required' : '' }}">{{ $label }}</label>
</div>