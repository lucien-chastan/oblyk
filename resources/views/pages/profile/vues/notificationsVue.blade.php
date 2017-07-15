@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <h2 class="loved-king-font titre-profile-boite-vue">Panneau des notifications</h2>

            <div class="blue-border-zone row notification-zone">
                @foreach($notifications as $notification)
                    <div class="blue-border-div col s12">
                        <img onclick="{{$notification->data->action}}" class="circle left" src="{{$notification->data->icon}}">
                        <div>
                            <p class="no-margin" onclick="{{$notification->data->action}}">
                                <strong>{!! $notification->data->title !!}</strong><br>
                                {!! $notification->data->content !!}
                            </p>
                            <span class="grey-text i-cursor">
                                @if($notification->read == 0)
                                    <i {!! $Helpers::tooltip('Marquer comme vu') !!} class="material-icons tooltipped" onclick="notificationsAsRead({{$notification->id}}, this)">visibility</i>
                                @else
                                    <i {!! $Helpers::tooltip('Marquer comme non vu') !!} class="material-icons tooltipped" onclick="notificationsAsRead({{$notification->id}}, this)">visibility_off</i>
                                @endif
                                <i {!! $Helpers::tooltip('Supprimer cette notification') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/notifications/" . $notification->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>