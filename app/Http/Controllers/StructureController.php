<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = Structure::all();
        return view('structure', ['structures' => $structures]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_structure');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Structure $structure, Request $request)
    {
        // Validation
        $rules = $request->validate(
            [
                'name' => 'required|max:150',
            ],
            [
                'name.required' => 'Le champ Nom est obligatoire.',
                'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
            ]
        );

        $structure->name = $rules['name'];
        $structure->save();

        return redirect()->route('structure')->with('success', 'Structure ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Structure $structure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Structure $structure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Structure $structure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Structure $structure)
    {
        $structure->delete();

        return redirect()->route('structure')->with('sucess', 'La structure à bien était supprimée');
    }
}
