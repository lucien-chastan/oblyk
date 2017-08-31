<div class="parallax-container article-parallax">
    <div class="text-center">
        <h1 class="loved-king-font white-text">{{$article->label}}</h1><br>
        <p class="white-text">@lang('pages/articles/article.written_by',['name'=>$article->author, 'date'=>$article->created_at->format('d M Y')]), {{ trans_choice('pages/articles/article.nb_comments', $article->descriptions_count)}}</p>
    </div>
    <div class="parallax">
        <img class="img-article-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>