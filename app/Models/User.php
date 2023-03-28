<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
    ];
    // one to one
    // public function profile(){
    //     return $this->hasOne(Profile::class)
    // }
    // public function user(){
    //     return $this->belongsTo(User::class,'user_id' , 'id');
    // }
    // one to many
    // public function empolyies(){
    //     return $this->hasMany(Empolye::class)
    // }
    // public function department(){
    //     return $this->belongsTo(Deparment::class);
    // }
    // pivot table
    //students & subjects
    // student_subject
    // subject_student
    // public function subjects(){
    //     return $this->belongsToMany(Subject::class,'student_id','id')
    // }
    //  public function sutudents(){
    //     return $this->belongsToMany(Student::class,'subject_id','id')
    // }
}
