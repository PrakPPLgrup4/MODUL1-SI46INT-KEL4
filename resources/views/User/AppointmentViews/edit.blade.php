@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Edit Your Appointment</h1>
            <p class="lead text-muted">Update your appointment details and save changes</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">

                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Slot Selection -->
                        <div class="mb-4">
                            <label for="slot_id" class="form-label fw-bold">Choose Appointment Slot</label>
                            <select 
                                name="slot_id" 
                                id="slot_id" 
                                class="form-select @error('slot_id') is-invalid @enderror" 
                                required
                            >
                                <option value="">-- Select Slot --</option>
                                @foreach($slots as $slot)
                                    <option value="{{ $slot->id }}" 
                                        {{ old('slot_id', $appointment->appointment_slot_id) == $slot->id ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($slot->date)->format('d M Y') }} | {{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('slot_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="notes" class="form-label fw-bold">Additional Notes (Optional)</label>
                            <textarea 
                                class="form-control @error('notes') is-invalid @enderror" 
                                id="notes" 
                                name="notes" 
                                rows="3" 
                                placeholder="Update any notes for your session"
                            >{{ old('notes', $appointment->notes) }}</textarea>
                            @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Proof -->
                        <div class="mb-4">
                            <label for="payment_proof" class="form-label">Upload Payment Proof</label>
                            @if ($appointment->payment_proof)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $appointment->payment_proof) }}" alt="Payment Proof" class="img-fluid" style="max-height: 150px;">
                            </div>
                            @endif
                            <input 
                                class="form-control @error('payment_proof') is-invalid @enderror" 
                                type="file" 
                                id="payment_proof" 
                                name="payment_proof" 
                                accept="image/*"
                            >
                            <div class="form-text">Upload a new payment receipt if you want to update it.</div>
                            @error('payment_proof')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
