@inject('Helpers','App\Lib\HelpersTemplates')

<div class="blue-border-zone">
    @foreach($descriptions as $description)
        <div class="blue-border-div">
            @if($description->private == 1)
                @if($description->user_id == Auth::user()->id)
                    <i class="material-icons left tiny grey-text text-lighten-1">vpn_key</i>
                    <div class="markdownZone">{{ $description->description }}</div>
                @else
                    <div class="markdownZone"><cite class="grey-text">commentaire privé</cite></div>
                @endif
            @else
                <div class="markdownZone">{{ $description->description }}</div>
            @endif
            <div class="grey-text">
                @if($description->note != 0)
                    <img src="/img/note_{{ $description->note }}.png" alt="" height="12">
                @endif
                par <a href="{{ $description->user->url() }}">{{ $description->user->name }}</a>
                le {{ $description->created_at->format('d M Y à H:i') }} sur <a onclick="loadRoute({{$description->descriptive->id}})" class="button-open-route">{{ $description->descriptive->label }}</a>
            </div>
        </div>
    @endforeach
</div>