<div id="collection-slide" class="side-nav collection-side-nav">

    @if(count($photos) > 0)
        <div class="collection-gallery">
            @foreach($photos as $collectionPhoto)
                <a class="@if($collectionPhoto->id === $photo->id) current @endif" data-photo-url="{{ route('gallery', ['image_id' => $collectionPhoto->id]) }}{{ $queryCollection }}">
                    <img alt="{{ $collectionPhoto->alt }}" src="/storage/photos/crags/200/{{ $collectionPhoto->slug_label }}">
                </a>
            @endforeach
        </div>
    @else
        <p class="grey-text">
            @lang('pages/gallery/gallery.noPhotoInCollection')
        </p>
    @endif
</div>