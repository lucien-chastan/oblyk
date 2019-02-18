<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">local_library</i>@choice('home.new-photo', count($activity['photos']))</div>
    <div class="collapsible-body">
        <div class="row">
            @php($photos = $activity['photos'])
            @include('includes.gallery')
        </div>
    </div>
</li>