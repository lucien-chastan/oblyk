<div class="row">
    <div class="col s12">

        <h4 class="loved-king-font">
            <img src="/img/climb-{{$route->climb_id}}.png" alt="" class="type-ligne-route">
            {{$route->label}}
            @if(count($route->routeSections) > 1)
                {{count($route->routeSections)}}.L
            @else
                <strong class="color-grade-{{$route->routeSections[0]->grade_val}}">{{$route->routeSections[0]->grade}}{{$route->routeSections[0]->sub_grade}}</strong>
            @endif

        </h4>

        <div class="row">
            <div>
                <ul class="tabs tabs-fixed-width no-scroll-x">
                    <li class="tab col s3"><a class="active" href="#route-tab-information">Informations</a></li>
                    <li class="tab col s3"><a onclick="loadTabRoute({{$route->id}},'photos','initRoutePhototheque')" href="#route-tab-photos">Photos</a><span class="count-tab-ettiquette">{{$route->photos_count}}</span></li>
                    <li class="tab col s3"><a onclick="loadTabRoute({{$route->id}},'videos','initVideoRouteTab')" href="#route-tab-videos">Vidéos</a><span class="count-tab-ettiquette">{{$route->videos_count}}</span></li>
                    <li class="tab col s3"><a onclick="loadTabRoute({{$route->id}},'carnet','initCarnetRouteTab')" href="#route-tab-carnet">Mon carnet</a><span class="count-tab-ettiquette">{{$count_carnet}}</span></li>
                </ul>
            </div>
            <div id="route-tab-information" class="col s12 route-tab">@include('pages.route.vues.informationVue')</div>
            <div id="route-tab-photos" class="col s12 route-tab">@include('includes.ajax-loader')</div>
            <div id="route-tab-videos" class="col s12 route-tab">@include('includes.ajax-loader')</div>
            <div id="route-tab-carnet" class="col s12 route-tab">@include('includes.ajax-loader')</div>
        </div>
    </div>
</div>