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

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    //Page de connexion
    'titleConnect' => 'Connect',
    'labelEmail' => 'E-mail address',
    'labelPassword' => 'Password',
    'labelRemember' => 'Remember me',
    'btnForgotPassword' => 'Password forgotten ?',
    'btnConnect' => 'Log in',
    'btnCreateAccount' => 'Create an account',
    'noteOldUser' => '
        <strong>* Note to former oblyk users :</strong><br>
        Since the 3rd version of Oblyk (release on September 2017) we had upgraded the password security. If it is your first connection to the new oblyk version, you must use the <a href=":routeForgotten">"Password forgotten"</a> procedure to access your account.<br>
        Thanks !',
    'signatureOldUser'=>'Oblyk team',

    //Page créer un compte
    'titleCreateAccount' => 'Join us',
    'labelUsername' => 'User name',
    'labelConfirmPassword' => 'Confirm password',
    'btnCreateMyAccount' => 'Join us',
    'btnIHaveAAccount' => 'Connect',

    //Page mon mail pour nouveau mot de passe
    'titleResetPassword' => 'Reset password',
    'btnSendPasswordResetLink' => 'Send password reset link',

    //Page pour changer le mot de passe
    'btnRestPassword' => 'Reset Password',

    //Email de réinitialisation du mot de passe
    'resetMailSubject'=>'Oblyk, reset your password',
    'resetMailIntro'=>'You are receiving this email because we received a password reset request for your account.',
    'resetMailAction'=>'Reset Password',
    'resetMailNoAction'=>'If you did not request a password reset, no further action is required.',
];
