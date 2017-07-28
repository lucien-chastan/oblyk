<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width gym-menu">
            <li class="tab col s2"><a class="router-link active" href="#index"><i class="material-icons">info</i><span>Informations</span></a></li>
            <li class="tab col s2"><a data-route="{{ route('vueFilActuGym',[$gym->id]) }}" data-callback="getGymPosts" class="router-link" href="#fil-actu"><i class="material-icons">shuffle</i><span>Fil d'actu</span></a><span class="count-tab-ettiquette">{{$gym->posts_count}}</span></li>
            <li class="tab col s2"><a data-route="{{ route('vueMapGym',[$gym->id]) }}" data-callback="initGymMap" class="router-link" href="#map"><i class="material-icons">map</i><span>Map</span></a></li>
        </ul>
    </div>
</div>