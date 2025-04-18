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
}
