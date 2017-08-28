@foreach($follows as $follow)

    <div class="col s12 blue-border-search crag-result">
        <img class="left circle" src="{{ $follow->followIcon}}">
        <a href="{{ $follow->followUrl }}">{{ $follow->followName }}</a><br>
        <span class="grey-text">{{ $follow->followInformation }}</span>
    </div>

@endforeach

@if(count($follows) == 0)
    <p class="grey-text text-center">
        @lang('interface/search.favoriteEmptyPara1')
    </p>
    <p class="grey-text text-center">
        @lang('interface/search.favoriteEmptyPara2')
    </p>
    <p class="text-center">
        <i class="material-icons amber-text center small">star</i>
    </p>
@endif