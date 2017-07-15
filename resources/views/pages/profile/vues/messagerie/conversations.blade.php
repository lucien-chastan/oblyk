@inject('Helpers','App\Lib\HelpersTemplates')

@foreach($conversations as $conversation)
    <div class="blue-border-convesation-div @if($conversation->new_messages == 1) text-bold @endif" id="conversation-div-{{$conversation->conversation->id}}" onclick="showLoaderMessage(true);getMessages({{$conversation->conversation->id}});">

        <p class="no-margin truncate" title="{{$conversation->conversation->label}}">
            @if($conversation->conversation->label != '')
                {{$conversation->conversation->label}}
            @else
                @if(count($conversation->conversation->userConversations) > 1)
                    Conversation avec
                    <span class="virgule-span">
                        @foreach($conversation->conversation->userConversations as $otherUser)
                            @if($otherUser->user->id != Auth::id())
                                <span>{{$otherUser->user->name}}</span>
                            @endif
                        @endforeach
                    </span>
                @else
                    Pas encore de participant
                @endif
            @endif
        </p>
        <p class=" grey-text no-margin truncate virgule-span text-normal">
            @foreach($conversation->conversation->userConversations as $otherUser)
                @if($otherUser->user->id != Auth::id())
                    <span>{{$otherUser->user->name}}</span>
                @endif
            @endforeach
        </p>
    </div>
@endforeach

@if(count($conversations) == 0)
    <p class="text-center grey-text">Tu n'as pas de conversation en cours</p>
@endif