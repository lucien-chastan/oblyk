<div class="dashbox">
    <div class="blue-card-panel z-depth-2">
        <h2 class="loved-king-font titre-box-dashboard">{{$routeTitle}} <i {!! $Helpers::tooltip('Actualiser cette boîte') !!} class="material-icons right tooltipped refresh-target-box">cached</i></h2>
        <div class="target-box" data-sub-route="{{$routeBox}}">
            @include('includes.ajax-loader')
        </div>
    </div>
</div>