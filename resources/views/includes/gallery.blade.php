@php($queryCollection = \App\Photo::queryCollection($photos))

<div class="phototheque">
    @foreach($photos  as $photo)
        <a rel="nofollow" href="{{ route('gallery', ['image_id' => $photo->id]) }}{{ $queryCollection }}">
            <img alt="{{ $photo->alt }}" src="/storage/photos/crags/200/{{ $photo->slug_label }}">
        </a>
    @endforeach
</div>