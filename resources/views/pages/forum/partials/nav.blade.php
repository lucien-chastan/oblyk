<div class="row forum-menu-zone">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width forum-menu">
            <li class="tab col s1"><a target="_self" href="{{route('forum')}}" @if($active == 'forum') class="active" @endif ><i class="material-icons">home</i><span>@lang('pages/forums/global.tabHome')</span></a></li>
            <li class="tab col s1"><a target="_self" href="{{route('forumCategories')}}" @if($active == 'category') class="active" @endif ><i class="material-icons">dashboard</i><span>@lang('pages/forums/global.tabCategory')</span></a></li>
            <li class="tab col s1"><a target="_self" href="{{route('forumTopics')}}" @if($active == 'topics') class="active" @endif ><i class="material-icons">view_list</i><span>@lang('pages/forums/global.tabTopics')</span></a></li>
            @if(Auth::check() && $active == 'topic')
                <li class="tab col s1"><a target="_self" href="{{route('topicPage',['topic_id'=>$topic->id, 'topic_label'=>str_slug($topic->label)])}}" @if($active == 'topic') class="active" @endif ><i class="material-icons">forum</i><span>{{$topic->label}}</span></a></li>
            @endif
            @if(Auth::check())
                <li class="tab col s1"><a target="_self" rel="nofollow" href="{{route('createTopics',['category_id'=>1])}}" @if($active == 'create_topics') class="active" @endif ><i class="material-icons">add</i><span>@lang('pages/forums/global.tabCreate')</span></a></li>
            @endif
            <li class="tab col s1"><a target="_self" href="{{route('forumRules')}}" @if($active == 'rules') class="active" @endif ><i class="material-icons">school</i><span>@lang('pages/forums/global.tabRules')</span></a></li>
        </ul>
    </div>
</div>