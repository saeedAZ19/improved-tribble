<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    // protected $fillable = ['name','is_active','location'];
    public function majors(){
        return $this->belongsToMany(Major::class,'hospital_major','hospital_id','major_id');
    }
    public function getActiveStatusAttribute(){
        return $this->is_active ? 'Active' : 'Not Active' ;
    }
    protected $hidden = ['created_at','updated_at'];
    protected $appends = ['active_status'];
}
