@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        <div>
            @foreach($dataModal['friends'] as $friend)
                <div class="col s6 m4 l3 text-center">
                    @if(file_exists(storage_path('app/public/users/50/user-' . $friend->user->id . '.jpg')))
                        <img class="z-depth-1 circle" alt="" height="50" src="/storage/users/50/user-{{ $friend->user->id }}.jpg">
                    @else
                        <img class="z-depth-1 circle" alt="" height="50" src="/img/icon-search-user.svg">
                    @endif
                    {!! $Inputs::checkbox(['name'=>'check_freind_cross_users', 'id'=>'checkbox-user-cross-' . $friend->user->id, 'value'=>$friend->user->id , 'label'=> $friend->user->name, 'checked' => in_array($friend->user->id, $dataModal['crossFriends']) ? true : false, 'align' => 'center', 'onchange'=>'parseFreinds()']) !!}
                </div>
            @endforeach
        </div>
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'crossFriends', 'id'=>'crossFriends','value'=> implode(';', $dataModal['crossFriends'])]) !!}
</form>
