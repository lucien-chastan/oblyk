<div class="row stretchCol">

    {{--INOFRMATION SUR LA FALAISE--}}
    <div class="col s12 m7">
        @include('pages.crag.partials.information')
    </div>

    {{--PETITE INFORMATION SUR LA FALAISE--}}
    <div class="col s12 m5">
        @include('pages.crag.partials.petiteInformation')
    </div>
</div>

{{--DESCRIPTION DES GRIMPEURS--}}
<div class="row">
    @include('pages.crag.partials.description')
</div>

{{--TOPO PAPIER, WEB ET PDF--}}
<div class="row stretchCol">
    @include('pages.crag.partials.topos')
</div>

{{--ARTICLES--}}
@if(count($crag->articleCrags) > 0)
    <div class="row stretchCol">
        @include('pages.crag.partials.articles')
    </div>
@endif

<div class="row stretchCol">

    {{--RECHERCHE DE PARTENRAIRE--}}
    <div class="col s12 m5">
        @include('pages.crag.partials.partners')
    </div>

    {{--CROIX ET TICKLIST ICI--}}
    <div class="col s12 m7">
        @include('pages.crag.partials.crosses')
    </div>
</div>

{{--PHOTOS--}}
<div class="row">
    @include('pages.crag.partials.photos')
</div>

{{--STATISTIQUES--}}
<div class="row">
    @include('pages.crag.partials.graph')
</div>