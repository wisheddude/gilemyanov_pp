<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::latest()->paginate(10);

        return view('agendas.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('agendas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'nullabel|string',
           'agenda_date' => 'required|date',
           'location' => 'nullable|string|max:255',
        ]);

        $validated['created_by'] = Auth::id();

        Agenda::create($validated);

        return redirect()->route('agendas.index')->with('success', 'Повестка создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        return view('agendas.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('agendas.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'agenda_date' => 'required|date',
            'location' => 'nullable|string|max:255',
        ]);

        $agenda->update($validated);

        return redirect()->route('agendas.show', $agenda)->with('success', 'Повестка обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $agenda->delete();

        return redirect()->route('agendas.index')->with('success', 'Повестка удалена');
    }
}
