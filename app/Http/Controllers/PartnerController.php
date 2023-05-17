<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();

        return view('list_partners', ['partners' => $partners]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_partner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Partner $partner ,Request $request)
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

        $partner->name = $rules['name'];
        $partner->save();

        return redirect()->route('partners.list')->with('success', 'Le parteniare à été ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partners)
    {
        //
    }
}
