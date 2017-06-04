<div class="row">
    <div class="col s12">

        <h4 class="loved-king-font">{{$route->label}}</h4>

        <div class="row">
            <div>
                <ul class="tabs tabs-fixed-width">
                    <li class="tab col s3"><a class="active" href="#route-tab-information">Informations</a></li>
                    <li class="tab col s3"><a onclick="loadTabRoute({{$route->id}},'comments',null)" href="#route-tab-comments">Commentaires</a></li>
                    <li class="tab col s3"><a onclick="loadTabRoute({{$route->id}},'photos',null)" href="#route-tab-photos">Photos</a></li>
                    <li class="tab col s3"><a onclick="loadTabRoute({{$route->id}},'videos',null)" href="#route-tab-videos">Vidéos</a></li>
                </ul>
            </div>
            <div id="route-tab-information" class="col s12">@include('pages.route.vues.informationVue')</div>
            <div id="route-tab-comments" class="col s12">@include('includes.ajax-loader')</div>
            <div id="route-tab-photos" class="col s12">@include('includes.ajax-loader')</div>
            <div id="route-tab-videos" class="col s12">@include('includes.ajax-loader')</div>
        </div>
    </div>
</div>