@component('mail::message')

<h1>
    #{{ str_replace('-', '.',$newsletter->ref) }} {{ $newsletter->title }}<br>
    <a style="text-decoration: none; font-size: 10px; font-weight: normal" href="{{ route('newsletter', ['ref' => $newsletter->ref]) }}">Voir la version en ligne</a>
</h1>

{!! $newsletter->content !!}

<p style="font-size: 11px; text-align: center">
    Pensez à supprimer ce mail après l'avoir lu
    <a style="text-decoration: none; font-size: 11px; white-space: nowrap" href="{{ route('unsubscribe') }}?email={{ $email }}">Me désabonner</a>
</p>

@endcomponent