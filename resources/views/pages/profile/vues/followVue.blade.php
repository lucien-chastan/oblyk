@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            <h2 class="loved-king-font titre-profile-boite-vue">Mes suivis</h2>

            @foreach($follows as $key => $catFollow)

                <p class="text-bold titre-nb-suivi">{{count($catFollow)}} {{$key}}</p>

                <div class="blue-border-zone row">
                    @foreach($catFollow as $follow)
                        <div class="blue-border-div col s12 m6 l4 follow-div">
                            <img class="circle left" src="{{$follow->followIcon}}">
                            <div>
                                <a href="{{$follow->followUrl}}" class="text-bold">{{$follow->followName}}</a><br>
                                <span class="grey-text">
                                    {{$follow->followInformation}}
                                    <i {!! $Helpers::tooltip('Supprimer ce suivi') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/follows/" . $follow->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>