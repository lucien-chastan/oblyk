<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">format_align_justify</i>@choice('home.new-word', count($activity['words']))</div>
    <div class="collapsible-body">
        <div class="row">
            @foreach($activity['words'] as $word)
                <div class="col s12 blue-border-activity-part">
                    <a class="text-bold">{{ $word->label }}</a>
                    <div class="markdownZone">
                        @markdown($word->definition)
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</li>