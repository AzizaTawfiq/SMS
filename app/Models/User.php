<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

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
        'status',
        'profile_pic',
        'admission_number',
        'roll_number',
        'class_id',
        'gender',
        'mobile_number',
        'height',
        'weight',
        'blood_group',
        'religion',
        'caste',
        'admission_date',
        'date_of_birth',
        'date_of_birth',
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

    static public function getAdmin()
    {

        $return = self::select('users.*')->where('role', '=', '1')
            ->where('is_deleted', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name'). '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('created_at'));
        }
        $return = $return->orderBy('id', 'desc')
            ->paginate(10);

        return $return;
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getSingleClass($id){
        return self::select('users.*', 'school_classes.amount', 'school_classes.name as class_name')
        ->join('school_classes', 'school_classes.id', '=', 'users.class_id')
        ->where('users.id', '=', $id)
        ->first();
    }

    static public function getTotalUser($role)
    {
        return self::select('users.id')
                ->where('role', '=', $role)
                ->where('is_deleted', '=', 0)
                ->count();

    }

    static public function getEmailSingle($email)
    {
        return User::where('email', $email)->first();
    }

    public function school_class()
    {
        return $this->hasMany(School_Class::class);
    }


    static public function getStudent()
    {

        $return = self::select('users.*')->where('users.role', '=', '3')
            ->where('users.is_deleted', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name'). '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number'). '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number'). '%');
        }
        if (!empty(Request::get('class_id'))) {
            $return = $return->where('users.class_id', '=', Request::get('class_id'));
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('caste'))) {
            $return = $return->where('users.caste', 'like', '%' . Request::get('caste'). '%');
        }
        if (!empty(Request::get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . Request::get('religion'). '%');
        }
        if (!empty(Request::get('mobile'))) {
            $return = $return->where('users.mobile', 'like', '%' . Request::get('mobile'). '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $return = $return->where('users.blood_group', 'like', '%' . Request::get('blood_group'). '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('date_of_birth'))) {
            $return = $return->whereDate('users.date_of_birth', '=', Request::get('date_of_birth'));
        }
        if (!empty(Request::get('height'))) {
            $return = $return->where('users.height', 'like', '%' . Request::get('height'). '%');
        }
        if (!empty(Request::get('weight'))) {
            $return = $return->where('users.weight', 'like', '%' . Request::get('weight'). '%');
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status')) == 100 ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('created_at'));
        }


        $return = $return->orderBy('users.id', 'desc')
            ->paginate(10);

        return $return;
    }
    static public function getStudentClass($class_id)
    {
        return self::select('users.id','users.name','users.last_name')
        ->where('users.role', '=', '3')
        ->where('users.is_deleted', '=', 0)
        ->where('users.class_id', '=', $class_id)
        ->orderBy('users.id', 'desc')
            ->get();
    }
    static public function getTeacherStudents($teacher_id)
    {
        $return = self::select('users.*',"school_classes.name as class_name")->
        join('school_classes', 'school_classes.id', '=', 'users.class_id')->
        join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'school_classes.id')->
        where('assign_class_teacher.teacher_id', '=', $teacher_id)->
        where('assign_class_teacher.is_deleted', '=', 0)->
        where('assign_class_teacher.status', '=', 0)->
        where('users.role', '=', '3')
        ->where('users.is_deleted', '=', 0);
        $return = $return->orderBy('users.id', 'desc')->groupBy('users.id')
            ->paginate(10);

        return $return;
    }
    static public function getTeacherStudentsCount($teacher_id)
    {
        $return = self::select('users.id')
        ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'users.class_id')
        ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
        ->where('assign_class_teacher.is_deleted', '=', 0)
        ->where('assign_class_teacher.status', '=', 0)
        ->where('users.role', '=', '3')
        ->where('users.is_deleted', '=', 0);
        return $return->count();
    }
    static public function getTeacher()
    {

        
        $return = self::select('users.*')->where('users.role', '=', '2')
            ->where('users.is_deleted', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name'). '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name'). '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('mobile'))) {
            $return = $return->where('users.mobile', 'like', '%' . Request::get('mobile'). '%');
        }
        if (!empty(Request::get('marital_status'))) {
            $return = $return->where('users.marital_status', 'like', '%' . Request::get('marital_status'). '%');
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('users.address', 'like', '%' . Request::get('address'). '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status')) == 100 ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('created_at'));
        }


        $return = $return->orderBy('users.id', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getParent()
    {

        $return = self::select('users.*')->where('role', '=', '4')
            ->where('is_deleted', '=', 0);
        $return = $return->orderBy('id', 'desc')
            ->paginate(20);

        return $return;
    }

    public function getProfile()
    {
        if (!empty($this->profile_pic && file_exists('upload/profile/' . $this->profile_pic))) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return url('upload/profile/user.jpg');
        }
    }
    public function getProfileDirect()
    {
        if (!empty($this->profile_pic && file_exists('upload/profile/' . $this->profile_pic))) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return "upload/profile/user.jpg";
        }
    }


    static public function getSearchstudent()
    {
        if (!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('email'))) {

            $return = self::select('users.*', 'class-num as class_name')
                ->leftJoin('class', 'class.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', '=', 3)
                ->where('users.is_deleted', '=', 0);

            if (!empty(Request::get('id'))) {
                $return = $return->where('users.id', 'like', Request::get('id'));
            }

            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%' . Request::get('name'). '%');
            }


            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
            }

            $return = $return->orderBy('users.id', 'desc')
                ->limit(60)
                ->get();

            return $return;
        }
    }

    static public function getMyStudent($parent_id)
    {
        $return = self::select(
            'users.*',
            'class.class-num as class_name',
            'parent.name as parent_name'
        )
            ->join('users as parent', 'parent.id', '=', 'users.parent_id')
            ->leftJoin('class', 'class.id', '=', 'users.class_id')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
            ->where('users.is_deleted', '=', 0)
            ->orderBy('users.id', 'desc')
            ->get();

        return $return;
    }

    static public function getTeacherClass()
    {
        $return = self::select('users.*')->where('role', '=', '2')
        ->where('is_deleted', '=', 0);
    $return = $return->orderBy('id', 'desc')
        ->get();

    return $return;
    }

    // get user name by user id in blade
    public static function getNameById($id)
    {
        $user = self::find($id);
        return $user ? $user->name : 'Unknown User';
    }

    public static function getAttendance($student_id, $class_id, $attendance_date){
        return StudentAttendanceModel::checkAlreadyAttendance($student_id, $class_id, $attendance_date);
    }

    static public function getStudentCollectFees()
    {

        $return = self::select('users.*', 'school_classes.name as class_name','school_classes.amount')
        ->join('school_classes','school_classes.id', '=', 'users.class_id')
        ->where('users.role', '=', 3)
        ->where('users.is_deleted', '=', 0);
        if (!empty(Request::get('class_id'))) {
            $return = $return->where('users.class_id', 'like', '%' . Request::get('class_id'). '%');
        }
        if (!empty(Request::get('student_name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('student_name'). '%');
        }

        $return = $return->orderBy('users.name', 'asc')
            ->paginate(10);

        return $return;
    }

    static public function getPaidAmount($student_id, $class_id){
        return FeesStudentModel::getPaidAmount($student_id, $class_id);
    }

}
