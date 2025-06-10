@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1>My Appointments</h1>
            <a href="{{ route('appointments.categories') }}" class="btn btn-primary">Book New Appointment</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @if($appointments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Category</th>
                                    <th>Specialist</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</td>
                                    <td>{{ $appointment->category->name }}</td>
                                    <td>{{ $appointment->psychiatrist->full_name }}</td>
                                    <td>
                                        @if($appointment->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($appointment->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                        @elseif($appointment->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                        @elseif($appointment->status == 'completed')
                                        <span class="badge bg-info">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            
                                            @if($appointment->status == 'pending')
                                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            
                                            <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4>No Appointments Found</h4>
                        <p class="text-muted">You haven't booked any appointments yet.</p>
                        <a href="{{ route('appointments.categories') }}" class="btn btn-primary mt-3">Book Your First Appointment</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

 
</div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1)!important;
    }
    
    .badge {
        font-weight: 500;
        padding: 6px 12px;
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
    
    /* Specialist Card Styles */
    .specialist-card {
        background-color: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .specialist-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .specialist-header {
        height: 80px;
        background: linear-gradient(135deg, #8CBF1C, #5A9216);
        position: relative;
    }
    
    .specialist-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: white;
        color: #333;
        font-weight: 600;
        font-size: 14px;
        padding: 5px 12px;
        border-radius: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .specialist-body {
        padding: 0 25px 25px;
        position: relative;
    }
    
    .specialist-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: -60px auto 15px;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        background-color: #f0f7e6;
    }
    
    .specialist-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .specialist-name {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }
    
    .specialist-experience {
        color: #777;
        font-size: 15px;
        margin-bottom: 15px;
        display: inline-block;
        padding: 5px 12px;
        background-color: #f0f7e6;
        border-radius: 20px;
    }
    
    .specialist-experience i {
        color: #8CBF1C;
        margin-right: 5px;
    }
    
    .specialist-bio {
        color: #555;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .btn-book-appointment {
        display: inline-block;
        background: linear-gradient(90deg, #8CBF1C, #5A9216);
        color: white;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(140, 191, 28, 0.3);
    }
    
    .btn-book-appointment:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(140, 191, 28, 0.4);
        color: white;
    }
    
    .btn-book-appointment i {
        margin-right: 8px;
    }
    
    .badge.bg-primary {
        background-color: #8CBF1C!important;
    }
</style>
@endsection
