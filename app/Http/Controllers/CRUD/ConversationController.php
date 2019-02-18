<?php

namespace App\Http\Controllers\CRUD;

use App\Conversation;
use App\Mail\sendConversation;
use App\Message;
use App\User;
use App\UserConversation;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function conversationModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_conversation = $request->input('conversation_id');
        $conversation = isset($id_conversation) ? Conversation::where('id', $id_conversation)->first() : new Conversation();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        $user_id = $request->input('user_id');
        $user_id = isset($user_id) ? $request->input('user_id') : '';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/conversations' : '/conversations/' . $id_conversation;

        $data = [
            'dataModal' => [
                'label' => $conversation->label,
                'id' => $id_conversation,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'user_id' => $user_id,
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.conversation', $data);
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
            'label' => 'required|max:255',
        ]);

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

            //on envoi un mail à l'intéréssé (s'il est d'accord)
            $destinatairUser = User::where('id', $request->input('user_id'))->with('settings')->first();
            $expediteurUser = User::where('id', Auth::id())->first();
            if($destinatairUser->settings->mail_new_conversation == 1){
                $data = [
                    'user'=>$destinatairUser,
                    'slug_name'=>str_slug($destinatairUser->name),
                    'conversation'=>$conversation,
                    'expeditaire'=>$expediteurUser,
                ];
                Mail::to($destinatairUser->email)->send(new sendConversation($data));
            }
        }

        //conversation avec moi
        $userConversation = new UserConversation();
        $userConversation->user_id = Auth::id();
        $userConversation->conversation_id = $conversation->id;
        $userConversation->save();

        return response()->json(json_encode($conversation));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //enregistrement des données
        $conversation = Conversation::where('id', $request->input('id'))->first();
        $conversation->label = $request->input('label');
        $conversation->save();

        return response()->json(json_encode($conversation));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @throws \Exception
     */
    public function destroy($id)
    {

        //suppression des user conversation liée
        $userConversations = UserConversation::where('conversation_id', $id)->get();
        foreach ($userConversations as $userConversation){
            $userConversation->delete();
        }

        //suppression des messages liés
        $messages = Message::where('conversation_id', $id)->get();
        foreach ($messages  as $message){
            $message->delete();
        }

        //suppression de la conversation
        $conversation = Conversation::where('id', $id)->first();
        $conversation->delete();
    }

}
