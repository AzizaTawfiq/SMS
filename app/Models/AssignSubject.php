<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;
    protected $table = 'subject_school_class';
    protected $fillable = ['schoolclass_id','subject_id','status','user_id'];
}
