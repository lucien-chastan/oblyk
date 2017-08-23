@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

{{--TITRE DE LA CONVERSATION--}}
<div class="div-titre-conversation" id="div-titre-conversation">
    <p class="text-bold no-margin truncate">

        @if($conversation->label != '')
            <span class="hide-on-small-only">{{$conversation->label}}</span>
        @else
            <cite class="grey-text text-normal hide-on-small-only">Pas de titre</cite>
        @endif

        <span class="grey-text text-normal virgule-span hide-on-small-only">
            avec :
            @foreach($conversation->userConversations as $userConversation)
                @if($userConversation->user->id != Auth::id())
                    <span><a href="{{route('userPage',['user_id'=>$userConversation->user->id,'user_label'=>str_slug($userConversation->user->name)])}}">{{$userConversation->user->name}}</a></span>
                @endif
            @endforeach
        </span>

        <span class="bt-action-conversation">
            @if(count($conversation->userConversations) <= 1)
                <i {!! $Helpers::tooltip('Supprimer cette conversation') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/conversations/" . $conversation->id, "callback"=>"reloadCurrentVue" ]) !!} class="tooltipped material-icons right grey-text btnModal">delete</i>
            @endif
            <i {!! $Helpers::tooltip('Modifier le titre') !!} {!! $Helpers::modal(route('conversationModal'), ["conversation_id"=>$conversation->id, "title"=>"Modifier le titre", "callback"=>"reloadMessageAfterEdit", "method"=>"PUT" ]) !!} class="material-icons right grey-text tooltipped btnModal">edit</i>
            <i {!! $Helpers::tooltip('Inviter un grimpeur') !!} {!! $Helpers::modal(route('userConversationModal'), ["conversation_id"=>$conversation->id, "title"=>"Inviter un grimpeur", "callback"=>"reloadMessageAfterEdit"]) !!} class="material-icons right grey-text tooltipped btnModal">person_add</i>
        </span>
    </p>
</div>

{{--LISTE DES MESSAGES--}}
<div class="zone-liste-message" id="zone-liste-message">
    @foreach($conversation->messages as $message)
        @if($message->message !== "\n" && $message->message !== "")
            <div class="message-div @if($message->user->id == Auth::id()) message-div-right @else message-div-left @endif">
                <div class="markdownZone">
                    @markdown($message->message)
                </div>
                <p class="no-margin info-user-message">
                    {{$message->user->name}} le {{$message->created_at->format('d M Y à H:i')}}
                </p>
            </div>
        @endif
    @endforeach

    @if(count($conversation->userConversations) <= 1)

        <form class="submit-form" onsubmit="return false">

            {!! $Inputs::popupError([]) !!}

            <div class="row">
                {!! $Inputs::text(['name'=>'searche-message-user', 'value'=>'', 'label'=>'Invite un grimpeur sur cette conversation', 'type'=>'text', 'onkeyup'=>'searchMessageUser()']) !!}
                <div id="insert-user-message-search">

                </div>
            </div>
        </form>

    @endif

    <p id="bottom-message-list" class="no-margin grey-text text-center"></p>

    @if(count($conversation->messages) == 0 && count($conversation->userConversations) > 1)
        <p class="text-center grey-text">Utilise le champs de text en bas pour écrire un message</p>
    @endif

</div>
