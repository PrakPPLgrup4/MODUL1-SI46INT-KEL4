<?php

namespace App\Http\Controllers;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentCategory;
use App\Models\AppointmentSlot;
use App\Models\Psych;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $appointments = Appointment::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('User.AppointmentViews.Appointment', compact('appointments'));
    }

    /**
     * Show categories page
     */
    public function categories()
    {
        $categories = AppointmentCategory::all();
        return view('User.AppointmentViews.categories', compact('categories'));
    }

    /**
     * Show psychiatrists by category
     */
    public function psychiatrists($categoryId)
    {
        $category = AppointmentCategory::findOrFail($categoryId);
        $psychiatrists = Psych::all();
        
        return view('User.AppointmentViews.psychiatrists', compact('category', 'psychiatrists'));
    }

    /**
     * Show available slots for a psychiatrist
     */
    public function slots(Request $request)
    {
        $categoryId = $request->query('category');
        $psychiatristId = $request->query('psychiatrist');
        
        $category = AppointmentCategory::findOrFail($categoryId);
        $psychiatrist = Psych::findOrFail($psychiatristId);
        
        // Get available slots without grouping
        $slots = AppointmentSlot::where('psychiatrist_id', $psychiatristId)
            ->where('is_booked', false)
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();
            
        return view('User.AppointmentViews.slots', [
            'category' => $category,
            'psychiatrist' => $psychiatrist,
            'slots' => $slots
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categoryId = $request->query('category');
        $psychiatristId = $request->query('psychiatrist');
        $slotId = $request->query('slot');
        
        $category = AppointmentCategory::findOrFail($categoryId);
        $psychiatrist = Psych::findOrFail($psychiatristId);
        $slot = AppointmentSlot::findOrFail($slotId);
        
        return view('User.AppointmentViews.create', compact('category', 'psychiatrist', 'slot'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:appointment_categories,id',
            'psychiatrist_id' => 'required|exists:psychs,id',
            'slot_id' => 'required|exists:appointment_slots,id',
            'notes' => 'nullable|string|max:500',
            'payment_proof' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $user = Auth::user();
        $slot = AppointmentSlot::findOrFail($request->slot_id);
        
        // Check if slot is already booked
        if ($slot->is_booked) {
            return redirect()->back()->with('error', 'This slot is already booked. Please select another time.');
        }
        
        // Upload payment proof
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }
        
        // Create appointment
        $appointment = new Appointment();
        $appointment->user_id = $user->id;
        $appointment->psychiatrist_id = $request->psychiatrist_id;
        $appointment->appointment_category_id = $request->category_id;
        $appointment->appointment_slot_id = $request->slot_id;
        $appointment->date = $slot->date;
        $appointment->start_time = $slot->start_time;
        $appointment->end_time = $slot->end_time;
        $appointment->status = 'pending';
        $appointment->payment_proof = $paymentProofPath;
        $appointment->notes = $request->notes;
        $appointment->save();
        
        // Mark slot as booked
        $slot->update(['is_booked' => true]);
         // Tambah poin
        $earnedPoints = 10; // misalnya bikin jurnal dapat 10 poin
        $userPoint = UserPoint::firstOrCreate(
            ['user_id' => Auth::id()],
            ['points' => 0, 'total_earned' => 0, 'total_spent' => 0]
        );

        $userPoint->points += $earnedPoints;
        $userPoint->total_earned += $earnedPoints;
        $userPoint->save();       
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment booked successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $appointment = Appointment::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
            
        return view('User.AppointmentViews.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
/**
 * Show the form for editing the specified resource.
 */
    public function edit(string $id)
    {
        $user = Auth::user();
        $appointment = Appointment::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        if ($appointment->status !== 'pending') {
            return redirect()->route('appointments.show', $appointment->id)
                ->with('error', 'You can only edit pending appointments.');
        }

        // Ambil semua slot yang belum dipesan, plus slot yang sekarang dipakai appointment ini supaya bisa dipilih ulang
        $slots = AppointmentSlot::where(function($query) use ($appointment) {
                $query->where('is_booked', false)
                    ->orWhere('id', $appointment->appointment_slot_id);
            })
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('User.AppointmentViews.edit', compact('appointment', 'slots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'slot_id' => 'required|exists:appointment_slots,id',
            'notes' => 'nullable|string|max:500',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $appointment = Appointment::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        if ($appointment->status !== 'pending') {
            return redirect()->route('appointments.show', $appointment->id)
                ->with('error', 'You can only edit pending appointments.');
        }

        $newSlot = AppointmentSlot::findOrFail($request->slot_id);

        // Jika slot diganti, cek slot baru sudah dipesan atau belum
        if ($newSlot->id != $appointment->appointment_slot_id && $newSlot->is_booked) {
            return redirect()->back()->with('error', 'The selected slot is already booked. Please choose another slot.')->withInput();
        }

        // Update slot: free old slot dan set booked di slot baru jika diganti
        if ($newSlot->id != $appointment->appointment_slot_id) {
            // Free old slot
            $oldSlot = AppointmentSlot::find($appointment->appointment_slot_id);
            if ($oldSlot) {
                $oldSlot->is_booked = false;
                $oldSlot->save();
            }

            // Mark new slot as booked
            $newSlot->is_booked = true;
            $newSlot->save();

            // Update appointment slot and time info
            $appointment->appointment_slot_id = $newSlot->id;
            $appointment->date = $newSlot->date;
            $appointment->start_time = $newSlot->start_time;
            $appointment->end_time = $newSlot->end_time;
        }

        // Update payment proof if provided
        if ($request->hasFile('payment_proof')) {
            if ($appointment->payment_proof) {
                Storage::disk('public')->delete($appointment->payment_proof);
            }
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            $appointment->payment_proof = $paymentProofPath;
        }

        // Update notes
        $appointment->notes = $request->notes ?? $appointment->notes;

        $appointment->save();

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', 'Appointment updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $appointment = Appointment::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
            
        // Only allow cancellation if appointment is pending
        if ($appointment->status !== 'pending') {
            return redirect()->route('appointments.show', $appointment->id)
                ->with('error', 'You can only cancel pending appointments.');
        }
        
        // Update appointment status to cancelled
        $appointment->status = 'cancelled';
        $appointment->save();
        
        // Free up the slot
        $slot = AppointmentSlot::find($appointment->appointment_slot_id);
        if ($slot) {
            $slot->is_booked = false;
            $slot->save();
        }
        
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment cancelled successfully!');
    }
    
    /**
     * Cancel an appointment (alternative to destroy)
     */
    public function cancel(string $id)
    {
        return $this->destroy($id);
    }
}
