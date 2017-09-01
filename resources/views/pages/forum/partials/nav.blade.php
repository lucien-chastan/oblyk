<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width">
            <li class="tab col s2"><a target="_self" href="{{route('forum')}}" @if($active == 'forum') class="active" @endif >@lang('pages/forums/global.tabHome')</a></li>
            <li class="tab col s2"><a target="_self" href="{{route('forumCategories')}}" @if($active == 'category') class="active" @endif >@lang('pages/forums/global.tabCategory')</a></li>
            <li class="tab col s2"><a target="_self" href="{{route('forumTopics')}}" @if($active == 'topics') class="active" @endif >@lang('pages/forums/global.tabTopics')</a></li>
            @if(Auth::check() && $active == 'topic')
                <li class="tab col s2"><a target="_self" href="{{route('topicPage',['topic_id'=>$topic->id, 'topic_label'=>str_slug($topic->label)])}}" @if($active == 'topic') class="active" @endif >{{$topic->label}}</a></li>
            @endif
            @if(Auth::check())
                <li class="tab col s2"><a target="_self" rel="nofollow" href="{{route('createTopics',['category_id'=>1])}}" @if($active == 'create_topics') class="active" @endif >@lang('pages/forums/global.tabCreate')</a></li>
            @endif
            <li class="tab col s2"><a target="_self" href="{{route('forumRules')}}" @if($active == 'rules') class="active" @endif >@lang('pages/forums/global.tabRules')</a></li>
        </ul>
    </div>
</div>