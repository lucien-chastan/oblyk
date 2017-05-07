# Fontcionnement des modales

Dans oblyk, les modales servent d'interface pour enregistrer créer, supprimer des infos en base de donnée

## initialiser une modal

Dans le bouton qui ouvre une modal il faut :

```html
    data-target="modal"
    data-route="route de la modal"
    data-modal="tableau JSON des données à passer"
```

### data-route

Utiliser blade : `data-route="{{url('cragModal')}}"` (configuré dans le fichier web php)

### data-modal

Écrir les données comme suit : 

`data-modal="{'crag_id':1}"` (les ' seront remplacé par des " avant d'être parsé en JSON)