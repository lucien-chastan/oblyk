<div class="file-field input-field">
    <div class="btn">
        <span>{{ $label }}</span>
        <input {!! $onchange !!} {{ $filter }} value="{{ $value }}" type="file" name="{{ $name }}" id="{{ $id }}">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
    </div>
</div>