@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Appointment Details</h1>
            <p class="lead text-muted">Review the details of your appointment below</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle p-3 me-3">
                            <i class="fas fa-info-circle text-primary fa-2x"></i>
                        </div>
                        <h4 class="card-title mb-0">Appointment Summary</h4>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <p class="mb-0 text-muted small">Date</p>
                            <p class="fw-bold mb-0">{{ \Carbon\Carbon::parse($appointment->date)->format('l, F d, Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-0 text-muted small">Time</p>
                            <p class="fw-bold mb-0">{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-0 text-muted small">Status</p>
                            <p class="fw-bold mb-0 text-capitalize">{{ $appointment->status }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-0 text-muted small">Psychiatrist</p>
                            <p class="fw-bold mb-0">{{ $appointment->psychiatrist->full_name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-0 text-muted small">Category</p>
                            <p class="fw-bold mb-0">{{ $appointment->category->name ?? '-' }}</p>
                        </div>
                        <div class="col-12">
                            <p class="mb-0 text-muted small">Notes</p>
                            <p class="fw-bold">{{ $appointment->notes ?: '-' }}</p>
                        </div>
                    </div>

                    @if($appointment->payment_proof)
                    <div class="mb-3">
                        <p class="mb-1 text-muted small">Payment Proof</p>
                        <img src="{{ asset('storage/' . $appointment->payment_proof) }}" alt="Payment Proof" class="img-fluid rounded shadow-sm" style="max-width: 100%;">
                    </div>
                    @endif

                    <a href="{{ route('appointments.index') }}" class="btn btn-primary mt-3">Back to Appointments</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
