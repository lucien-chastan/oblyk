<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width crag-menu">
            <li class="tab col s2"><a class="router-link active" href="#index"><i class="material-icons">info</i><span>@lang('pages/crags/global.tabInformation')</span></a></li>
            <li class="tab col s2"><a data-route="{{ route('vueFilActuCrag',[$crag->id]) }}" data-callback="getCragPosts" class="router-link" href="#fil-actu"><i class="material-icons">shuffle</i><span>@lang('pages/crags/global.tabNewsFeed')</span></a><span class="count-tab-ettiquette">{{ $crag->posts_count }}</span></li>
            <li class="tab col s2"><a data-route="{{ route('vueSecteurCrag',[$crag->id]) }}" data-callback="getSectorChart" class="router-link" href="#voies"><i class="material-icons">format_list_bulleted</i><span>@lang('pages/crags/global.tabSector')</span></a><span class="count-tab-ettiquette">{{ $crag->routes_count }}</span></li>
            <li class="tab col s2"><a data-route="{{ route('vueMediasCrag',[$crag->id]) }}" data-callback="initPhotothequeCrag" class="router-link" href="#medias"><i class="material-icons">collections</i><span>@lang('pages/crags/global.tabMedia')</span></a><span class="count-tab-ettiquette">{{ count($cragPhotos) + $crag->videos_count }}</span></li>
            <li class="tab col s2"><a data-route="{{ route('vueLiensCrag',[$crag->id]) }}" class="router-link" href="#liens"><i class="material-icons">link</i><span>@lang('pages/crags/global.tabLink')</span></a><span class="count-tab-ettiquette">{{ $crag->links_count }}</span></li>
            <li class="tab col s2"><a data-route="{{ route('vueToposCrag',[$crag->id]) }}" class="router-link" href="#topos"><i class="material-icons">local_library</i><span>@lang('pages/crags/global.tabGuideBook')</span></a><span class="count-tab-ettiquette">{{ $crag->topos_count + $crag->topo_pdfs_count + $crag->topo_webs_count }}</span></li>
            <li class="tab col s2"><a data-route="{{ route('vueMapCrag',[$crag->id]) }}" data-callback="initCragMap" class="router-link" href="#map"><i class="material-icons">map</i><span>@lang('pages/crags/global.tabMap')</span></a></li>
        </ul>
    </div>
</div>