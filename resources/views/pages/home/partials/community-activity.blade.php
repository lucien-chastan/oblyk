<ul class="collapsible" data-collapsible="expandable">

    @php($isFirst = true)

    {{-- Crags --}}
    @if(count($activity['crags']) > 0)
        @include('pages.home.partials.community-part.crag-community')
        @php($isFirst = false)
    @endif

    {{-- Climbers --}}
    @if(count($activity['climbers']) > 0)
        @include('pages.home.partials.community-part.climber-community')
        @php($isFirst = false)
    @endif

    {{-- Photos --}}
    @if(count($activity['photos']) > 0)
        @include('pages.home.partials.community-part.photo-community')
        @php($isFirst = false)
    @endif

    {{-- Vidéos --}}
    @if(count($activity['videos']) > 0)
        @include('pages.home.partials.community-part.video-community')
        @php($isFirst = false)
    @endif

    {{-- Gyms --}}
    @if(count($activity['gyms']) > 0)
        @include('pages.home.partials.community-part.gym-community')
        @php($isFirst = false)
    @endif

    {{-- Routes --}}
    @if(count($activity['routes']) > 0)
        @include('pages.home.partials.community-part.route-community')
        @php($isFirst = false)
    @endif

    {{-- Topos --}}
    @if(count($activity['topos']) > 0)
        @include('pages.home.partials.community-part.topo-community')
        @php($isFirst = false)
    @endif

    {{-- Topos PDF + WEB--}}
    @if(count($activity['toposPdf']) + count($activity['toposWeb']) > 0)
        @include('pages.home.partials.community-part.topo-pdf-web-community')
        @php($isFirst = false)
    @endif

    {{-- Liens --}}
    @if(count($activity['links']) > 0)
        @include('pages.home.partials.community-part.link-community')
        @php($isFirst = false)
    @endif

    {{-- Words --}}
    @if(count($activity['words']) > 0)
        @include('pages.home.partials.community-part.word-community')
        @php($isFirst = false)
    @endif
</ul>

