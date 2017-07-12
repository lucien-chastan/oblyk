<div class="parallax-container article-parallax">
    <div class="text-center">
        <h1 class="loved-king-font white-text">{{$article->label}}</h1><br>
        <p class="white-text">par {{$article->author}} le {{$article->created_at->format('d M Y')}}, {{$article->descriptions_count}} commentaire(s)</p>
    </div>
    <div class="parallax">
        <img class="img-article-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>