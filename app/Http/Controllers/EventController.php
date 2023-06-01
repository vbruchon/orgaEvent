<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\NumberOfParticipants;
use App\Models\Status;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $events = Event::orderBy('date_start')->where('date_end', '>', now())->get();
        $dateStartToString = [];
        $dateStartToDays = [];
        $dateEndToDays = [];

        foreach ($events as $event) {
            $key = $event->id;

            $convertDateStartToString = $this->convertDateToString($event->date_start);
            $dateStartToString[$key] = $convertDateStartToString;

            $convertDateStartToDays = $this->convertDateToDays($event->date_start);
            $dateStartToDays[$key] = $convertDateStartToDays;

            if (isset($event->date_end)) {
                $convertDateEndToDays = $this->convertDateToDays($event->date_end);
                $dateEndToDays[$key] = $convertDateEndToDays;
            }
        }
        $isAdmin = $this->checkUserAdmin();

        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();
        return view('event.list', [
            'events' => $events,
            'dateStartToString' => $dateStartToString,
            'dateStartToDays' => $dateStartToDays,
            'dateEndToDays' => $dateEndToDays,
            'isAdmin' => $isAdmin,
            'structures' => $structures,
            'status' => $status,
            'numberOfParticipants' => $numberOfParticipants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();
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
            if ($field === "date_end" && $value === null) {
                $event->date_end = $event->date_start;
            } else {
                $event->{$field} = $value;
            }
        }
        $event->is_Fix = $request->has('is_Fix'); //Check if checkbox is_Fix is checked
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
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $user = Auth::user();

        return view('event.editForm', ['event' => $event, 'structures' => $structures, 'status' => $status, 'numberOfParticipants' => $numberOfParticipants, 'user' => $user]);
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
            'description' => ['string'],
            'status_id' => ['required', 'integer', 'max:50', 'exists:statuses,id'],
            'number_of_participants_id' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'date_start' => ['required', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'hours' => ['required', 'string'],
            'organizer_needs' => ['nullable'],
        ];
        try {
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
            foreach ($validated as $field => $value) {
                $event->{$field} = $value;
            }
            $event->save();

            return redirect()->route('userEvent.all')->with('success', 'Event created successfully');
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

        return redirect()->route('userEvent.all')->with('message', "L'événement a bien été supprimé");
    }

    public function userContribution()
    {
        $user = Auth::user();
        $events = Event::where('user_id', '=', $user->id)->get();

        return view('event.mycontribution', ['events' => $events]);
    }

    public function filteredEvents(Request $request)
    {
        $isAdmin = $this->checkUserAdmin();
        $selectedStructure = $request->input('structure');
        $selectedStatus = $request->input('status');
        $selectedParticipant = $request->input('number_of_participants');
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();

        $query = $this->applyFilters($request);

        $events = $query->get();

        if (sizeof($events) < 1) {
            return view('event.list', [
                'events' => $events, 'isAdmin' => $isAdmin,
                'structures' => $structures,
                'status' => $status,
                'numberOfParticipants' => $numberOfParticipants,
                'selectedStructure' => $selectedStructure,
                'selectedStatus' => $selectedStatus,
                'selectedParticipant' => $selectedParticipant,
            ]);
        } else {
            foreach ($events as $event) {
                $key = $event->id;

                $convertDateStartToString = $this->convertDateToString($event->date_start);
                $dateStartToString[$key] = $convertDateStartToString;

                $convertDateStartToDays = $this->convertDateToDays($event->date_start);
                $dateStartToDays[$key] = $convertDateStartToDays;

                if (isset($event->date_end)) {
                    $convertDateEndToDays = $this->convertDateToDays($event->date_end);
                    $dateEndToDays[$key] = $convertDateEndToDays;
                }
            }


            return view('event.list', [
                'events' => $events,
                'dateStartToString' => $dateStartToString,
                'dateStartToDays' => $dateStartToDays,
                'dateEndToDays' => $dateEndToDays,
                'isAdmin' => $isAdmin,
                'structures' => $structures,
                'status' => $status,
                'numberOfParticipants' => $numberOfParticipants,
                'selectedStructure' => $selectedStructure,
                'selectedStatus' => $selectedStatus,
                'selectedParticipant' => $selectedParticipant,
            ]);
        }
    }

    private function applyFilters(Request $request)
    {
        $query = Event::query();

        if ($request->filled('structure')) {
            $structureName = $request->input('structure');
            $structure = Structure::where('name', $structureName)->first();

            if ($structure) {
                $query->where('structure_id', $structure->id);
            }
        }

        if ($request->filled('status')) {
            $statusName = $request->input('status');
            $status = Status::where('name', $statusName)->first();

            if ($status) {
                $query->where('status_id', $status->id);
            }
        }

        if ($request->filled('number_of_participants')) {
            $numberLabel = $request->input('number_of_participants');
            $participants = NumberOfParticipants::where('name', $numberLabel)->first();

            if ($participants) {
                $query->where('number_of_participants_id', $participants->id);
            }
        }

        return $query;
    }

    private function checkUserAdmin()
    {
        if (Auth::check()) {
            return Auth::user()->is_admin;
        }

        return false;
    }



    public function convertDateToString($date)
    {
        $newDate = Carbon::parse($date);
        $now = Carbon::now();
        $diffInDays = $now->diffInDays($newDate, false);
        $diffInHumans = $now->diffForHumans($newDate);

        if ($diffInDays > 365) {
            $diffInYears = floor($diffInDays / 365);
            $phrase = 'Dans ' . $diffInYears . ' an(s)';
        } elseif ($diffInDays > 30) {
            $diffInMonths = floor($diffInDays / 30);
            $phrase = 'Dans ' . $diffInMonths . ' mois';
        } elseif ($diffInDays > 0) {
            $phrase = 'Dans ' . $diffInDays . ' jour(s)';
        } elseif ($diffInDays === 0) {
            $phrase = 'Demain';
        } else {
            $phrase = $diffInHumans;
        }

        return $phrase;
    }

    public function convertDateToDays($date)
    {
        $newDate = Carbon::parse($date);

        return ucwords($newDate->isoFormat('dddd D MMMM Y'));
    }
}
