# Oblyk, Climbing Community website

[version française](readme-fr.md)

Oblyk is an open-source community website dedicated to climbing. It aims to build a large open-data database of cliffs and climbing routes in France and the world but also of climbing gyms. Climbers can also use this tool to record their crosses or find climbing partners.

![page d'accueil d'oblyk](https://oblyk.org/img/meta_home.jpg)

## Dépendances

To install Oblyk on your machine you must have the following software installed:

- [Git](https://git-scm.com/)
- The trio : MySql, Apache, PHP ([Linux](https://doc.ubuntu-fr.org/lamp), [Windows](http://www.wampserver.com/), [Mac](https://www.mamp.info/en/))
- [Composer](https://getcomposer.org/)
- [NodeJs](https://nodejs.org/en/)

## Frameworks used

Oblyk mainly uses Laravel for PHP and Materialize for CSS, refer you to the documentation of these 2 frameworks to understand most of the oblyk code

- [Laravel](https://laravel.com/)
- [Materialize](http://materializecss.com/)

## Installation

Start by cloning the project in your local development environment

```bash
cd /chemin/vers/votre/dossier/

git clone https://github.com/lucien-chastan/oblyk.git
or
git clone git@github.com:lucien-chastan/oblyk.git
```

Launch Composer to install dependencies

```bash
cd /your/application's/folder
composer install
```

Install node dependencies

```bash
npm install
```

**COPY** the file .env.example and rename it to .env

```bash
cp .env.example .env
```

Generate a key for your application

```bash
php artisan key:generate
```
Create a database on MySql of the name you want, with *utf8_general_ci* encoding

Open the .env file and enter your configuration (database name, user name, access code, etc.)

Regenerate application cache

```bash
composer dump-autoload
```

Start migration to create application tables and false test data

```bash
php artisan migrate --seed
```

Create a symbolic link in the public folder to storage

```bash
php artisan storage:link
```

Give write permission to folder *storage/* and *bootstrap/cache/*
```bash
chmod -R 764 storage && chmod -R 764 bootstrap/cache
## to adapt according to your rights management and your OS
```

Generate public css/js/img/... folders
```bash
## to generate once
npm run dev

## to generate and listen for changes
npm run watch
```

## Workflow

If you want to contribute to Oblyk, here's how we work:

Whether you have an idea or want to fix a bug, the best way to start is to make an issue,
on this issue we discuss how to do (code, design, etc.) so as not to leave head down alone in his code ^^

When we agree and it seems good to launch the development we affect the issue (to avoid that two people develop the same module)

On our development environment we create a branch from the master (the name is free as long as it is explicit)

When the branch is ready, finished and tested locally, we push it on the repository and we open a pull request
Now we see if it's okay, we make changes if necessary.

Once the pull request has been validated

The branch will be merged on the beta version of oblyk

we test if it works properly on the beta environment

If it's okay, we merge on the master.

and that's it! You contributed!
