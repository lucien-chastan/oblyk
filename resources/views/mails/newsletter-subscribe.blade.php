@component('mail::message')

# Vous êtes inscrit à la news letter !

Merci de votre inscription à la news letter d'oblyk, vous receverez à peu près une lettre par mois.

Dans nos newslettes nous parlons des nouveautés d'oblyk, de l'expansion de la communauté, des développements réalisés et des projets à venir !

Vous pouvez vous désinscrir à tous moments en suivant ce lien : [me désinscrir]({{ route('unsubscribe') }}?email={{ $data['email'] }})

À bientôt et bonne grimpe !

L'ékip oblyk

@endcomponent