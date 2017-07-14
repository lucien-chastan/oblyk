<?php

namespace App\Http\Controllers\CRUD;

use App\Conversation;
use App\Mail\sendConversation;
use App\User;
use App\UserConversation;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserConversationController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function userConversationModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_conversation = $request->input('conversation_id');
        $conversation = Conversation::where('id', $id_conversation)->first();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        $data = [
            'dataModal' => [
                'conversation' => $conversation,
                'id' => $id_conversation,
                'title' => $request->input('title'),
                'method' => 'POST',
                'route' => '/conversations',
                'callback' => $callback,
            ]
        ];

        return view('modal.userConversation', $data);
    }


    function userSearch($conversation_id, $search){

        //Liste les utilisateurs déjà dans la conversation (pour les éxculres de la recheche)
        $conversation = Conversation::where('id', $conversation_id)->with('userConversations')->first();
        $userInConversation = [];
        foreach ($conversation->userConversations as $userConversation){
            $userInConversation[] = $userConversation->user_id;
        }

        //RECHERCHE SUR LES UTILISATEURS
        $users = [];
        $findUsers = User::where('name','like','%' . $search . '%')
            ->whereNotIn('id',$userInConversation)
            ->orderBy('name', 'asc')->get();

        foreach ($findUsers as $user){
            $user->url = route('userPage', ['user_id'=>$user->id,'user_label'=>str_slug($user->name)]);

            if($user->sex == 0) $user->genre = "Indéfini";
            if($user->sex == 1) $user->genre = "Femme";
            if($user->sex == 2) $user->genre = "Homme";

            $user->age = $user->birth != 0 ? date('Y') - $user->birth : '?';
            $user->photo = file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg';

            $users[] = $user;
        }

        $data = [
            'search' => $search,
            'nombre' => [
                'users' => count($users),
            ],
            'users' => $users,
        ];

        return response()->json($data);
    }


    function addUser(Request $request){

        $user = User::where('id', $request->input('user_id'))->first();
        $userConversation = new UserConversation();
        $userConversation->user_id = $user->id;
        $userConversation->conversation_id = $request->input('conversation_id');
        $userConversation->save();

        //on envoi un mail à l'intéréssé (s'il est d'accord)
        $destinatairUser = User::where('id', $request->input('user_id'))->with('settings')->first();
        $expediteurUser = User::where('id', Auth::id())->first();
        if($destinatairUser->settings->mail_new_conversation == 1){
            $data = [
                'user'=>$destinatairUser,
                'slug_name'=>str_slug($destinatairUser->name),
                'expeditaire'=>$expediteurUser,
            ];
            Mail::to($destinatairUser->email)->send(new sendConversation($data));
        }

        return response()->json($user);

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

        //enregistrement des données
        $conversation = new Conversation();
        $conversation->label = $request->input('label');
        $conversation->save();

        //conversation avec l'autre
        if($request->input('user_id') != ''){
            $userConversation = new UserConversation();
            $userConversation->user_id = $request->input('user_id');
            $userConversation->conversation_id = $conversation->id;
            $userConversation->save();
        }

        //conversation avec moi
        $userConversation = new UserConversation();
        $userConversation->user_id = Auth::id();
        $userConversation->conversation_id = $conversation->id;
        $userConversation->save();

        return response()->json($conversation);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
