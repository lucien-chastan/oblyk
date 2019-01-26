# Oblyk, Site communautraire dédié à l'escalade

[English version](readme.md)

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
ou
git clone git@github.com:lucien-chastan/oblyk.git
```

Lancez composer pour installer les dépendances

```bash
cd /dossier/de/votre/app
composer install
```

Installer les dépendances node

```bash
npm install
```

**COPIER** le fichier .env.example et renommez le en .env

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

Créer l'arboresence de stockage
```bash
mkdir -p storage/app/public/articles/{1300,200,100,50}
mkdir -p storage/app/public/authors/{200,100}
mkdir -p storage/app/public/gyms/{1300,200,100,50,schemes}
mkdir -p storage/app/public/gyms/routes/{1300,500,200,100,50}
mkdir -p storage/app/public/gyms/sectors/{1300,500,200,50}
mkdir -p storage/app/public/photos/crags/{1300,200,100,50}
mkdir -p storage/app/public/post-photos
mkdir -p storage/app/public/topos/{700,200,100,50,PDF}
mkdir -p storage/app/public/users/{1300,1000,500,200,100,50}
```

Donner les droits d'écriture au dossier *storage/* et *bootstrap/cache/* (pas nécessaire si tu utilise le serveur artisan)
```bash
chmod -R 764 storage && chmod -R 764 bootstrap/cache
## à adapter suivant votre gestion des droits et de votre OS
```

Générer les dossiers css/js/img/... de public
```bash
## pour générer une fois
npm run dev

## pour générer et avoir une écoute des modifications
npm run watch
```

Lancer le php artisan server (option la plus simple, mais tu peux aussi utiliser un serveur apache local)
```bash
php artisan serve
```

## Workflow

Si vous voulez contribuer à Oblyk, voici la manière dont nous travaillons :

Que vous ayez une idée ou que vous vouliez corriger un bug, le mieux est de commencer par faire une issue,
sur cette issue on discute de comment faire (code, design, etc.) histoire de ne pas partir la tête baissée seul dans son code ^^

Quand on est d'accord et que ça semble bon pour lancer le développement on s'affecte l'issue (pour éviter que deux personnes développent le même module)

Sur notre environnement de développement on créer une branche à partir du master (le nom est libre du moment qu'il est explicite)

Quand la branche est prête, fini et testée localement, on la push sur le dépôt et on ouvre une pull request
Là on regarde si c'est ok, on apporte des modifications si c'est nécessaire.

Une fois la pull request valdiée

La branche sera mergée sur la version beta d'oblyk

on test si ça fonctionne correctement sur l'environement de prés-production

si c'est ok, on merge sur le master

et voilà ! vous avez contribué !

