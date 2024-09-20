<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Http\Resources\DepartementResource;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements = Departement::orderBy('id', 'desc')->get();

    return response()->json([
        'data' => DepartementResource::collection($departements),
    ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartementRequest $request)
    {
        $departement = new Departement();
    $departement->nom = $request->input('nom');
    $departement->bio = $request->input('bio');

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('departements', 'public'); // Stocke l'image dans 'storage/app/public/departements'
        $departement->image = $imagePath; // Sauvegarde le chemin de l'image dans la base de données
    }

    $departement->save();

    return new DepartementResource($departement);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        return new DepartementResource($departement);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartementRequest  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        $departement->nom = $request->input('nom');
        $departement->bio = $request->input('bio');
        $departement->save();
    
        return new DepartementResource($departement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        // Delete related teachers first
    $departement->teachers()->delete();
    
    // Then delete the departement
    $departement->delete();
    
    return response()->noContent();
    }
}
