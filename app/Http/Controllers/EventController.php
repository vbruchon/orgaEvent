<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Structure;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('event', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $structures = Structure::all();
        return view('dashboard_create_event', ['structures' => $structures]);
    }

    /**
     * Validate and add data in db
     */
    public function addEvent(Event $event, Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'structures_id' => ['required', 'integer', 'exists:structures,id'],
            'partners_id' => ['required', "string"],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['string'],
            'status' => ['nullable', 'string', 'max:50'],
            'number_of_participants' => ['required', 'string'],
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'expected_date_start' => ['nullable', 'date'],
            'expected_date_end' => ['nullable', 'date', 'after_or_equal:expected_date_start'],
            'hours_start' => ['required', 'date_format:H:i'],
            'hours_end' => ['nullable', 'date_format:H:i', 'after:hours_start'],
            'organizer_needs' => ['nullable'],
        ];
        $validated = $request->validate($rules, [
            'structures_id.required' => 'Le champs structure doit être définis',
            'partners_id.required' => 'Le champs structure doit être définis',
            'name.required' => 'Le champ Nom est obligatoire.',
            'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
            'number_of_participants.required' => 'Le champ Nombre de participants est obligatoire.',
            'date_start.date' => 'Le champ Date de début doit être une date valide.',
            'date_end.date' => 'Le champ Date de fin doit être une date valide.',
            'expected_date_start.date' => 'Le champ Date de début attendue doit être une date valide.',
            'expected_date_end.date' => 'Le champ Date de fin attendue doit être une date valide.',
            'hours_start.required' => 'Le champ Heure de début est obligatoire.',
            'hours_start.date_format' => 'Le champ Heure de début doit être au format H:i:s.',
            'hours_end.date_format' => 'Le champ Heure de fin doit être au format H:i:s.',
            'hours_end.after' => 'Le champ Heure de fin doit être postérieure à l\'heure de début.',
        ]);
        $event = new Event();

        foreach ($validated as $field => $value) {
            $event->{$field} = $value;
        }

        $event->save();

        return redirect()->route('dashboard')->with('success', 'Event created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
