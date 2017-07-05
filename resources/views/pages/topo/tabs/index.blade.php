<div class="row stretchCol">
    <div class="col s12 m12 l7">

        <div class="card-panel">
            <h1 class="loved-king-font titre-1-topo">{{$topo->label}}</h1>

            <p>
                {{$topo->label}} est un topo édité par {{$topo->editor}} en {{$topo->editionYear}}<br>
                <strong>Nombre de site présent dans ce topo : </strong> 5<br>
                <strong>Auteur : </strong> {{$topo->author}}<br>
                <strong>Prix conseillé : </strong> {{$topo->price}} €
            </p>

            @if(Auth::check())
                <div class="text-right ligne-btn">
                    <i {!! $Helpers::tooltip('Modifier les informations') !!} {!! $Helpers::modal(route('topoModal'), ["topo_id"=>$topo->id, "title"=>"Modifier ce topo", "method" => "PUT"]) !!} class="material-icons tooltipped btnModal">edit</i>
                </div>
            @endif


            <h2 class="loved-king-font titre-2-topo">Description des grimpeurs</h2>

            <div class="blue-border-zone">
                @foreach ($topo->descriptions as $description)
                    <div class="blue-border-div">
                        <div class="markdownZone">{{ $description->description }}</div>
                        <p class="info-user grey-text">
                            par {{$description->user->name}} le {{$description->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($description->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip('Modifier cette déscription') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$topo->id, "descriptive_type"=>"Topo", "description_id"=>$description->id, "title"=>"Modifier la description", "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip('Supprimer cette déscription') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($topo->descriptions) == 0)
                    <p class="grey-text text-center">Il n'y a aucune description postée par des grimpeurs, si tu as ce topo, n'hésite pas à le décrire</p>
                @endif

            </div>

            {{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
            @if(Auth::check())
                <div class="text-right">
                    <a {!! $Helpers::tooltip('Rédiger un déscription') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$topo->id, "descriptive_type"=>"Topo", "description_id"=>"", "title"=>"Ajouter une description", "method"=>"POST"]) !!} id="description-btn-modal"  class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
                </div>
            @endif

        </div>

    </div>
    <div class="col s12 m12 l5">

        <div class="card-panel">
            <img class="responsive-img z-depth-3" alt="couverture du topo {{$topo->label}}" src="/storage/topos/topo-1.jpg">
        </div>

    </div>
</div>