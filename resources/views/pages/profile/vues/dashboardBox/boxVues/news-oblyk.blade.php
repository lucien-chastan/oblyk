@foreach($articles as $article)
    <div class="row">
        @if(file_exists(storage_path('app/public/articles/100/article-' . $article->id . '.jpg')))
            <img src="/storage/articles/100/article-{{$article->id}}.jpg" class="left img-news">
        @else
            <img src="/img/default-article-bandeau.jpg" class="left img-news">
        @endif
        <p class="text-bold truncate no-margin">{{$article->label}}</p>
        <p class="no-margin">{{ str_limit($article->description, $limit = 90, $end = '...') }}</p>
        <p class="grey-text no-margin">
            Le {{$article->created_at->format('d M Y')}}, {{$article->views}} vus, {{$article->descriptions_count}} commentaires
            <a href="{{route('articlePage',['article_id'=>$article->id, 'article_label'=>str_slug($article->label)])}}">lire l'article</a>
        </p>
    </div>
@endforeach