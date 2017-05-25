@inject('Helpers','App\Lib\HelpersTemplates')

<div class="blue-border-zone">
    @foreach ($sector->descriptions as $description)
        <div class="blue-border-div">
            <div class="markdownZone">{{ $description->description }}</div>
            <p class="info-user grey-text">
                par {{$description->user->name}} le {{$description->created_at->format('d M Y')}}

                @if(Auth::check())
                    <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                    @if($description->user_id == Auth::id())
                        <i {!! $Helpers::tooltip('Modifier cette déscription') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$sector->id, "descriptive_type"=>'Sector', "description_id"=>$description->id, "title"=>"Modifier la description", "method" => "PUT", "callback"=>"reloadDescriptionSector"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                        <i {!! $Helpers::tooltip('Supprimer cette déscription') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id, "callback"=>"reloadDescriptionSector"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                    @endif
                @endif
            </p>
        </div>
    @endforeach

    @if(count($sector->descriptions) == 0)
        <p class="grey-text text-center">Il n'y a aucune description postée par des grimpeurs, si tu as grimpé ici n'hésite pas à décrire ce secteur</p>
    @endif

</div>

{{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
@if(Auth::check())
    <div class="text-right">
        <a {!! $Helpers::tooltip('Rédiger un déscription') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$sector->id, "descriptive_type"=>'Sector', "description_id"=>"", "title"=>"Ajouter une description", "method"=>"POST", "callback"=>"reloadDescriptionSector"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
    </div>
@endif