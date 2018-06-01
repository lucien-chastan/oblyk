@component('mail::message')

# Bienvenue {{ $user->name }} !

Nous sommes heureux de te compter parmi nous :)

Laisse nous te faire faire un petit tour du domaine :

Tu es peut-être ici pour trouver des infos sur les falaises de France et du monde ? *(oui oui rien que ça)* alors la [carte des falaises]({{ route('map') }}) est un bon point de départ.

Ou alors cherches-tu un partenaire de grimpe ? on t'explique comme on a pensé ça [ici]({{ route('partnerHowPage') }}), ensuite c'est sûr la [carte des grimpeurs]({{ route('partnerMapPage') }}) que ça se passe.

C'est pour un carnet de croix ?<br>
alors rends-toi sur les falaises où tu as grimpé
([Bas Cuvier]({{ route('cragPage',['crag_id'=>117,'crag_label'=>'bas-cuvier']) }}) ?
[Buoux]({{ route('cragPage',['crag_id'=>103,'crag_label'=>'buoux']) }}) ?
[Cimaî]({{ route('cragPage',['crag_id'=>60,'crag_label'=>'cimai']) }}) ?) et coche tes croix<br>
Tu trouvera ensuite quelques [graphiques]({{ route('userPage', ['user_id' => $user->id, 'user_name'=> str_slug($user->name)]) }}#analytiks) sympa sur ton dashboard.

On te laisse découvrir le reste ^^

Si tu cherche de l'aide, tu en trouvera [ici]({{ route('help') }}), sur le [forum]({{ route('forum') }}) ou alors tu peux nous contacter à cette adresse : [ekip@oblyk.org](mailto:ekip@oblyk.org)

À bientôt et bonne grimpe !

L'ékip Oblyk

@endcomponent