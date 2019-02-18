<?php

namespace App\Http\Controllers\CRUD;

use App\Notification;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    function notificationAsRead(Request $request){

        $notification = Notification::where('id', $request->input('id'))->first();

        if($notification->user_id == Auth::id()){
            $notification->read = $request->input('read');
            $notification->read_at = Carbon::now();
            $notification->save();
        }

        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notification = Notification::where('id', $id)->first();
        $oldNotification = $notification;

        if($notification->user_id == Auth::id()){
            $notification->delete();
        }

        return response()->json(json_encode($oldNotification));
    }

}
