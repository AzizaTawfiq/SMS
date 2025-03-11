<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getAdmin(){

        $return= self::select('users.*')->where('role', '=','1')
        ->where('is_deleted', '=','0');
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('created_at', '=', Request::get('email'));
        }
        $return= $return->orderBy('id', 'desc')
        ->paginate(1);

        return $return;
    }
     static public function getSingle($id){
        return self::find($id);
    }

    static public function getEmailSingle($email){
        return User::where('email', $email)->first();
    }


    static public function getStudent(){

        $return= self::select('users.*')->where('users.role', '=','3')
        ->where('users.is_deleted', '=','0');
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if(!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
        }
        if(!empty(Request::get('class_id'))) {
            $return = $return->where('users.class_id', '=', Request::get('class_id'));
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('caste'))) {
            $return = $return->where('users.caste', 'like', '%' . Request::get('caste') . '%');
        }
        if (!empty(Request::get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . Request::get('religion') . '%');
        }
        if (!empty(Request::get('mobile'))) {
            $return = $return->where('users.mobile', 'like', '%' . Request::get('mobile') . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $return = $return->where('users.blood_group', 'like', '%' . Request::get('blood_group') . '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('date_of_birth'))) {
            $return = $return->whereDate('users.date_of_birth', '=', Request::get('date_of_birth'));
        }
        if (!empty(Request::get('height'))) {
            $return = $return->where('users.height', 'like', '%' . Request::get('height') . '%');
        }
        if (!empty(Request::get('weight'))) {
            $return = $return->where('users.weight', 'like', '%' . Request::get('weight') . '%');
        }
        if (!empty(Request::get('status'))) {
            $status= (Request::get('status')) == 100 ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('created_at'));
        }


        $return= $return->orderBy('users.id', 'desc')
        ->paginate(10);

        return $return;
    }

    public function getProfile(){
        if(!empty($this->profile_pic && file_exists('upload/profile/'.$this->profile_pic))){
            return url('upload/profile/'.$this->profile_pic);
        } else {
            return "";
        }
}

}
