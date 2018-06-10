<?php

namespace App\Http\Controllers\CRUD;

use App\Gym;
use App\GymAdministrator;
use App\Mail\sendManagerConfirmation;
use App\Mail\sendManagerRequest;
use App\oldSearch;
use App\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Mockery\Exception;



class GymController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE SALLE
    function gymModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $gym = Gym::where('id', $id)->first();
            $callback = 'refresh';
        }else{
            $gym = new Gym();
            $gym->lat = $request->input('lat');
            $gym->lng = $request->input('lng');
            $gym->code_country = 'NC';
            $gym->country = 'Inconnu';
            $callback = 'goToNewGym';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/gyms' : '/gyms/' . $id;

        $data = [
            'dataModal' => [
                'gym' => $gym,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.gym', $data);
    }

    // DISPLAY MANAGER POPUP
    function managerModal(Request $request){
        return view('modal.gym-manager', ['gym_id' => $request->input('gym_id')]);
    }

    public function sendManagerRequest(Request $request)
    {

        $user = Auth::user();
        $data = [
            'gym' => Gym::find($request->input('gym_id')),
            'user' => $user,
            'email' => $request->input('email'),
            'justification' => $request->input('justification'),
            'user_id' => Auth::id()
        ];

        Mail::to('ekip@oblyk.org')->send(new sendManagerRequest($data));

        Mail::to($user->email)->send(new sendManagerConfirmation($data));
    }


    //Upload du bandeau et du logo
    function uploadLogoBandeau (Request $request){

        //validation du formulaire
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        $gym = Gym::where('id', $request->input('id'))->first();

        //Upload du logo
        if ($request->hasFile('logo')) {

            try {
                //Logo en 100px de haut
                $img = Image::make($request->file('logo'))
                    ->orientate()
                    ->resize(null, 100, function ($constraint) {$constraint->aspectRatio();})
                    ->encode('png', 90)
                    ->save(storage_path('app/public/gyms/100/logo-' . $gym->id . '.png'));

                //Logo en 50px de haut
                $img->resize(null, 50, function ($constraint) {$constraint->aspectRatio();})
                    ->save(storage_path('app/public/gyms/50/logo-' . $gym->id . '.png'));

            }catch (Exception $e){

                //s'il y a un problème on supprime les images potentiellement uploadé
                if(file_exists(storage_path('app/public/gyms/100/logo-' . $gym->id . '.png'))) unlink(storage_path('pp/public/gyms/100/logo-' . $gym->id . '.png'));
                if(file_exists(storage_path('app/public/gyms/50/logo-' . $gym->id . '.png'))) unlink(storage_path('pp/public/gyms/50/logo-' . $gym->id . '.png'));

            }
        }

        //Upload du bandeau
        if ($request->hasFile('bandeau')) {

            try {
                //Bandeau en 1300px de large
                $img = Image::make($request->file('bandeau'))
                    ->orientate()
                    ->resize(1300, null, function ($constraint) {$constraint->aspectRatio();})
                    ->encode('jpg', 85)
                    ->save(storage_path('app/public/gyms/1300/bandeau-' . $gym->id . '.jpg'));

                //Bandeau en 200px de haut
                $img->resize(null, 200, function ($constraint) {$constraint->aspectRatio();})
                    ->save(storage_path('app/public/gyms/200/bandeau-' . $gym->id . '.jpg'));

            }catch (Exception $e){

                //s'il y a un problème on supprime les images potentiellement uploadé
                if(file_exists(storage_path('app/public/gyms/1300/bandeau-' . $gym->id . '.jpg'))) unlink(storage_path('pp/public/gyms/1300/bandeau-' . $gym->id . '.jpg'));
                if(file_exists(storage_path('app/public/gyms/200/bandeau-' . $gym->id . '.jpg'))) unlink(storage_path('pp/public/gyms/200/bandeau-' . $gym->id . '.jpg'));

            }
        }

        return redirect()->route('gymPage', ['gym_id'=>$gym->id, 'gym_label'=>str_slug($gym->label)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //see modal controller
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation du formulaire
        $this->validate($request, [
            'label' => 'required|String|max:255',
            'city' => 'required|String|max:255',
            'big_city' => 'required|String|max:255',
            'postal_code' => 'required|String|max:10',
            'country' => 'required|String|max:255',
            'region' => 'required|String|max:255'
        ]);

        //information sur la falaise
        $gym = new Gym();
        $gym->user_id = Auth::id();
        $gym->label = $request->input('label');
        $gym->description = $request->input('description');
        $gym->type_boulder = $request->input('type_boulder');
        $gym->type_route = $request->input('type_route');
        $gym->free = 1;
        $gym->address = $request->input('address');
        $gym->postal_code = $request->input('postal_code');
        $gym->code_country = $request->input('code_country');
        $gym->country = $request->input('country');
        $gym->city = $request->input('city');
        $gym->big_city = $request->input('big_city');
        $gym->region = $request->input('region');
        $gym->lat = $request->input('lat');
        $gym->lng = $request->input('lng');
        $gym->email = $request->input('email');
        $gym->phone_number = $request->input('phone_number');
        $gym->web_site = $request->input('web_site');
        $gym->save();
        $gym->slug = str_slug($gym->label);


        return response()->json(json_encode($gym));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //see modal controller
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validation du formulaire
        $this->validate($request, [
            'label' => 'required|String|max:255',
            'city' => 'required|String|max:255',
            'big_city' => 'required|String|max:255',
            'postal_code' => 'required|String|max:10',
            'country' => 'required|String|max:255',
            'region' => 'required|String|max:255'
        ]);

        //mise à jour des données de la falaise
        $gym = Gym::where('id', $request->input('id'))->first();

        $gym->label = $request->input('label');
        $gym->description = $request->input('description');
        $gym->type_boulder = $request->input('type_boulder');
        $gym->type_route = $request->input('type_route');
        $gym->address = $request->input('address');
        $gym->postal_code = $request->input('postal_code');
        $gym->city = $request->input('city');
        $gym->big_city = $request->input('big_city');
        $gym->region = $request->input('region');
        $gym->email = $request->input('email');
        $gym->phone_number = $request->input('phone_number');
        $gym->web_site = $request->input('web_site');
        $gym->lat = $request->input('lat');
        $gym->lng = $request->input('lng');
        $gym->save();

        return response()->json(json_encode($gym));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
