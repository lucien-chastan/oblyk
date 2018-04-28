<div id="lastPhototheque" class="phototheque">
    @foreach($photos as $photo)
        <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br><a href='{{ $photo->getTargetLink()['link'] }}'>{{ $photo->getTargetLink()['name'] }}</a>"" src="/storage/photos/crags/100/{{$photo->slug_label}}" alt="{{$photo->description}}">
    @endforeach
</div>
