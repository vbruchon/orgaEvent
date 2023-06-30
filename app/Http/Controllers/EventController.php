<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\NumberOfParticipants;
use App\Models\Status;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event as IcalendarEvent;
use App\Services\EventExportFileService;
use App\Services\CreateSVGArray;
use App\Services\DateConversionService;



class EventController extends Controller
{
    /**
     * Validate the event data.
     */
    private function validateEvent(Request $request)
    {
        return $request->validate([
            'structure_id' => ['required', 'integer', 'exists:structures,id'],
            'partners' => ['required', 'string'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['string'],
            'status_id' => ['required', 'integer', 'max:50', 'exists:statuses,id'],
            'number_of_participants_id' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'date_start' => ['required', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'hours' => ['required', 'string'],
            'organizer_needs' => ['nullable'],
        ], [
            'structure_id.required' => 'Le champ Structure est obligatoire',
            'partners.required' => 'Le champ Partenaires est obligatoire',
            'name.required' => 'Le champ Nom est obligatoire.',
            'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
            'number_of_participants_id.required' => 'Le champ Nombre de participants est obligatoire.',
            'date_start.required' => 'Le champ Date de début est obligatoire.',
            'date_start.date' => 'Le champ Date de début doit être une date valide.',
            'date_end.date' => 'Le champ Date de fin doit être une date valide.',
            'hours.required' => 'Le champ Heure de début est obligatoire.',
        ]);
    }
    /**
     * Fill the event fields with the validated data.
     */
    private function fillEventFields(Event $event, array $validated)
    {
        foreach ($validated as $field => $value) {
            if ($field === 'date_end' && $value === null) {
                $event->date_end = $event->date_start;
            } else {
                $event->{$field} = $value;
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(DateConversionService $dateConversion, CreateSVGArray $svg)
    {
        $events = Event::orderBy('date_start')->where('date_start', '>=', now())->get();
        $dateStartToString = [];
        $dateStartToDays = [];
        $dateEndToDays = [];

        foreach ($events as $event) {
            $key = $event->id;

            $convertDateStartToString = $dateConversion->convertDateToString($event->date_start);
            $dateStartToString[$key] = $convertDateStartToString;

            $convertDateStartToDays = $dateConversion->convertDateToDays($event->date_start);
            $dateStartToDays[$key] = $convertDateStartToDays;

            if (isset($event->date_end)) {
                $convertDateEndToDays = $dateConversion->convertDateToDays($event->date_end);
                $dateEndToDays[$key] = $convertDateEndToDays;
            }
        }
        $isAdmin = (new UserController)->checkUserAdmin();

        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();

        $svgIcons = $svg->createSvgArray();


        return view('event.list', [
            'events' => $events,
            'dateStartToString' => $dateStartToString,
            'dateStartToDays' => $dateStartToDays,
            'dateEndToDays' => $dateEndToDays,
            'isAdmin' => $isAdmin,
            'structures' => $structures,
            'status' => $status,
            'numberOfParticipants' => $numberOfParticipants,
            'svg' => $svgIcons
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateEvent($request);

        $event = new Event();
        $this->fillEventFields($event, $validated);
        $event->is_Fix = $request->has('is_Fix');
        $event->user_id = Auth::user()->id;
        $event->save();

        return redirect()->route('userEvent.all')->with('success', 'L\'événement a bien été créé');
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
        $validated = $this->validateEvent($request);

        $this->fillEventFields($event, $validated);
        $event->save();

        return redirect()->route('userEvent.all')->with('success', 'L\'événement a bien été modifié');
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
        $svgIcons = $this->createSvgArray();
        $isAdmin = (new UserController)->checkUserAdmin();

        return view('event.list', ['events' => $events, 'svg' => $svgIcons, 'isAdmin' => $isAdmin]);
    }

    public function filteredEvents(Request $request)
    {
        $isAdmin = (new UserController)->checkUserAdmin();
        $selectedStructure = $request->input('structure');
        $selectedStatus = $request->input('status');
        $selectedParticipant = $request->input('number_of_participants');
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();

        $query = $this->applyFilters($request);

        $events = $query->orderBy('date_start')->where('date_end', '>', now())->get();


        if (sizeof($events) < 1) {
            return view('event.list', [
                'events' => $events,
                'isAdmin' => $isAdmin,
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
            $svgIcons = $this->createSvgArray();


            // Sinon, retourne la vue partielle des événements filtrés
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
                'svg' => $svgIcons
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

        if ($request->filled('date_start')) {
            $dateStartLabel = $request->input('date_start');
            $query->whereDate('date_start', '>', $dateStartLabel);
        }


        if ($request->filled('date_end')) {
            $dateEndLabel = $request->input('date_end');
            $query->whereDate('date_end', '<', $dateEndLabel);
        }



        return $query;
    }

    public function export(EventExportFileService $exportFileService)
    {
        // Récupérez les données de vos événements depuis votre modèle Event
        $events = Event::all();

        // Utilisez le service pour exporter les événements
        $icsData = $exportFileService->exportToICS($events);

        // Faites quelque chose avec les données ICS, par exemple : télécharger le fichier
        return response($icsData)
            ->header('Content-Type', 'text/calendar')
            ->header('Content-Disposition', 'attachment; filename="events.ics"');
    }
}
