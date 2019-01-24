@inject('Helpers','App\Lib\HelpersTemplates')

@if(count($followers) == 0)
    <div class="row">
        <div class="col s12 grey-text text-italic text-center">
            <p>Ici apparaîtra la liste des grimpeurs qui suivent votre salle</p>
        </div>
    </div>
@else
    <div class="row">
        <div class="col s12">
            <div class="card-panel blue-card-panel">
                <div class="row">
                    @foreach($followers as $follower)
                        <div class="blue-border-div col s12 m6 l2 text-center">
                            <img height="60" class="circle" src="{{$follower->user->picture(100)}}"><br>
                            <a href="{{ route('userPage', ['user_name' => str_slug($follower->user->name), 'user_id'=>$follower->user->id]) }}" class="text-bold">
                                {{$follower->user->name}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
