<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subjects';
    protected $fillable = ['name','type','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject(){
        return $this->hasMany(Subject::class);
    }

    public function school_class()
    {
    return $this->belongsToMany(School_Class::class,'subject_school_class','schoolclass_id','subject_id');
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
}
