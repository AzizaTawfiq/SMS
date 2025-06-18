<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use DB;

class ChatModel extends Model
{
    use HasFactory;
    protected $table = 'chat';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getChat($receiver_id, $sender_id){
        $query = self::select('chat.*')
            ->where(function($q) use ($receiver_id, $sender_id){
                $q->where(function($q) use ($receiver_id, $sender_id){
                    $q->where('sender_id', $receiver_id)
                      ->where('receiver_id', $sender_id)
                      ->where('status', '>', '-1');
                })->orWhere(function($q) use ($receiver_id, $sender_id){
                    $q->where('sender_id', $sender_id)
                      ->where('receiver_id', $receiver_id);
                });
            })
            -> where('message', '!=', '')
            ->orderBy('id', 'asc')
            ->get();

        return $query;
    }

    static public function getChatUser($user_id){
        $getUserChat = self::select('chat.*', DB::raw('(CASE WHEN chat.sender_id = "'.$user_id.'"
        THEN chat.receiver_id ELSE chat.sender_id END) AS connect_user_id'))
            ->join('users as sender', 'sender.id', '=', 'chat.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'chat.receiver_id')
            ->where(function($q) use ($user_id){
                $q->where('chat.sender_id', '=', $user_id)
                  ->orWhere(function($q) use ($user_id){
                      $q->where('chat.receiver_id', '=', $user_id)
                        ->where('chat.status', '>', -1);
                  });
            })
            ->orderBy('chat.id', 'desc')
            ->get();

        $result = array();
        $processedUsers = array(); // To keep track of processed users

        foreach($getUserChat as $val){
            $connectUserId = $val->connect_user_id;

            // Skip if we already processed this user
            if(in_array($connectUserId, $processedUsers)) {
                continue;
            }

            $processedUsers[] = $connectUserId;

            $data = array();
            $data['id'] = $val->id;
            $data['message'] = $val->message;
            $data['created_date'] = $val->created_at;
            $data['user_id'] = $connectUserId;
            $data['name'] = $val->getConnectUser->name.' '.$val->getConnectUser->last_name;
            $data['profile_pic'] = $val->getConnectUser->getProfileDirect();
            $data['messageCount'] = $val->countMessage($connectUserId, $user_id);

            $result[] = $data;
        }
        return $result;
    }

    public function getSender(){
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function getReceiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function getConnectUser(){
        return $this->belongsTo(User::class, 'connect_user_id');
    }

    static public function countMessage($connect_user_id, $user_id){
        return self::where('sender_id','=', $connect_user_id)
        ->where('receiver_id','=', $user_id)
        ->where('status','=', 0)
        ->count();

    }

    static public function updateCount($sender_id,$receiver_id ){
        return self::where('sender_id','=', $receiver_id)
        ->where('receiver_id','=', $sender_id)
        ->where('status','=', 0)
        ->update((['status'=> '1']));

    }


}
