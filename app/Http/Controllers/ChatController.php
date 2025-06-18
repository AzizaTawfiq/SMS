<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChatModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $data['header_title' ]= 'My chat';
        $sender_id = Auth::user()->id;
        if(!empty($request->receiver_id)){
         $receiver_id = base64_decode($request->receiver_id);
         if($receiver_id == $sender_id){
            return redirect()->back()->with('error','Something went wrong, please try again');
            exit();
         }
         ChatModel::updateCount( $sender_id, $receiver_id);
         $data['getReceiver']= User::getSingle($receiver_id);
         $data['getChat']= ChatModel::getChat($receiver_id, $sender_id);
        }
        $data['getChatUser']= ChatModel::getChatUser( $sender_id);
        return view('chat.list', $data);
    }

    public function submit_message(Request $request){
        $sender_id = Auth::user()-> id;
        $receiver_id = $request-> receiver_id;
        $message = $request-> message;
        $chat = new ChatModel();
        $chat-> sender_id = $sender_id;
        $chat-> receiver_id = $receiver_id;
        $chat-> message = $message;
        $chat-> created_date = time();
        $chat-> save();
        $getChat= ChatModel::where('id',"=", $chat->id)->get();
        return response()->json([
            'status' => true,
            'success' => view('chat._single', [
                'getChat' => $getChat,

            ])->render(),
        ],200);

    }

    public function get_chat_windows(Request $request){
        $receiver_id = $request-> receiver_id;
        $sender_id = Auth::user()-> id;
        ChatModel::updateCount( $sender_id, $receiver_id);
        $getReceiver= User::getSingle($receiver_id);
        $getChat= ChatModel::getChat($receiver_id, $sender_id);
        return response()->json([
           'status' => true,
           'success' => view('chat._message', [
            'getReceiver' => $getReceiver,
            'getChat' => $getChat,
          ])->render(),
        ],200);
    }

}
