@component('mail::message')

# Salut {{$data['user']->name}}

{{$data['expeditaire']->name}} ta invité dans une conversation

Rend-toi dans ta [messagerie](http://dev-oblyk.org/grimpeur/{{$data['user']->id}}/{{$data['slug_name']}}#messages) pour lire les messages

@endcomponent