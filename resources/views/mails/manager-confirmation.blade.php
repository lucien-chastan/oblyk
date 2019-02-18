@component('mail::message')

Bonjour {{ $data['user']->name }}

Nous avons bien reçu votre demande d'administration de la salle : [{{ $data['gym']->label }}]({{ route('gymPage', ['gym_label' => str_slug($data['gym']->label), "gym_id" => $data['gym']->id]) }})<br>
Nous traitons votre demande dans les plus brefs délais.

Si vous avez des questions ou d'autres éléments à nous apporter, n'hésitez pas à nous contacter à cette adresse : [ekip@oblyk.org](mailto:ekip@oblyk.org)

À bientôt et bonne grimpe

L'ékip Oblyk

@endcomponent