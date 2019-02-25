<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{

    // Display generic delete modal
    function deleteModal(Request $request)
    {
        $callback = $request->input('callback');
        $callback = isset($callback) ? $callback : 'refresh';
        $resource = explode('/', $request->input('route'));

        $data = [
            'dataModal' => [
                'id' => $request->input('id'),
                'route' => $request->input('route'),
                'resource' => $resource[1] ?? null,
                'callback' => $callback
            ]
        ];
        return view('modal.delete', $data);
    }
}
