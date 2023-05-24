<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\NumberOfParticipants;
use App\Models\Status;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('event.list', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $structures = Structure::all();
        $status = Status::all();
        $numberOfParticipants = NumberOfParticipants::all();
        $user = Auth::user();
        return view('event.createForm', ['structures' => $structures, 'status' => $status, 'numberOfParticipants' => $numberOfParticipants, 'user' => $user]);
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
            'structure_id' => ['required', 'integer', 'exists:structures,id'],
            'partners' => ['required', "string"],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['string'],
            'status_id' => ['required', 'integer', 'max:50', 'exists:statuses,id'],
            'number_of_participants_id' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'date_start' => ['required', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'hours' => ['required', 'string'],
            'organizer_needs' => ['nullable'],
        ];
        $validated = $request->validate($rules, [
            'structure_id.required' => 'Le champs structure doit être définis',
            'status_id.required' => 'Le champs status doit être définis',
            'partners.required' => 'Le champs structure doit être définis',
            'name.required' => 'Le champ Nom est obligatoire.',
            'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
            'number_of_participants.required' => 'Le champ Nombre de participants est obligatoire.',
            'date_start.required' => 'Le champ Date  de début est obligatoire.',
            'date_start.date' => 'Le champ Date de début doit être une date valide.',
            'date_end.date' => 'Le champ Date de fin doit être une date valide.',
            'hours.required' => 'Le champ Heure de début est obligatoire.',
        ]);

        $event = new Event();

        foreach ($validated as $field => $value) {
            $event->{$field} = $value;
        }
        if ($event->date_end === null) {
            $event->date_end = $event->date_start;
        }
        $event->is_Fix = $request->has('is_Fix');


        $event->user_id = Auth::user()->id;

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
    public function edit(Event $event, Structure $structures)
    {
        $structures = Structure::all();

        return view('event.editForm', ['event' => $event, 'structures' => $structures]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $rules = [
            'structure_id' => ['required', 'integer', 'exists:structures,id'],
            'partners' => ['required', "string"],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
            'numberOfParticipants' => ['required', 'string'],
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'hours_start' => ['required'],
            'hours_end' => ['nullable', 'after:hours_start'],
            'organizer_needs' => ['nullable'],
        ];
        try {
            $validated = $request->validate($rules, [
                'structure_id.required' => 'Le champs structure doit être définis',
                'partners.required' => 'Le champs structure doit être définis',
                'name.required' => 'Le champ Nom est obligatoire.',
                'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
                'description.required' => 'Le champ Description est obligatoire.',
                'numberOfParticipants.required' => 'Le champ Nombre de participants est obligatoire.',
                'date_start.date' => 'Le champ Date de début doit être une date valide.',
                'date_end.date' => 'Le champ Date de fin doit être une date valide.',
                'hours_start.required' => 'Le champ Heure de début est obligatoire.',
                'hours_start.date_format' => 'Le champ Heure de début doit être au format H:i:s.',
                'hours_end.date_format' => 'Le champ Heure de fin doit être au format H:i:s.',
                'hours_end.after' => 'Le champ Heure de fin doit être postérieure à l\'heure de début.',
            ]);
            foreach ($validated as $field => $value) {
                $event->{$field} = $value;
            }
            $event->save();

            return redirect()->route('event.list')->with('success', 'Event created successfully');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('event.list')->with('message', "L'événement a bien été supprimé");
    }
}
