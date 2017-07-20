# Les dashboxs

**Pour ajouter une dashbox :**

1. créer une vue `.blade.php` dans `/pages/profile/vues/dashboardBox/boxVues` de ce que vous voulez afficher
2. créer une `function` dans le controller `Vue/UserVueController` pour envoyer les données à la vue
3. ajouter une route dans le fichier `web.php` (dans la partie sub_vue du profil)
4. ajouter un champs dans la table user_settings avec le nom de votre option et le préfixe `dash_`
5. ajouter un `@if` dans la vue `/pages/profile/vues/dashboardVue`
6. ajouter une blue-border-div à la vue `/pages/profile/partials/settings/dashboardSettings`
7. ajouter une ligne d'enregistrement dans `CRUD/UserController` function : `saveSettings()`