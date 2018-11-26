<div class="input-field col {{ $col }}">
    @if($icon !== '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <input {{ $onkeyup }} placeholder="{{ $placeholder }}" value="{{ $value }}" id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" class="input-data">
    <label class="{{ $classLabel }}" for="{{ $id }}">{{ $label }}</label>
</div>