<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="description" content="#variable">
<meta name="author" content="Lucien Chastan">
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<!--Import Google Icon Font-->
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

{{--css globale de l'application--}}
<link href="/css/app.css" rel="stylesheet">
<link href="/css/materialize.css" rel="stylesheet">

<title>
    @if(isset($page_title))
        {{$page_title}}
    @else
        Oblyk
    @endif
</title>
@yield('css')