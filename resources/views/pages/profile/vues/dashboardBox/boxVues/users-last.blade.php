<div class="blue-border-zone">
    @foreach($users as $newUser)

        <div class="blue-border-div">
            @if(file_exists(storage_path('app/public/users/50/user-' . $newUser->id . '.jpg')))
                <img src="/storage/users/50/user-{{ $newUser->id }}.jpg" class="left circle circle-40" alt="">
            @else
                <img src="/img/icon-search-user.svg" class="left circle circle-40" alt="">
            @endif
            <div class="text-bold"><a href="{{ $newUser->url() }}">{{ $newUser->name }}</a></div>
            <p class="info-user grey-text">
                {{ $newUser->genre }}, {{ $newUser->age }} ans arrivé le {{ $newUser->created_at->format('d M Y') }}
            </p>
        </div>

    @endforeach
</div>
