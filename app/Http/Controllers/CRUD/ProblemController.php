<?php

namespace App\Http\Controllers\CRUD;

use App\Mail\sendProblem;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{

    public function sendProblem(Request $request)
    {
        $data = [
            'model' => $request->input('model'),
            'id' => $request->input('id'),
            'page' => $request->input('page'),
            'email' => $request->input('email'),
            'problem' => $request->input('problem'),
            'user_id' => Auth::id()
        ];

        Mail::to('chastanlucien@gmail.com')->send(new sendProblem($data));
    }
}
