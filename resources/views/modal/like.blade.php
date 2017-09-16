@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$title]) !!}

<div class="blue-border-zone">
    @foreach($likes as $like)

        <div class="blue-border-div">
            @if(file_exists(storage_path('app/public/users/50/user-' . $like->user->id . '.jpg')))
                <img src="/storage/users/50/user-{{$like->user->id}}.jpg" alt="" class="left circle" style="margin-right: 0.7em">
            @else
                <img src="/img/icon-search-user.svg" alt="" class="left circle" style="margin-right: 0.7em; height: 50px;">
            @endif
            <p>
                <a href="{{Route('userPage',['user_id'=>$like->user->id,'user_label'=>str_slug($like->user->name)])}}" class="text-bold">{{$like->user->name}}</a><br>
                <span class="grey-text">
                    @if($like->user->birth != 0) {{date('Y') - $like->user->birth}} ans @else ? ans @endif,
                    @if($like->user->sex == 1) @lang('elements/sex.sex_1') @endif
                    @if($like->user->sex == 2) @lang('elements/sex.sex_2') @endif
                </span>
            </p>
        </div>

    @endforeach
</div>
