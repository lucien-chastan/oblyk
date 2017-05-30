<title>@if(isset($meta_title)){{$meta_title}}@else{{'Oblyk'}}@endif</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

{{--css globale de l'application--}}
<link href="/css/app.css" rel="stylesheet">
<link href="/css/materialize.css" rel="stylesheet">
<link href="/css/cotation.css" rel="stylesheet">

@yield('css')