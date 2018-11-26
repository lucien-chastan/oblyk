<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @for ($i = 0 ; $i <= 7 ; $i++)
            @php($selected = ($i == $value) ? 'selected' : '')
            <option class="left icon-modal-note" data-icon="/img/note_{{ $i }}.png" {{ $selected }} value="{{ $i }}">@lang('elements/notes.note_' . ($i + 1))' . $note . '</option>
        @endfor
    </select>
    <label>{{ $label }}</label>
</div>