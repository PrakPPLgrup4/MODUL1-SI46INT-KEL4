<?php

// app/Http/Controllers/PsychController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psych;

class PsychController extends Controller
{
    public function index()
    {
        $psychs = Psych::all();
        return view('User.psych', compact('psychs'));
    }
}


