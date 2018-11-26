<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach ($socials as $key => $social)
            @php($selected = ($social->id == $value) ? 'selected' : '')
            <option class="left" data-icon="/img/social-{{ $social->id }}.svg" {{ $selected }} value="{{ $social->id }}">{{ ucfirst($social->label) }}</option>';
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>