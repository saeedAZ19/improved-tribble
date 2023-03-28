<?php

namespace App\Models;

use App\Mail\WellcomeMAil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory , HasRoles;
    protected static function booted()
    {
        // static::created(function(){
        //     // Mail::to("yahya@gmail.com")->send(new WellcomeMAil());
        // });
        // static::creating();
    }
}
