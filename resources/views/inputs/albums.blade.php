<div class="input-field col s12">
    <select class="input-data" name="{{ $name }}">
        @if(!$newAlbum)
            <option value="0">{{ $mois[date('n') - 1] }} {{ date('Y') }}</option>
        @endif
        @foreach($albums as $album)
            @php($selected = ($album->id == $value) ? 'selected' : '')
            <option {{ $selected }} value="{{ $album->id }}">{{ ucfirst($album->label) }}</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>