<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Major;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hospital::all();
        return view('admin.hospitals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Major::all();
        return view('admin.hospitals.create',compact('majors'));
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
            'location' => 'required|string',
            'info' => 'nullable|string',
            'is_active' => 'in:on|string',
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);
        $hospital = new Hospital();
        $hospital->name = $request->get('name');
        $hospital->location = $request->get('location');
        $hospital->info = $request->get('info');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time().$hospital->name.'.'. $image->getClientOriginalExtension();
            $request->file('cover')->storePubliclyAs('hospitals', $imagename , ['disk'=>'public']);
            $hospital->cover = $imagename;
        }
        $hospital->is_active = $request->has('is_active');
        $saved = $hospital->save();
        $hospital->majors()->attach($request->get('majors'));
        if ($saved) {
            session()->flash('message','hospital created successfuly');
            return redirect()->route('hospitals.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hospital = Hospital::find($id);
        return view('admin.hospitals.edit',compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'info' => 'nullable|string',
            'is_active' => 'in:on|string',
            'cover' => 'nullable|image|mimes:jpg,png'

        ]);
        $hospital= Hospital::find($id);
        $hospital->name = $request->get('name');
        $hospital->location = $request->get('location');
        $hospital->info = $request->get('info');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time().$hospital->name.'.'. $image->getClientOriginalExtension();
            $request->file('cover')->storePubliclyAs('hospitals', $imagename , ['disk'=>'public']);
            $hospital->cover = $imagename;
        }
        $hospital->is_active = $request->has('is_active');
        $saved = $hospital->save();
        if ($saved) {
            session()->flash('message','hospital updated successfuly');
            return redirect()->route('hospitals.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = Hospital::find($id);
        Storage::disk('public')->delete("hospitals/$item->cover");
        $deleted = $item->delete();
        if ($deleted) {
            session()->flash('message', 'hospital deleted successfuly');
            return redirect()->back();
        } else {
            return 'error';
        }
    }
}
