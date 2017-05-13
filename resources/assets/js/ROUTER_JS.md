# Router JS

Router Js est un ensemble de petite fonction maison pour avoir un système de route JS (qui appel des pages en ajax)

Ce système s'utilise en complémentarité du système de tab de materializse

À pour dépendence Axios, pour le chargement en ajax

**À savoir :**  
Le système garde en mémoire les pages chargées et ne les recharges pas au prochain clic sur un onglet

## Utilisation

Dans le lien qui actionne un tab il faut les paramètres suivant :

- `data-route` : chemin de la page à charger
- `data-callback` : {optionel} fonction à exécuter à la fin du chargement de la page
- `class="router-link"` : permet d'indiquer au parser que c'est un lien du type Router js
- `href="#insert-zone"` : Ancre qui sera afficher dans l'url et id zone ou seront inséré les données

**Exemple :**

``` html
<a data-route="/path/to/ajax-page" data-callback="callback" class="router-link" href="#isnert-zone">Mon lien</a>
```