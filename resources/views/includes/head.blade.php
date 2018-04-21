<title>{{ env('APP_ENV') == 'beta' ? 'Beta | ' :'' }}@if(isset($meta_title)){{$meta_title}}@else{{'Oblyk'}}@endif</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<meta name="description" content="@if(isset($meta_description)){{$meta_description}}@else{{'Oblyk est un site communautaire d\'escalade outdoor et indoor : on peut y noter ses croix, et voir l\'activité des grimpeurs de la communauté'}}@endif">
<meta name="author" content="Lucien CHASTAN">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<link rel="icon" href="/img/fav_icon.png">

<meta property="og:title" content="@if(isset($meta_title)){{$meta_title}}@else{{'Oblyk'}}@endif"/>
<meta property="og:description" content="@if(isset($meta_description)){{$meta_description}}@else{{'Oblyk est un site communautaire d\'escalade outdoor et indoor : on peut y noter ses croix, et voir l\'activité des grimpeurs de la communauté'}}@endif"/>
<meta property="og:image" content="@if(isset($meta_img)){{$meta_img}}@else{{'/img/oblyk-home-baume-rousse.jpg'}}@endif" />
<meta property="og:type" content="website"/>

<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

{{--css globale de l'application--}}
<link href="/css/app.css" rel="stylesheet">
<link href="/css/materialize.css" rel="stylesheet">
<link href="/css/cotation.css" rel="stylesheet">
<link href="/css/route.css" rel="stylesheet">
<link href="/css/global-search.css" rel="stylesheet">
<link href="/font/oblyk/style.css" rel="stylesheet">
<link href="/css/markdown.css" rel="stylesheet">
<link href="/framework/phototheque/phototheque.css" rel="stylesheet">
<link href="/framework/trumbowyg/ui/trumbowyg.min.css" rel="stylesheet">

<meta name="google-site-verification" content="MA_dg_DndaPfduYn-hra1oRpDBYVlWyoAQoluxMLLPI" />

@yield('css')