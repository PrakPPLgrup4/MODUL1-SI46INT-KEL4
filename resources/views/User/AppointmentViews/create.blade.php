@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Confirm Your Appointment</h1>
            <p class="lead text-muted">Review your appointment details and complete your booking</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle p-3 me-3">
                            <i class="fas fa-clipboard-check text-primary fa-2x"></i>
                        </div>
                        <h4 class="card-title mb-0">Appointment Summary</h4>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="icon-box bg-light rounded-circle p-2 me-3">
                                    <i class="fas fa-tag text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Category</p>
                                    <p class="fw-bold mb-0">{{ $category->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="icon-box bg-light rounded-circle p-2 me-3">
                                    <i class="fas fa-user-md text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Specialist</p>
                                    <p class="fw-bold mb-0">{{ $psychiatrist->full_name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="icon-box bg-light rounded-circle p-2 me-3">
                                    <i class="fas fa-calendar-day text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Date</p>
                                    <p class="fw-bold mb-0">{{ \Carbon\Carbon::parse($slot->date)->format('l, F d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="icon-box bg-light rounded-circle p-2 me-3">
                                    <i class="fas fa-clock text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Time</p>
                                    <p class="fw-bold mb-0">{{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="icon-box bg-light rounded-circle p-2 me-3">
                                    <i class="fas fa-money-bill-wave text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Price</p>
                                    <p class="fw-bold mb-0 text-primary">Rp {{ number_format($category->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle p-3 me-3">
                            <i class="fas fa-file-invoice text-primary fa-2x"></i>
                        </div>
                        <h4 class="card-title mb-0">Complete Your Booking</h4>
                    </div>

                    <form action="{{ route('appointments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <input type="hidden" name="psychiatrist_id" value="{{ $psychiatrist->id }}">
                        <input type="hidden" name="slot_id" value="{{ $slot->id }}">

                        <div class="mb-4">
                            <label for="notes" class="form-label fw-bold">Additional Notes (Optional)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" placeholder="Any specific concerns or topics you'd like to discuss during your session">{{ old('notes') }}</textarea>
                            @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h5 class="mb-3">Payment Instructions</h5>
                                <ol class="mb-0">
                                    <li class="mb-2">Transfer the amount of <span class="fw-bold text-primary">Rp {{ number_format($category->price, 0, ',', '.') }}</span> to one of our accounts:</li>
                                    <div class="row mb-3 mt-2">
                                        <div class="col-md-6 mb-2">
                                            <div class="d-flex align-items-center bg-white p-3 rounded">
                                                <i class="fas fa-university text-primary me-3"></i>
                                                <div>
                                                    <p class="mb-0 fw-bold">Bank BCA</p>
                                                    <p class="mb-0">1234567890</p>
                                                    <p class="mb-0 small text-muted">PT Psylography Indonesia</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="d-flex align-items-center bg-white p-3 rounded">
                                                <i class="fas fa-university text-primary me-3"></i>
                                                <div>
                                                    <p class="mb-0 fw-bold">Bank Mandiri</p>
                                                    <p class="mb-0">0987654321</p>
                                                    <p class="mb-0 small text-muted">PT Psylography Indonesia</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <li class="mb-2">Take a screenshot or photo of your payment receipt</li>
                                    <li>Upload the payment proof below</li>
                                </ol>
                            </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="payment_proof" class="form-label">Upload Payment Proof</label>
                                <input class="form-control @error('payment_proof') is-invalid @enderror" type="file" id="payment_proof" name="payment_proof" accept="image/*">
                                <div class="form-text">Please upload a screenshot or photo of your payment receipt.</div>
                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Confirm Booking</button>
                            <a href="{{ route('appointments.slots', [$category->id, $psychiatrist->id]) }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
