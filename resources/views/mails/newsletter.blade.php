@component('mail::message')

<h1>
    {{ $title }}<br>
    <a style="text-decoration: none; font-size: 10px; font-weight: normal" href="{{ $onlineRoute }}">Voir la version en ligne</a>
</h1>

{!! $newsletter->content !!}

<p style="font-size: 11px; text-align: center">
    Pensez à supprimer ce mail après l'avoir lu
    <a style="text-decoration: none; font-size: 11px; white-space: nowrap" href="{{ $unsubscribeRoute }}">Me désabonner</a>
</p>

@endcomponent