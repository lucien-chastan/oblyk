@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row messagerie">
    <div class="col s3">
        <div class="card-panel blue-card-panel">
            <div class="blue-border-zone">

                @foreach($conversations as $conversation)
                    <div class="blue-border-div">
                        <p class="no-margin">{{$conversation->conversation->label}}</p>
                        <p class="grey-text no-margin list-participant-conversation">
                            @foreach($conversation->conversation->userConversations as $otherUser)
                                <span>
                                    @if($otherUser->user->id == Auth::id())
                                        Moi
                                    @else
                                        {{$otherUser->user->name}}
                                    @endif
                                </span>
                            @endforeach
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col s9">
        <div class="card-panel blue-card-panel">
            messagerie instantané
        </div>
    </div>
</div>