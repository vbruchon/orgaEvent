<?php

namespace App\Http\Controllers;

use App\Models\AccessType;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\NumberOfParticipants;
use App\Models\Structure;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Services\EventExportFileService;
use App\Services\CreateSVGArray;
use App\Services\DateConversionService;
use Carbon\Carbon;



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
            'number_of_participants_id' => ['required', 'string'],
            'accessType_id' => ['required'],
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
        $events = Event::with('structure', 'number_of_participants', 'accessType')
            ->where('date_start', '>=', '2023-06-30 10:35:45')
            ->has('structure')
            ->has('number_of_participants')
            ->has('accessType')
            ->orderBy('date_start', 'asc')
            ->get();

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
        $numberOfParticipants = NumberOfParticipants::get();

        $svgIcons = $svg->createSvgArray();


        return view('event.list', [
            'events' => $events,
            'dateStartToString' => $dateStartToString,
            'dateStartToDays' => $dateStartToDays,
            'dateEndToDays' => $dateEndToDays,
            'isAdmin' => $isAdmin,
            'structures' => $structures,
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
        $numberOfParticipants = NumberOfParticipants::get();
        $user = Auth::user();
        $accessType = AccessType::get();
        $tags = Tag::get();
        return view('event.createForm', ['structures' => $structures, 'numberOfParticipants' => $numberOfParticipants, 'user' => $user, 'accessType' => $accessType, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Récupérer les IDs des tags sélectionnés depuis la requête
        $tagIds = $request->input('tags');

        $validated = $this->validateEvent($request);

        $event = new Event();
        $this->fillEventFields($event, $validated);
        $event->is_Fix = $request->has('is_Fix');
        $event->user_id = Auth::user()->id;

        $event->save();

        // Associer les tags à l'événement créé
        $event->tags()->attach($tagIds);

        return redirect()->route('userEvent.all')->with('success', 'L\'événement a bien été créé');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, Structure $structures)
    {
        $structures = Structure::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $user = Auth::user();
        $accessType = AccessType::get();
        $tags = Tag::get();

        return view('event.editForm', ['event' => $event, 'structures' => $structures, 'numberOfParticipants' => $numberOfParticipants, 'user' => $user, 'accessType' => $accessType, 'tags' => $tags]);
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





    public function userContribution(CreateSVGArray $svg)
    {
        $user = Auth::user();
        $events = Event::where('user_id', '=', $user->id)->get();
        $svgIcons = $svg->createSvgArray();
        $isAdmin = (new UserController)->checkUserAdmin();

        return view('event.list', ['events' => $events, 'svg' => $svgIcons, 'isAdmin' => $isAdmin]);
    }

    public function filteredEvents(Request $request, DateConversionService $dateConversion, CreateSVGArray $svg)
    {
        $isAdmin = (new UserController)->checkUserAdmin();
        $selectedStructure = $request->input('structure');
        $selectedParticipant = $request->input('number_of_participants');
        $structures = Structure::get();
        $numberOfParticipants = NumberOfParticipants::get();

        $query = $this->applyFilters($request);

        $events = $query->orderBy('date_start')->get();


        if (sizeof($events) < 1) {
            return view('event.list', [
                'events' => $events,
                'isAdmin' => $isAdmin,
                'structures' => $structures,
                'numberOfParticipants' => $numberOfParticipants,
                'selectedStructure' => $selectedStructure,
                'selectedParticipant' => $selectedParticipant,
            ]);
        } else {
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

            $svgIcons = $svg->createSvgArray();

            // Sinon, retourne la vue partielle des événements filtrés
            return view('event.list', [
                'events' => $events,
                'dateStartToString' => $dateStartToString,
                'dateStartToDays' => $dateStartToDays,
                'dateEndToDays' => $dateEndToDays,
                'isAdmin' => $isAdmin,
                'structures' => $structures,
                'numberOfParticipants' => $numberOfParticipants,
                'selectedStructure' => $selectedStructure,
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
            $query->whereHas('structure', function ($query) use ($structureName) {
                $query->where('name', $structureName);
            });
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
            $dateStart = Carbon::createFromFormat('Y-m-d', $dateStartLabel)->startOfDay();
            $query->whereDate('date_start', $dateStart);
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
