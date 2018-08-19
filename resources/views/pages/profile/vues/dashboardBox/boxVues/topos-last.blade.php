<div class="blue-border-zone">
    @foreach($topos as $topo)

        <div class="blue-border-div">
            @if(file_exists(storage_path('app/public/topos/50/topo-' . $topo->id . '.jpg')))
                <img src="/storage/topos/50/topo-{{ $topo->id }}.jpg" class="left couverture-40" alt="">
            @else
                <img src="/img/default-topo-couverture.svg" class="left couverture-40" alt="">
            @endif
            <div class="text-bold"><a href="{{ $topo->url() }}">{{ $topo->label }}</a></div>
            <p class="info-user grey-text">
                ajouté par <a href="{{ $topo->user->url() }}">{{ $topo->user->name }}</a> le {{ $topo->created_at->format('d M Y') }}
            </p>
        </div>

    @endforeach
</div>
