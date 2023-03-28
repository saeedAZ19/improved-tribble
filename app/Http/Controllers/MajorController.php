<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Major::all();
        return view('admin.majors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Validator = Validator($request->all(), [
            'name' => 'required|string',
            'is_active' => 'required|in:true,false|string',
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);
        if (!$Validator->fails()) {
            $major = new Major();
            $major->name = $request->get('name');
            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imagename = time() . $major->name . '.' . $image->getClientOriginalExtension();
                $request->file('cover')->storePubliclyAs('majors', $imagename, ['disk' => 'public']);
                $major->cover = $imagename;
            }
            $major->is_active = $request->get('is_active');
            $saved = $major->save();
            return response()->json([
                    'message' => $saved ? 'Major created successfully' : 'Fail creating major'
            ],$saved ? Response::HTTP_OK:Response::HTTP_BAD_REQUEST
        );
        }else{
            return response()->json([
                'message' => $Validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        return view('admin.majors.edit',compact('major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        $Validator = Validator($request->all(), [
            'name' => 'required|string',
            'is_active' => 'required|in:true,false|string',
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);
        if (!$Validator->fails()) {
            $major->name = $request->get('name');
            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imagename = time() . $major->name . '.' . $image->getClientOriginalExtension();
                $request->file('cover')->storePubliclyAs('majors', $imagename, ['disk' => 'public']);
                $major->cover = $imagename;
            }
            $major->is_active = $request->get('is_active');
            $saved = $major->save();
            return response()->json(
                [
                    'message' => $saved ? 'Major updated successfully' : 'Fail updating major',
                    'data' => $major
                ],
                $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json([
                'message' => $Validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        $deleted = $major->delete();
        return response()->json(
            [
                'message' => $deleted ? 'Major deleted successfully' : 'Fail deleting major',
                'icon' => $deleted ? 'success' : 'dengar'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
