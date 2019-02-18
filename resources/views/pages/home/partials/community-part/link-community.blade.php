<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">link</i>@choice('home.new-link', count($activity['links']))</div>
    <div class="collapsible-body">
        <div class="row">
            <div>
                @foreach($activity['links'] as $link)
                    <div class="col s12 m6 l4 blue-border-activity-part">
                        <a href="{{ $link->link }}">
                            {{ $link->label }}
                        </a><br>
                        <span class="grey-text">
                            @lang('home.communityPostOn') <a href="{{ $link->getTargetLink()['link'] }}">{{ $link->getTargetLink()['name'] }}</a>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>