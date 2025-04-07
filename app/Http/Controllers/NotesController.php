<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index($id, Request $request)
    {
        $query = Patient::findOrFail($id)->notes();

        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%$search%");
        }

        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function store($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = Patient::findOrFail($id)->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($note, 201);
    }

    public function summary($id)
    {
        // Bonus: mock summary
        return response()->json([
            'summary' => 'This is a mock summary of all patient notes.'
        ]);
    }
}
