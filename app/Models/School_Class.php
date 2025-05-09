<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School_Class extends Model
{
    use HasFactory;
    protected $table = 'school_classes';
    protected $fillable = ['name', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class,'subject_school_class','schoolclass_id','subject_id')->withPivot('status','user_id','created_at','updated_at');
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

}
