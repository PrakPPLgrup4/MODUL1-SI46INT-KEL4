<?php
// app/Http/Controllers/AppointmentController.php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Psych;  // Pastikan model Psychiatrist sudah ditambahkan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display the appointment form.
     */
    public function index()
    {
        // Ambil data psikiater dari database
        $psychiatrists = Psych::all();
        
        // Kirim data psikiater ke tampilan
        return view('User.AppointmentViews.Appointment', compact('psychiatrists'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'category' => 'required|string',
            'specialist_id' => 'required|integer',
            'appointment_time' => 'required|date',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Menyimpan bukti pembayaran
        $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Membuat janji temu di database
        Appointment::create([
            'user_id' => Auth::id(),
            'specialist_id' => $request->specialist_id,
            'category' => $request->category,
            'appointment_time' => $request->appointment_time,
            'payment_proof' => $filePath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('views.appointment')->with('success', 'Appointment created successfully!');
    }
}
