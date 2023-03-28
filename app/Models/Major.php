<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    public function hospitals(){
        return $this->belongsToMany(Hospital::class);
    }
    public function getActiveStatusAttribute()
    {
        return $this->active ? 'فعال' : 'غير فعال';
    }
}
