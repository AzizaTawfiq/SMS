<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class NoticeBoardMessageModel extends Model
{
    use HasFactory;
    protected $table = 'notice_board_message';
    public $timestamps = false;
    static public function getSingle($id)
    {
        return self::find($id);
    }

static public function deleteRecord($id)
{
    NoticeBoardMessageModel::where('notice_board_id', $id)->delete();
}
}