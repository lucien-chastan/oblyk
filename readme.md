# Oblyk, Site communautraire dédié à l'escalade

Oblyk est un site internet open-source communautaire dédié à l'escalade. Il à pour objectif de constituer une grande base de donnée open-data des falaises et voies d'escalades de france et du monde mais aussi des salles. Les grimpeurs peuvent aussi se servire de cet outil pour noter leurs croix ou encore trouver des partenaires d'escalades.

![page d'accueil d'oblyk](https://oblyk.org/img/meta_home.jpg)

## Dépendances

Pour installer Oblyk sur votre machine vous devez avoir les logiciels suivant installer :

- [Git](https://git-scm.com/)
- Le trio : MySql, Apache, PHP ([Linux](https://doc.ubuntu-fr.org/lamp), [Windows](http://www.wampserver.com/), [Mac](https://www.mamp.info/en/))
- [Composer](https://getcomposer.org/)
- [NodeJs](https://nodejs.org/en/)

## Framework utilisés

Oblyk utilise principalement Laravel pour le PHP et Materialize pour le CSS, reporté vous à la documentation de ces 2 frameworks pour comprendre la majeur partie du code d'oblyk

- [Laravel](https://laravel.com/)
- [Materialize](http://materializecss.com/)

## Installation

Commencez par clonner le projet dans votre environement de développement local

```bash
cd /chemin/vers/votre/dossier/
git clone https://github.com/lucien-chastan/oblyk.git
```

Lancez composer pour installer les dépendances

```bash
cd /dossier/de/votre/app
composer install
```

Installer les dépendances node

```bash
node install
```

Copier le fichier .env.example et renommez le en .env

```bash
cp .env.example .env
```

Générer une clé pour votre application

```bash
php artisan key:generate
```
Créer une base de données sur MySql du nom que vous voulez, avec l'encodage *utf8_general_ci*

Ouvrez le fichier .env et renseigner votre configuration (nom de la base, nom utilisateur, code d'accès, etc.)

Régéner le cache de l'application

```bash
composer dump-autoload
```

Lancer la migration pour créer les tables de l'application et les fausses données de test

```bash
php artisan migrate --seed
```

Créer un lien symbolique dans le dossier public vers storage

```bash
php artisan storage:link
```

bientôt la suite de la procédure