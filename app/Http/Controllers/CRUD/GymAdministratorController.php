<?php

namespace App\Http\Controllers\CRUD;

use App\Gym;
use App\GymAdministrator;
use App\Http\Controllers\Controller;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TomLingham\Searchy\Facades\Searchy;

class GymAdministratorController extends Controller
{

    public function gymAddAdministratorModal($gym_id){
        return view('modal.gym-administrator', ['gym' => Gym::find($gym_id)]);
    }


    function gymSearchAdministrator($gym_id, $name){

        $user_ids = GymAdministrator::where('gym_id',$gym_id)->pluck('user_id');
        $users = Searchy::search('users')->fields('name', 'email')->query($name)->getQuery()->whereNotIn('id', $user_ids)->limit(20)->get();

        $data = ['users' => $users];

        return view('modal.gym-administrator-users', $data);
    }

    public function addAdministrator(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $gym = Gym::find($request->input('gym_id'));

        $new_administrator = new GymAdministrator();
        $new_administrator->user_id = $user->id;
        $new_administrator->gym_id = $gym->id;
        $new_administrator->save();

        $notification = new Notification();
        $notification->type = 'new_administrator';
        $notification->user_id = $user->id;
        $notification->data = Notification::jsonData(
            'new_administrator',
            $gym->label,
            '/storage/gyms/100/logo-' . $gym->id . '.png',
            [
                route('gym_admin_home', ['gym_id'=>$gym->id, 'gym_label'=>str_slug($gym->label)]),
                $gym->label
            ],
            null
        );
        $notification->save();

        return response()->json(json_encode($new_administrator));
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    function destroy($id){
        $gymAdministrator = GymAdministrator::find($id);
        $this->checkIsAdmin($gymAdministrator->gym_id);
        $gymAdministrator->delete();
    }

    /**
     * @param $gym_id
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function checkIsAdmin ($gym_id){

        $isAdministrator = GymAdministrator::where([['user_id', Auth::id()], ['gym_id',$gym_id]])->exists();
        if(!$isAdministrator) {
            return redirect()->route('index');
        }
        return true;
    }
}
