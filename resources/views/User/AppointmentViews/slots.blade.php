@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Choose Your Appointment Time</h1>
            <p class="lead text-muted">Select a convenient time slot for your session with <span class="fw-bold text-primary">{{ $psychiatrist->name }}</span></p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 specialist-card">
                <div class="card-body text-center p-4">
                    @if($psychiatrist->picture)
                    <img src="{{ asset('images/doctor' . rand(1, 5) . '.png') }}" class="rounded-circle mb-3" alt="{{ $psychiatrist->name }}" style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #f8f9fa;">
                    @else
                    <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; border: 5px solid #f8f9fa;">
                        <i class="fas fa-user-md fa-4x text-muted"></i>
                    </div>
                    @endif
                    <h5 class="card-title fw-bold">{{ $psychiatrist->full_name }}</h5>
                    <p class="small text-muted mb-3"><i class="fas fa-award me-1"></i> {{ $psychiatrist->rating_count }} Rating</p>
                    <p class="card-text">{{ Str::limit($psychiatrist->description, 150) }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Appointment Details</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-tag text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Category</p>
                                    <p class="fw-bold mb-0">{{ $category->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-money-bill-wave text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Price</p>
                                    <p class="fw-bold mb-0 text-primary">Rp {{ number_format($category->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-clock text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Session Duration</p>
                                    <p class="fw-bold mb-0">60 minutes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-video text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Session Type</p>
                                    <p class="fw-bold mb-0">In-person</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="mb-3">Select Date and Time</h5>
                    @if($slots->isEmpty())
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i> No available slots for this specialist. Please try another specialist or check back later.
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="date-filter" class="form-label">Filter by Date</label>
                                <select id="date-filter" class="form-select">
                                    <option value="all">All Available Dates</option>
                                    @foreach($slots->pluck('date')->unique() as $date)
                                    <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->format('D, M d, Y') }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!$slots->isEmpty())
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Available Time Slots</h5>
                    <div class="row" id="slots-container">
                        @php
                            // Group slots by date in the view
                            $slotsByDate = $slots->groupBy('date');
                        @endphp
                        
                        @foreach($slotsByDate as $date => $dateSlots)
                        <div class="col-12 date-group" data-date="{{ $date }}">
                            <h6 class="mb-3 d-flex align-items-center">
                                <i class="fas fa-calendar-day text-primary me-2"></i>
                                {{ \Carbon\Carbon::parse($date)->format('l, F d, Y') }}
                            </h6>
                            <div class="row mb-4">
                                @foreach($dateSlots as $slot)
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('appointments.create') }}?category={{ $category->id }}&psychiatrist={{ $psychiatrist->id }}&slot={{ $slot->id }}" class="btn btn-outline-primary w-100 py-3 time-slot-btn">
                                        <i class="far fa-clock me-2"></i>
                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">Booking Information</h5>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-start mb-3">
                            <span class="badge bg-primary rounded-circle p-2 me-3 mt-1"><i class="fas fa-info-circle"></i></span>
                            <div>
                                <p class="text-muted mb-0">Please arrive 15 minutes before your scheduled appointment time.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start mb-3">
                            <span class="badge bg-primary rounded-circle p-2 me-3 mt-1"><i class="fas fa-credit-card"></i></span>
                            <div>
                                <p class="text-muted mb-0">Payment is required at the time of booking to confirm your appointment.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <span class="badge bg-primary rounded-circle p-2 me-3 mt-1"><i class="fas fa-calendar-times"></i></span>
                            <div>
                                <p class="text-muted mb-0">Cancellations must be made at least 24 hours in advance for a full refund.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('appointments.psychiatrists', $category->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Specialists
            </a>
        </div>
    </div>
</div>

<style>
    .specialist-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
    }
    
    .specialist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1)!important;
    }
    
    .time-slot-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
    }
    
    .time-slot-btn:hover {
        transform: scale(1.05);
    }
    
    .icon-box {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-primary {
        background-color: #8CBF1C;
        border-color: #8CBF1C;
    }
    
    .btn-primary:hover {
        background-color: #7aa919;
        border-color: #7aa919;
    }
    
    .btn-outline-primary {
        color: #8CBF1C;
        border-color: #8CBF1C;
    }
    
    .btn-outline-primary:hover {
        background-color: #8CBF1C;
        border-color: #8CBF1C;
        color: white;
    }
    
    .text-primary {
        color: #8CBF1C!important;
    }
    
    .bg-primary {
        background-color: #8CBF1C!important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateFilter = document.getElementById('date-filter');
        const dateGroups = document.querySelectorAll('.date-group');
        
        dateFilter.addEventListener('change', function() {
            const selectedDate = this.value;
            
            dateGroups.forEach(group => {
                if (selectedDate === 'all' || group.dataset.date === selectedDate) {
                    group.style.display = 'block';
                } else {
                    group.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
