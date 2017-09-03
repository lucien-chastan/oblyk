@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row messagerie">
    <div class="col s12 m6 l3 col-conversation flex-col">
        <div class="card-panel blue-card-panel">
            <div class="blue-border-zone">
                <div id="insert-conversation-list">
                    {{--liste des conversations en AJAX--}}
                </div>
                <div id="load-conversation-list" class="text-center">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bt-add-conversation">
                    <a {!! $Helpers::tooltip(trans('modals/conversation.addTooltip')) !!} {!! $Helpers::modal(route('conversationModal'), ["title"=>trans('modals/conversation.modalAddTitle'), "callback"=>"reloadConversationAfterAdd", "method"=>"POST" ]) !!} class="btn-floating btn-small waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 l9 col-messagerie flex-col">
        <div class="card-panel blue-card-panel">

            <div class="list-n-titre">

                {{--zone des messages--}}
                <div id="insert-message-list">
                    <p class="text-center grey-text">@lang('pages/profile/messenger.clickForSee')</p>
                </div>

                {{--loader des messages--}}
                <div id="load-message-list" class="text-center">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{--zone pour rédiger les messages--}}
            <div class="text-zone" id="message-text-zone">
                <div class="input-field col s12">
                    <textarea onkeydown="frappeText(event)" id="textarea-message"></textarea>
                    <label for="textarea-message">@lang('pages/profile/messenger.placeholderTextarea')</label>
                </div>
                <div class="zone-send-message">
                    <i {!! $Helpers::tooltip(trans('pages/profile/messenger.submitMessage')) !!} class="material-icons tooltipped" onclick="sendMessage()">send</i>
                </div>
            </div>
        </div>
    </div>
</div>