<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">local_library</i>@choice('home.new-photo', count($activity['photos']))</div>
    <div class="collapsible-body">
        <div class="row">
            <div class="phototheque" id="photo-home-activity">
                @foreach($activity['photos'] as $photo)
                    <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>@lang('home.communityAddOn') <a href='{{ $photo->getTargetLink()['link'] }}'>{{ $photo->getTargetLink()['name'] }}</a>" src="/storage/photos/crags/100/{{$photo->slug_label}}" alt="{{$photo->description}}">
                @endforeach
            </div>
        </div>
    </div>
</li>