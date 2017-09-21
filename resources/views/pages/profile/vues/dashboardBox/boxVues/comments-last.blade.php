<div class="blue-border-zone">
    @foreach($descriptions as $description)
        <div class="blue-border-div">
            <div class="markdownZone">{{$description->description}}</div>
            <div class="grey-text">
                @if($description->note != 0)
                    <img src="/img/note_{{ $description->note }}.png" alt="" height="12">
                @endif
                par <a href="{{ route('userPage',['user_id'=>$description->user->id,'user_label'=>str_slug($description->user->name)]) }}">{{ $description->user->name }}</a>
                le {{ $description->created_at->format('d M Y à H:i') }} sur <a onclick="loadRoute({{$description->descriptive->id}})" class="button-open-route">{{ $description->descriptive->label }}</a>
            </div>
        </div>
    @endforeach
</div>