<?php

namespace App\Http\Controllers\Auth;

use App\Mail\sendWelcome;
use App\oldSearch;
use App\Subscriber;
use App\User;
use App\Http\Controllers\Controller;
use App\UserPartnerSettings;
use App\UserSettings;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     * @throws \Exception
     */
    protected function create(array $data)
    {

        //Création du user
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        if (isset($data['newsletter'])) {
            Subscriber::firstOrCreate(['email' => $user->email]);
        } else {
            // the new user was perhaps already registered but no longer wishes to receive the news letter
            Subscriber::where('email', $user->email)->delete();
        }

        //On créer la table des paramètres pour cet utilisateur
        $setting = New UserSettings();
        $setting->user_id = $user->id;
        $setting->save();

        $partner = New UserPartnerSettings();
        $partner->user_id = $user->id;
        $partner->save();

        // welcome email
        Mail::to($user->email)->send(new sendWelcome(['user' => $user]));

        return $user;
    }
}
