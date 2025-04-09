<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NoteService;

class NotesController extends Controller
{
    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index($id, Request $request)
    {
        return $this->noteService->getPatientNotes($id, $request);
    }

    public function store($id, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = $this->noteService->createNoteForPatient($id, $validated);

        return response()->json($note, 201);
    }

    public function summary($id)
    {
        $summary = $this->noteService->getSummary($id);
        return response()->json(['summary' => $summary]);
    }
}