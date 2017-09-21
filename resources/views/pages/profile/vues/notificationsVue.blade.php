@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/notification.notificationTitle')</h2>

            <div class="blue-border-zone row notification-zone">
                @foreach($notifications as $notification)
                    <div id="div-notification-{{$notification->id}}" class="blue-border-div col s12 {{$notification->background}}">
                        <img onclick="notificationAction({{$notification->id}});{{$notification->data->action}}" class="text-hover circle left" src="{{$notification->data->icon}}">
                        <div>
                            <p class="no-margin">
                                <span class="text-cursor text-hover title-notification" onclick="notificationAction({{$notification->id}});{{$notification->data->action}}">{!! $notification->data->title !!}</span><br>
                                <span class="grey-text">
                                    {!! $notification->data->content !!}
                                    @if($notification->created_at->format('d M Y') == date('d M Y'))
                                        @lang('pages/profile/notification.today', ['date'=>$notification->created_at->format('H:i')])
                                    @else
                                        @lang('pages/profile/notification.on', ['date'=>$notification->created_at->format('d M Y H:i')])
                                    @endif
                                </span>
                            </p>
                            <span class="grey-text i-cursor">
                                @if($notification->read == 0)
                                    <i id="icon-notification-{{$notification->id}}" {!! $Helpers::tooltip(trans('pages/profile/notification.markedAsSeen')) !!} class="material-icons tooltipped" onclick="notificationsAsRead({{$notification->id}})">visibility</i>
                                @else
                                    <i id="icon-notification-{{$notification->id}}" {!! $Helpers::tooltip(trans('pages/profile/notification.markedAsUnseen')) !!} class="material-icons tooltipped" onclick="notificationsAsRead({{$notification->id}})">visibility_off</i>
                                @endif
                                <i {!! $Helpers::tooltip(trans('pages/profile/notification.deleteNotification')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/notifications/" . $notification->id, "callback"=>"reloadNotificationAfterDelete" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(count($notifications) == 0)
                <p class="grey-text text-center">@lang('pages/profile/notification.noNotification')</p>
            @endif

        </div>
    </div>
</div>