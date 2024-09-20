<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherResource;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('search');

        $teachers = Teacher::orderBy('created_at', 'desc')
        ->where( 'nom' , 'like' , '%'. $query . '%' )
            ->paginate(15);

    return response()->json([
        'data' => TeacherResource::collection($teachers),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $teacher = new Teacher();
        $teacher->photo = $request->input('photo');
        $teacher->nom = $request->input('nom');
        $teacher->prenom = $request->input('prenom');
        $teacher->bio = $request->input('bio');
        $teacher->departement_id = $request->input('departement_id');
        $teacher->save();

        return new TeacherResource($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->photo = $request->input('photo');
        $teacher->nom = $request->input('nom');
        $teacher->prenom = $request->input('prenom');
        $teacher->bio = $request->input('bio');
        $teacher->departement_id = $request->input('departement_id');
        $teacher->save();

        return new TeacherResource($teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->noContent();
    }
}
