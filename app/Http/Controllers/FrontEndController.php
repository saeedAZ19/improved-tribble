<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Major;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function home(){
        $hospitals = Hospital::where('is_active','1')->get();
        $majors = Major::where('is_active', '1')->get();
        $doctors = Doctor::all();
        return view('frontend.home',compact('hospitals','majors', 'doctors'));
    }
}
