<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @for ($i = 0;  $i <= 54 ; $i++ )
            @php($selected = ($i == $value) ? 'selected' : '')
            <option data-icon="/img/grade-dote/grade-{{ $i }}.png" {{ $selected }} value="{{ $i }}">{{ $i != 0 ? \App\Route::valToGrad($i, true) : 'Pas de cotation' }}</option>
        @endfor
    </select>
    <label>{{ $label }}</label>
</div>