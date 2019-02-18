<div class="row">
    <div class="col s12">
        <input id="polyline-hidden-input" class="input-data" type="hidden" name="polyline" value="{{ $polyline }}">
        <input id="length-hidden-input" class="input-data" type="hidden" name="length" value="{{ $length }}">
        <label>{{ $label }}</label>
        <ul class="ul-tuto-marche-approche">
            <li>Glisser déposer les points blancs pour changer le tracé</li>
            <li>Un clic sur un point semi-opaque ajout le point au tracé</li>
            <li>Un clic sur un point blanc supprime le point du tracé</li>
            <li>Un clic sur la carte ajout un point au bout du tracé</li>
        </ul>
        <div id="input-map-approach" class="input-map input-map-approach"></div>
        <textarea style="display: none;" id="over-elements-for-map" name="over-element">{{ $elementsForMap }}</textarea>
    </div>
</div>