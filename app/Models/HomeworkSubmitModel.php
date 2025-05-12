<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class HomeworkSubmitModel extends Model
{
    use HasFactory;
    protected $table = 'homework_submit';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord(){
         $return = self::select('homework_submit.*','users.name as created_name')->
         join('users', 'users.id', '=', 'homework_submit.created_by');
         if (!empty(Request::get('name'))) {
            $return = $return->where('homework_submit.name', 'like', '%' . Request::get('name'). '%');
        }
        if (!empty(Request::get('note'))) {
            $return = $return->where('homework_submit.note', 'like', '%' . Request::get('note'). '%');
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('homework_submit.created_at', '=', Request::get('created_at'));
        }
         $return = $return-> where('homework_submit.is_deleted', '=', 0)->
         orderBy('homework_submit.id','desc')->paginate(20);
         return $return;
    }


}
