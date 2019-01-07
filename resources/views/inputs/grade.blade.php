<div class="input-field col {{ $col }}">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <input {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value }}" type="text" id="{{ $id }}" class="input-data">
    <label class="{{ $required ? 'required' : '' }} {{ $classLabel }}" for="{{ $id }}">{{ $label }}</label>
</div>