<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display the symptom main page.
     */
    public function index()
    {
        return view('User.SymptomsViews.symptom');
    }

    /**
     * Display detailed content for a specific symptom.
     */
    public function showContent1()
    {
        return view('User.SymptomsViews.symptomcontent1');
    }

    // You can implement these when needed.
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
