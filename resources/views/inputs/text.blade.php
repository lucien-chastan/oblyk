<div class="input-field col {{ $col }}">
    @if($icon !== '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <input {{ $onkeyup }} {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}" value="{{ $value }}" id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" class="input-data">
    <label class="{{ $classLabel }} {{ $required ? 'required' : '' }}" for="{{ $id }}">{{ $label }}</label>
</div>