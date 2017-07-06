<div class="row stretchCol">
    <div class="col s12 m12 l7">

        <div class="card-panel">
            <h1 class="loved-king-font titre-1-topo">{{$topo->label}}</h1>

            <p>
                {{$topo->label}} est un topo édité par {{$topo->editor}} en {{$topo->editionYear}}<br>
                <strong>Nombre de site d'oblyk présent dans ce topo : </strong> {{$topo->crags_count}}<br>
                <strong>Auteur : </strong>
                @if($topo->author != '')
                    {{$topo->author}}
                @else
                    <span class="grey-text text-italic">auteur non renseigné</span>
                @endif
                <br>
                <strong>Prix conseillé : </strong>
                @if($topo->price != 0)
                    {{$topo->price}} €
                @else
                    <span class="grey-text text-italic">prix non renseigné</span>
                @endif
                <br>
                <strong>Nombre de page : </strong>
                @if($topo->page != 0)
                    {{$topo->page}} pages
                @else
                    <span class="grey-text text-italic">nombre de page non renseigné</span>
                @endif
                <br>
                <strong>Poids : </strong>
                @if($topo->weight != 0)
                    {{$topo->weight}} grammes
                @else
                    <span class="grey-text text-italic">poids non renseigné</span>
                @endif
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
            @if(file_exists(storage_path('app/public/topos/700/topo-' . $topo->id.'.jpg')))
                <img class="responsive-img z-depth-3" alt="couverture du topo {{$topo->label}}" src="/storage/topos/700/topo-1.jpg">
            @else
                <img class="responsive-img z-depth-3" alt="" src="/img/default-topo-couverture.svg">
            @endif

                @if(Auth::check())
                    <p class="text-center">
                        <a {!! $Helpers::modal(route('topoCouvertureModal'), ["topo_id"=>$topo->id, "title"=>"Changer la couverture du topo"]) !!} class="btn-flat waves-effect btnModal"><i class="material-icons left">wallpaper</i> Changer la couverture</a>
                    </p>
                @endif
        </div>

    </div>
</div>