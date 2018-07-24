<div class="row stretchCol">
    <div class="col s12 m12 l7">

        <div class="card-panel">
            <h1 class="loved-king-font titre-1-topo">{{$topo->label}}</h1>

            <p>
                @lang('pages/guidebooks/tabs/information.description', ['name'=>$topo->label, 'editor'=>$topo->editor, 'year'=>$topo->editionYear])<br>
                <strong>@lang('pages/guidebooks/tabs/information.nbCrags')</strong> {{$topo->crags_count}}<br>
                <strong>@lang('pages/guidebooks/tabs/information.authorTitle') </strong>
                @if($topo->author != '')
                    {{$topo->author}}
                @else
                    <span class="grey-text text-italic">@lang('pages/guidebooks/tabs/information.noAuthor') </span>
                @endif
                <br>
                <strong>@lang('pages/guidebooks/tabs/information.priceTitle')</strong>
                @if($topo->price != 0)
                    {{$topo->price}} €
                @else
                    <span class="grey-text text-italic">@lang('pages/guidebooks/tabs/information.noPrice')</span>
                @endif
                <br>
                <strong>@lang('pages/guidebooks/tabs/information.pagesTitle')</strong>
                @if($topo->page != 0)
                    @choice('pages/guidebooks/tabs/information.nbPage', $topo->page)
                @else
                    <span class="grey-text text-italic">@lang('pages/guidebooks/tabs/information.noPages')</span>
                @endif
                <br>
                <strong>@lang('pages/guidebooks/tabs/information.weightTitle')</strong>
                @if($topo->weight != 0)
                    @choice('pages/guidebooks/tabs/information.weight', $topo->weight)
                @else
                    <span class="grey-text text-italic">@lang('pages/guidebooks/tabs/information.noWeight')</span>
                @endif
            </p>

            @if($topo->id == 3)
                <div class="row">
                    <div class="col s12 text-center">
                        <a href="https://www.auvieuxcampeur.fr/escalade-en-drome-provencale.html" class="btn-flat vieux-camp-btn">
                            <img height="10" src="/img/logo_vieux_campeur.png">
                            Acheter au Vieux Campeur
                        </a>
                    </div>
                </div>
            @else
                @if(Auth::check())
                    <div class="text-right ligne-btn">
                        <i {!! $Helpers::tooltip(trans('pages/guidebooks/tabs/information.editInformation')) !!} {!! $Helpers::modal(route('topoModal'), ["topo_id"=>$topo->id, "title"=>trans('pages/guidebooks/tabs/information.editInformation'), "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                        @if($topo->versions_count > 0)
                            <i {!! $Helpers::tooltip(trans('modals/version.tooltip')) !!} {!! $Helpers::modal(route('versionModal'), ["id"=>$topo->id, "model"=>"Topo"]) !!} class="material-icons tiny-btn right tooltipped btnModal">history</i>
                        @endif
                    </div>
                @endif
            @endif


            <h2 class="loved-king-font titre-2-topo">@lang('pages/guidebooks/tabs/information.descriptionTitle')</h2>

            <div class="blue-border-zone">
                @foreach ($topo->descriptions as $description)
                    <div class="blue-border-div">
                        <div class="markdownZone">{{ $description->description }}</div>
                        <p class="info-user grey-text">
                            @lang('modals/description.postByDate', ['name'=>$description->user->name, 'url'=>route('userPage',['user_id'=>$description->user->id, 'user_label'=>str_slug($description->user->name)]), 'date'=>$description->created_at->format('d M Y')])

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($description->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip(trans('modals/description.editTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$topo->id, "descriptive_type"=>"Topo", "description_id"=>$description->id, "title"=>trans('modals/description.modalEditeTitle'), "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($topo->descriptions) == 0)
                    <p class="grey-text text-center">@lang('pages/guidebooks/tabs/information.noDescription')</p>
                @endif

            </div>

            {{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
            @if(Auth::check())
                <div class="text-right">
                    <a {!! $Helpers::tooltip(trans('modals/description.addTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$topo->id, "descriptive_type"=>"Topo", "description_id"=>"", "title"=>trans('modals/description.modalAddTitle'), "method"=>"POST"]) !!} id="description-btn-modal"  class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
                </div>
            @endif

        </div>

    </div>
    <div class="col s12 m12 l5">
        <div class="card-panel">
            <img class="responsive-img z-depth-3" alt="couverture du topo {{$topo->label}}" src="{{ $topo->cover() }}">
            @if(Auth::check())
                <p class="text-center">
                    <a {!! $Helpers::modal(route('topoCouvertureModal'), ["topo_id"=>$topo->id, "title"=>trans('pages/guidebooks/tabs/information.changeCover')]) !!} class="btn-flat waves-effect btnModal"><i class="material-icons left">wallpaper</i>@lang('pages/guidebooks/tabs/information.changeCover')</a>
                </p>
            @endif
        </div>

    </div>
</div>

@if($nbArticle > 0)
    <div class="row">
        <div class="col s12">
            <div class="card-panel topo-article-area">
                <h2 class="loved-king-font">@lang('pages/guidebooks/tabs/information.relatedArticles')</h2>

                @foreach($topo->articleTopos as $articleTopo)
                    @if($articleTopo->article != null)
                        <div class="row">
                            <div class="col s12">
                                @php($article = $articleTopo->article)
                                @if(file_exists(storage_path('app/public/articles/100/article-' . $article->id . '.jpg')))
                                    <img src="/storage/articles/100/article-{{$article->id}}.jpg" class="left img-article">
                                @else
                                    <img src="/img/default-article-bandeau.jpg" class="left img-article">
                                @endif
                                <p class="text-bold truncate no-margin">{{$article->label}}</p>
                                <p class="no-margin">{{ str_limit($article->description, $limit = 90, $end = '...') }}</p>
                                <p class="grey-text no-margin">
                                    Le {{$article->created_at->format('d M Y')}}, {{$article->views}} vus, {{$article->descriptions_count}} commentaires
                                    <a href="{{route('articlePage',['article_id'=>$article->id, 'article_label'=>str_slug($article->label)])}}">lire l'article</a>
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
