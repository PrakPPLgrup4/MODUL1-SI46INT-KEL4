<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journals = Journal::latest('date')->get();
        return view('User.journal', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'journal_text' => 'required',
        ]);

        Journal::create($request->all());
        return redirect()->route('views.journal')->with('success', 'Journal entry added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $journal = Journal::findOrFail($id);return view('User.edit', compact('journal'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'journal_text' => 'required|string',
        ]);

        $journal = Journal::findOrFail($id);
        $journal->update($validated);

        return redirect()->route('views.journal')->with('success', 'Journal updated!');
    }

    public function destroy(string $id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();

        return redirect()->route('views.journal')->with('success', 'Journal deleted!');
    }
}
