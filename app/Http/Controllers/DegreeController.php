<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DegreeController extends Controller
{
    public function index()
    {
        $degrees = Degree::orderBy('degree_title')->paginate(10);

        return view('degree.index', compact('degrees'));
    }

    public function create()
    {
        return view('degree.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'degree_title' => 'required|string|min:3|max:255|unique:degrees,degree_title',
        ]);

        Degree::create($validated);

        Log::info('Degree created.', ['degree_title' => $validated['degree_title']]);

        return redirect()->route('degree.index')->with('success', 'Degree added successfully.');
    }

    public function show(string $id)
    {
        $degree = Degree::withCount('students')->findOrFail($id);

        return view('degree.show', compact('degree'));
    }

    public function edit(string $id)
    {
        $degree = Degree::findOrFail($id);

        return view('degree.edit', compact('degree'));
    }

    public function update(Request $request, string $id)
    {
        $degree = Degree::findOrFail($id);

        $validated = $request->validate([
            'degree_title' => 'required|string|min:3|max:255|unique:degrees,degree_title,' . $degree->id,
        ]);

        $degree->update($validated);

        Log::info('Degree updated.', ['degree_id' => $degree->id]);

        return redirect()->route('degree.index')->with('success', 'Degree updated successfully.');
    }

    public function destroy(string $id)
    {
        $degree = Degree::withCount('students')->findOrFail($id);

        if ($degree->students_count > 0) {
            return redirect()
                ->route('degree.index')
                ->withErrors(['degree' => 'This degree cannot be deleted because it is assigned to students.']);
        }

        $degree->delete();

        Log::info('Degree deleted.', ['degree_id' => $id]);

        return redirect()->route('degree.index')->with('success', 'Degree deleted successfully.');
    }
}
