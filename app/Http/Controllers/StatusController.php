<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = Status::all();

        return view('status.list', ['status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('status.createForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Status $status, Request $request)
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

        $status->name = $rules['name'];
        $status->save();

        return redirect()->route('status.list')->with('success', 'Le status à était ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
  /*   public function show(Status $status)
    {
        //
    }
 */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        return view('status.editForm', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        $this->store($status, $request);

        return redirect()->route('status.list')->with('success', 'Le partenaire a été modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('status.list')->with('success', 'Le status a été supprimé avec succès !');
    }
}
