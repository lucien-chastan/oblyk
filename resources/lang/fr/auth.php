<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Ces identifiants ne correspondent pas à nos enregistrements',
    'throttle' => 'Trop de tentatives de connexion. Veuillez essayer de nouveau dans :seconds secondes.',

    //Page de connexion
    'titleConnect' => 'Connexion',
    'labelEmail' => 'Adresse e-mail',
    'labelPassword' => 'Mot de passe',
    'labelRemember' => 'Se souvenir de moi',
    'labelNewsletter' => 'Recevoir la news letter (environ une par mois)',
    'btnForgotPassword' => 'Mot de passe oublié ?',
    'btnConnect' => 'Connexion',
    'btnCreateAccount' => 'Pas de compte ?',
    'noteOldUser' => '
        <strong>* Note aux anciens utilisateurs d\'oblyk :</strong><br>
        Depuis la version 3 d\'oblyk (paru vers septembre 2017) nous avons renforcé la sécurité des mots de passe. Si c\'est votre première connexion sur cette nouvelle version, vous allez sûrement devoir passer par la procédure <a href=":routeForgotten">"Mot de passe oublié"</a> pour accéder à votre compte.<br>
        Merci de votre compréhension !',
    'signatureOldUser'=>'L\'ékip d\'Oblyk',

    //Page créer un compte
    'titleCreateAccount' => 'Créer un compte',
    'labelUsername' => 'Nom d\'utilisateur',
    'labelConfirmPassword' => 'Confirmer votre mot de passe',
    'btnCreateMyAccount' => 'Créer mon compte',
    'btnIHaveAAccount' => 'J\'ai déjà un compte !',

    //Page mon mail pour nouveau mot de passe
    'titleResetPassword' => 'Mot de passe oublié',
    'btnSendPasswordResetLink' => 'Réinitialiser mon mot de passe',

    //Page pour changer le mot de passe
    'btnRestPassword' => 'Changer mon mot de passe',

    //Email de réinitialisation du mot de passe
    'resetMailSubject'=>'Oblyk, réinitialiser votre mot de passe',
    'resetMailIntro'=>'Vous recevez ce email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.',
    'resetMailAction'=>'Réinitialiser mon mot de passe',
    'resetMailNoAction'=>'Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune autre action n\'est requise.',
];
