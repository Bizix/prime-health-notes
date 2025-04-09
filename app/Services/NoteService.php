<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Http\Request;

class NoteService
{
    public function getPatientNotes($patientId, Request $request)
    {
        $patient = Patient::findOrFail($patientId);
        $query = $patient->notes();

        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%$search%");
        }

        return $query->orderBy('created_at', 'desc')->paginate(5);
    }

    public function createNoteForPatient($patientId, array $data)
    {
        $patient = Patient::findOrFail($patientId);
        return $patient->notes()->create($data);
    }

    public function getSummary($patientId)
    {
        // This could eventually use actual summarization logic or AI
        return 'This is a mock summary of all patient notes.';
    }
}
