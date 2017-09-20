<div class="blue-border-zone">
    @foreach($gyms as $gym)

        <div class="blue-border-div">
            @if(file_exists(storage_path('app/public/gyms/50/logo-' . $gym->id . '.png')))
                <img src="/storage/gyms/50/logo-{{$gym->id}}.png" class="left circle circle-40" alt="">
            @else
                <img src="/img/icon-search-gym.svg" class="left circle circle-40" alt="">
            @endif
            <div class="text-bold"><a href="{{route('gymPage',['gym_id'=>$gym->id,'gym_label'=>str_slug($gym->label)])}}">{{$gym->label}}</a></div>
            <p class="info-user grey-text">
                {{$gym->city}}, {{($gym->city != $gym->big_city) ? $gym->big_city : '' }} ajouté le {{$gym->created_at->format('d M Y')}}
            </p>
        </div>

    @endforeach
</div>
