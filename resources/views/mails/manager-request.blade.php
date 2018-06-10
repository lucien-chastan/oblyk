@component('mail::message')

Demande d'administration de la salle : [{{ $data['gym']->label }}]({{ route('gymPage', ['gym_label' => str_slug($data['gym']->label), "gym_id" => $data['gym']->id]) }})

## Information sur la demande

**Salle :** [{{ $data['gym']->label }}]({{ route('gymPage', ['gym_label' => str_slug($data['gym']->label), "gym_id" => $data['gym']->id]) }}) ({{ $data['gym']->id }})<br>
**Demande de :** [{{ $data['user']->name }}]({{ route('userPage', ['user_label' => str_slug($data['user']->name), "user_id" => $data['user']->id]) }}) ({{ $data['user']->id }})<br>
**Email :** {{ $data['user']->email }}

**Justification :**<br>
{{$data['justification']}}

@endcomponent