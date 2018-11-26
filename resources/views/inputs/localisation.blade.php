<div class="row">
    <div class="col s12">
        <input id="lat-hidden-input" class="input-data" type="hidden" name="lat" value="{{ $lat }}">
        <input id="lng-hidden-input" class="input-data" type="hidden" name="lng" value="{{ $lng }}">

        <label>{{ $label }}</label>
        <div id="input-map" class="input-map"></div>
    </div>
    @if($withRayon)
        <div class="input-field col s12">
            <input onkeyup="changeRayonPopupMap()" placeholder="rayon en Km" id="rayon-localisation-popup" value="{{ $rayon }}" name="rayon" type="number" min="1" max="40" class="input-data">
            <label for="rayon-localisation-popup">Mon rayon d'action autour de ce point (en km)</label>
        </div>
    @endif
</div>