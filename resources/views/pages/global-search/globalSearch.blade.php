<div id="global-search" class="side-global-search side-nav">

    <div id="progressSearch" class="progress">
        <div class="indeterminate"></div>
    </div>

    <div class="row search-content">

        <div class="input-field col s12 m5">
            <i class="material-icons prefix">search</i>
            <select id="search-type">
                <option value="all" selected>Tous</option>
                <option value="crags">@lang('interface/search.cragOption')</option>
                <option value="gyms">@lang('interface/search.gymOption')</option>
                <option value="routes">@lang('interface/search.routeOption')</option>
                <option value="users">@lang('interface/search.userOption')</option>
                <option value="topics">@lang('interface/search.topicOption')</option>
                <option value="topos">@lang('interface/search.guideBookOption')</option>
                <option value="words">@lang('interface/search.wordOption')</option>
                <option value="helps">@lang('interface/search.helpOption')</option>
            </select>
            <label for="search-type">@lang('interface/search.searchTypeOnOblyk')</label>
        </div>

        <div class="input-field col s12 m7">
            <input onkeyup="globalSearche(this)" id="input-text-global-search" type="search">
            <label for="input-text-global-search">@lang('interface/search.searchOnOblyk')</label>
        </div>

        <div class="col s12 tab-search-ligne">
            <ul class="tabs tabs-fixed-width text-center no-scroll-x">
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-follow" href="#global-search-follow"><i class="material-icons">star</i></a></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-finds" href="#global-search-finds"><i class="material-icons">search</i></a></li>
            </ul>
        </div>

        {{--HISTORIQUE DE RECHERCHE--}}
        <div id="global-search-follow" class="col s12 suggestion-recherche">

            @if(Auth::check())
                <p class="grey-text text-center">@lang('interface/search.loadingFavorites')</p>
                <div class="text-center">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id-user-global-search" value="{{Auth::id()}}">
            @else
                <p class="grey-text text-center">@lang('interface/search.createAccountFor')</p>
                <input type="hidden" id="id-user-global-search" value="0">
            @endif
        </div>

        <div id="global-search-finds" class="col s12"><p class="grey-text text-center">@lang('interface/search.findsResultsHere')</p></div>
    </div>


</div>