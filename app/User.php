<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentInfo;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
         return $this->belongsTo(Role::class,'role_id');
    }


    /**Created by Moinul  */
    public function students()
    {
        return $this->hasOne(Student::class,'user_id','id')->whereNull('deleted_at')->where('activate_status',1);
    }
    public function studentInfo()
    {
        return $this->hasOne(StudentInfo::class,'user_id','id')->where('status',1);
    }
    public function deactiveStudents()
    {
        return $this->hasMany(Student::class,'user_id','id')->whereNull('deleted_at')->where('activate_status',2);
    }
    /**Created by Moinul  */







}
