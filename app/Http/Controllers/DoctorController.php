<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Doctor::all();
        return view('admin.doctors.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('admin.doctors.create',compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'hospital_id' => 'required',
            'email' => 'required|string',
            'phone' => 'required|string|min:9',
            'descrption' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);
        $doctor = new Doctor();
        $doctor->name = $request->get('name');
        $doctor->hospital_id = $request->get('hospital_id');
        $doctor->email = $request->get('email');
        $doctor->phone = $request->get('phone');
        $doctor->descrption = $request->get('descrption');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $doctor->name . '.' . $image->getClientOriginalExtension();
            $request->file('cover')->storePubliclyAs('doctors', $imagename, ['disk' => 'public']);
            $doctor->cover = $imagename;
        }
        // $doctor->is_active = $request->has('is_active');
        $saved = $doctor->save();
        if ($saved) {
            session()->flash('message', 'Doctor created successfuly');
            return redirect()->route('doctors.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $hospitals = Hospital::all();
        return view('admin.doctors.edit',compact('doctor','hospitals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string',
            'hospital_id' => 'required',
            'email' => 'required|string',
            'phone' => 'required|string|min:9',
            'descrption' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);
        $doctor->name = $request->get('name');
        $doctor->hospital_id = $request->get('hospital_id');
        $doctor->email = $request->get('email');
        $doctor->phone = $request->get('phone');
        $doctor->descrption = $request->get('descrption');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $doctor->name . '.' . $image->getClientOriginalExtension();
            $request->file('cover')->storePubliclyAs('doctors', $imagename, ['disk' => 'public']);
            $doctor->cover = $imagename;
        }
        // $doctor->is_active = $request->has('is_active');
        $saved = $doctor->save();
        if ($saved) {
            session()->flash('message', 'Doctor updated successfuly');
            return redirect()->route('doctors.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        Storage::disk('public')->delete("doctors/$doctor->cover");
        $deleted = $doctor->delete();
        if ($deleted) {
            session()->flash('message', 'hospital deleted successfuly');
            return redirect()->back();
        } else {
            return 'error';
        }
    }
}
