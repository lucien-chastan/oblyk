<div class="blue-border-zone">
    @foreach($crags as $crag)

        <div class="blue-border-div">
            @if($crag->bandeau == '/img/default-crag-bandeau.jpg')
                <img src="/img/icon-search-crag.svg" class="left circle circle-40" alt="">
            @else
                <img src="{{str_replace('1300',"50",$crag->bandeau)}}" class="left circle circle-40" alt="">
            @endif
            <div class="text-bold">
                <img src="/img/point-{{ $crag->type_voie . $crag->type_grande_voie . $crag->type_bloc . $crag->type_deep_water . $crag->type_via_ferrata }}.svg" alt="" height="11">
                <a href="{{ $crag->url() }}">{{ $crag->label }}</a>
            </div>
            <p class="info-user grey-text">
                ajouté par <a href="{{ $crag->user->url() }}">{{ $crag->user->name }}</a> le {{ $crag->created_at->format('d M Y') }}
            </p>
        </div>

    @endforeach
</div>
