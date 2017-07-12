@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">

    @if(isset($ticklist))
        <p class="text-center">{{$route->label}} fait partie de ma <a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#tick-list">tick list</a></p>
        <p class="text-center"><a {!! $Helpers::tooltip('Supprimer de ma tick list') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/tickLists/" . $ticklist->id, "callback"=>"reloadRouteCarnetTab"]) !!} class="i-cursor tooltipped btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">delete</i></a></p>
    @else
        @if(Auth::check())
            <p class="text-center"><a class="text-cursor" onclick="addInTickList({{$route->id}})">Ajouter à la tickList</a></p>
        @endif
    @endif

</div>
