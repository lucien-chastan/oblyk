---
title: Oblyk API Docs

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Oblyk API

Welcome to the documentation of the oblyk api. Find here a set of routes allowing you to use the oblyk database

See Oblyk web site : [oblyk](https://oblyk.org)
<!-- END_INFO -->

#Crag

Routes to retrieve information on oblyk crags
<!-- START_17f4ee457977a4cbe2c4f05963016071 -->
## GET : Crag by Id

Get crag by oblyk Id with his information

**Parameters**
- `id` : oblyk id *(you can get it from the crag url)*

> Example request:

```bash
curl -X GET "http://oblyk-dev.org/api/v1/crags/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://oblyk-dev.org/api/v1/crags/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": 1,
        "label": "Montiroche",
        "code_country": "fr",
        "city": "Saint-Nabord",
        "region": "Vosges",
        "lat": 48.03477,
        "lng": 6.569101,
        "type_voie": 1,
        "type_grande_voie": 0,
        "type_bloc": 0,
        "type_deep_water": 0,
        "type_via_ferrata": 0,
        "routes_count": 20,
        "url": "http:\/\/localhost\/site-escalade\/1\/montiroche",
        "cover": null,
        "gap_grade": {
            "spreadable_id": 1,
            "min_grade_text": "4c",
            "max_grade_text": "7b"
        }
    }
}
```

### HTTP Request
`GET api/v1/crags/{id}`


<!-- END_17f4ee457977a4cbe2c4f05963016071 -->

<!-- START_2e4f66b07e8bb27c0f426de215cb4abb -->
## GET : Crags around place

Get all crags around a point with a given radius

**Parameters**
- `lat` : latitude *(example : 48.03477)*
- `lng` : longitude *(example : 6.569101)*
- `radius` : radius in kilometers *(example : 5)*

> Example request:

```bash
curl -X GET "http://oblyk-dev.org/api/v1/crags/around-place/{lat}/{lng}/{rayon}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://oblyk-dev.org/api/v1/crags/around-place/{lat}/{lng}/{rayon}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "lng": "1",
        "lat": "1",
        "radius": "1",
        "crags_count": 0,
        "crags": []
    }
}
```

### HTTP Request
`GET api/v1/crags/around-place/{lat}/{lng}/{rayon}`


<!-- END_2e4f66b07e8bb27c0f426de215cb4abb -->

#Guidebook

Routes to retrieve information on oblyk guidebook
<!-- START_fee45cda504a9ec9684644401b95f7ba -->
## GET : Guidebook by Oblyk Id or Ean

Get guidebook information : ean, author, price, crags, etc.

**Parameters**
- `idOrEan` : Oblyk id or ean *(example : 2 [oblyk id] or  9782915025910 [ean])*

> Example request:

```bash
curl -X GET "http://oblyk-dev.org/api/v1/topos/{idOrEan}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://oblyk-dev.org/api/v1/topos/{idOrEan}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": 1,
        "ean": null,
        "label": "Saou et ses environs",
        "author": "",
        "editor": "Club Alpin francais",
        "editionYear": 2007,
        "price": "0.00",
        "page": 0,
        "weight": 0,
        "crags_count": 16,
        "url": "http:\/\/localhost\/topo-escalade\/1\/saou-et-ses-environs",
        "cover": "http:\/\/oblyk-dev.org\/storage\/topos\/700\/topo-1.jpg",
        "crags": [
            {
                "id": 3,
                "label": "Les rangs de mars",
                "code_country": "fr",
                "city": "Pont-de-barret",
                "region": "Drôme",
                "lat": 44.604847,
                "lng": 5.015727,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 19,
                "url": "http:\/\/localhost\/site-escalade\/3\/les-rangs-de-mars",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 3,
                    "min_grade_text": "6a",
                    "max_grade_text": "8c"
                }
            },
            {
                "id": 4,
                "label": "Label",
                "code_country": "fr",
                "city": "Bezaudun",
                "region": "Drôme",
                "lat": 44.602225,
                "lng": 5.171185,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 11,
                "url": "http:\/\/localhost\/site-escalade\/4\/label",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 4,
                    "min_grade_text": "5a",
                    "max_grade_text": "7a"
                }
            },
            {
                "id": 25,
                "label": "La Graville",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.648761,
                "lng": 5.078759,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 75,
                "url": "http:\/\/localhost\/site-escalade\/25\/la-graville",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 25,
                    "min_grade_text": "3b",
                    "max_grade_text": "7b"
                }
            },
            {
                "id": 26,
                "label": "Le mur des étoiles",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.652589,
                "lng": 5.066158,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 15,
                "url": "http:\/\/localhost\/site-escalade\/26\/le-mur-des-etoiles",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 26,
                    "min_grade_text": "6a",
                    "max_grade_text": "7c"
                }
            },
            {
                "id": 30,
                "label": "Suzette flipo et Ricky banlieue",
                "code_country": "fr",
                "city": "Pont-de-barret",
                "region": "Drôme",
                "lat": 44.607003,
                "lng": 5.012892,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 40,
                "url": "http:\/\/localhost\/site-escalade\/30\/suzette-flipo-et-ricky-banlieue",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 30,
                    "min_grade_text": "4b",
                    "max_grade_text": "7c"
                }
            },
            {
                "id": 31,
                "label": "La borne de Jeanne",
                "code_country": "fr",
                "city": "Soyans",
                "region": "Drôme",
                "lat": 44.625489,
                "lng": 5.017309,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 2,
                "url": "http:\/\/localhost\/site-escalade\/31\/la-borne-de-jeanne",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 31,
                    "min_grade_text": "6b",
                    "max_grade_text": "7b"
                }
            },
            {
                "id": 32,
                "label": "Le petit cirque",
                "code_country": "fr",
                "city": "Soyans",
                "region": "Drôme",
                "lat": 44.627081,
                "lng": 5.029965,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 9,
                "url": "http:\/\/localhost\/site-escalade\/32\/le-petit-cirque",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 32,
                    "min_grade_text": "5c",
                    "max_grade_text": "7c"
                }
            },
            {
                "id": 33,
                "label": "Rocher des Abeilles",
                "code_country": "fr",
                "city": "Soyans",
                "region": "Drôme",
                "lat": 44.627618,
                "lng": 5.02232,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 41,
                "url": "http:\/\/localhost\/site-escalade\/33\/rocher-des-abeilles",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 33,
                    "min_grade_text": "4b",
                    "max_grade_text": "7b"
                }
            },
            {
                "id": 34,
                "label": "Mur du son",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.65507,
                "lng": 5.058345,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 36,
                "url": "http:\/\/localhost\/site-escalade\/34\/mur-du-son",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 34,
                    "min_grade_text": "5a",
                    "max_grade_text": "7b"
                }
            },
            {
                "id": 37,
                "label": "Le grand regardé",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.651711,
                "lng": 5.07207,
                "type_voie": 1,
                "type_grande_voie": 1,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 41,
                "url": "http:\/\/localhost\/site-escalade\/37\/le-grand-regarde",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 37,
                    "min_grade_text": "5b",
                    "max_grade_text": "8b\/8c"
                }
            },
            {
                "id": 39,
                "label": "Roche colombe",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.656026,
                "lng": 5.047226,
                "type_voie": 1,
                "type_grande_voie": 1,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 62,
                "url": "http:\/\/localhost\/site-escalade\/39\/roche-colombe",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 39,
                    "min_grade_text": "5a",
                    "max_grade_text": "8b"
                }
            },
            {
                "id": 40,
                "label": "La Poupoune",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.656053,
                "lng": 5.050053,
                "type_voie": 1,
                "type_grande_voie": 1,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 51,
                "url": "http:\/\/localhost\/site-escalade\/40\/la-poupoune",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 40,
                    "min_grade_text": "4c",
                    "max_grade_text": "8a"
                }
            },
            {
                "id": 42,
                "label": "L'aiguille de la tour",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.650803,
                "lng": 5.07275,
                "type_voie": 1,
                "type_grande_voie": 1,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 79,
                "url": "http:\/\/localhost\/site-escalade\/42\/laiguille-de-la-tour",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 42,
                    "min_grade_text": "2",
                    "max_grade_text": "7c"
                }
            },
            {
                "id": 66,
                "label": "Pas de Lauzun",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.66473,
                "lng": 5.0691,
                "type_voie": 1,
                "type_grande_voie": 0,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 19,
                "url": "http:\/\/localhost\/site-escalade\/66\/pas-de-lauzun",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 66,
                    "min_grade_text": "5a",
                    "max_grade_text": "8a"
                }
            },
            {
                "id": 771,
                "label": "Les 3 becs",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.64229,
                "lng": 5.20192,
                "type_voie": 0,
                "type_grande_voie": 1,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 3,
                "url": "http:\/\/localhost\/site-escalade\/771\/les-3-becs",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 771,
                    "min_grade_text": "4c",
                    "max_grade_text": "6b"
                }
            },
            {
                "id": 1939,
                "label": "La Ceyte",
                "code_country": "fr",
                "city": "Saou",
                "region": "Drôme",
                "lat": 44.65345,
                "lng": 5.078,
                "type_voie": 1,
                "type_grande_voie": 1,
                "type_bloc": 0,
                "type_deep_water": 0,
                "type_via_ferrata": 0,
                "routes_count": 59,
                "url": "http:\/\/localhost\/site-escalade\/1939\/la-ceyte",
                "cover": null,
                "gap_grade": {
                    "spreadable_id": 1939,
                    "min_grade_text": "2b",
                    "max_grade_text": "7b"
                }
            }
        ]
    }
}
```

### HTTP Request
`GET api/v1/topos/{idOrEan}`


<!-- END_fee45cda504a9ec9684644401b95f7ba -->

