<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SettingsModel extends Model
{
    use HasFactory;
    protected $table = 'settings';
    static public function getSingle()
    {
        return self::find(1);
    }

}
