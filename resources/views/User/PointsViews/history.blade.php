@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Points History</h1>
            <p class="lead text-muted">Track all your points activities and redeemed vouchers</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 points-summary-card">
                <div class="card-body p-4">
                    <h4 class="mb-4"><i class="fas fa-chart-pie text-primary me-2"></i> Points Summary</h4>
                    
                    <div class="points-circle mx-auto mb-4 d-flex align-items-center justify-content-center">
                        <div class="text-center w-100">
                            <h2 class="display-4 fw-bold mb-0 text-white">{{ $userPoints->points }}</h2>
                            <p class="text-white mb-0">AVAILABLE</p>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded text-center">
                                <i class="fas fa-arrow-circle-up text-success mb-2"></i>
                                <h5 class="mb-0">{{ $userPoints->total_earned }}</h5>
                                <small class="text-muted">Total Earned</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded text-center">
                                <i class="fas fa-arrow-circle-down text-danger mb-2"></i>
                                <h5 class="mb-0">{{ $userPoints->total_spent }}</h5>
                                <small class="text-muted">Total Spent</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('points.index') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-arrow-left me-2"></i> Back to Points
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-history text-primary me-2"></i> Activity Timeline</h4>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                <li><a class="dropdown-item" href="#">All Activities</a></li>
                                <li><a class="dropdown-item" href="#">Points Earned</a></li>
                                <li><a class="dropdown-item" href="#">Points Spent</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($activities->count() > 0)
                    <div class="timeline">
                        @foreach($activities as $activity)
                        <div class="timeline-item mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="timeline-icon {{ $activity->type == 'journal_created' ? 'bg-success' : 'bg-danger' }} text-white">
                                        @if($activity->type == 'journal_created')
                                        <i class="fas fa-plus"></i>
                                        @elseif($activity->type == 'appointment_created')
                                        <i class="fas fa-plus"></i>
                                        @elseif($activity->type == 'voucher_redeemed')
                                        <i class="fas fa-minus"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card timeline-card">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h5 class="card-title mb-0">{{ $activity->title }}</h5>
                                                <span class="badge {{ $activity->type == 'journal_created' || $activity->type == 'appointment_created' ? 'bg-success' : 'bg-danger' }}">
                                                    @if($activity->type == 'journal_created')
                                                    +5
                                                    @elseif($activity->type == 'appointment_created')
                                                    +10
                                                    @elseif($activity->type == 'voucher_redeemed')
                                                    -{{ explode(' ', $activity->description)[count(explode(' ', $activity->description)) - 2] }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->format('M d, Y - h:i A') }}</small>
                                                <span class="text-muted">Balance: {{ $userPoints->points }} points</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $activities->links() }}
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-history fa-4x text-muted mb-3"></i>
                        <h4>No Activity Yet</h4>
                        <p class="text-muted">You haven't earned or spent any points yet.</p>
                        <div class="mt-4">
                            <a href="{{ route('appointments.categories') }}" class="btn btn-primary">
                                <i class="fas fa-calendar-plus me-2"></i> Book an Appointment
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($redeemedVouchers->count() > 0)
    <div class="row mb-4">
        <div class="col-12 mb-4">
            <h3><i class="fas fa-ticket-alt text-primary me-2"></i> Redeemed Vouchers</h3>
        </div>
        @foreach($redeemedVouchers as $voucher)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 redeemed-voucher-card">
                <div class="card-header bg-success text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ $voucher->voucher->name }}</h5>
                        <span class="badge bg-white text-success">Redeemed</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <p class="card-text">{{ $voucher->voucher->description }}</p>
                    <div class="voucher-code mb-3 p-2 bg-light rounded text-center">
                        <small class="text-muted">Code:</small>
                        <span class="fw-bold">{{ $voucher->voucher->code }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-coins me-1 text-warning"></i> {{ $voucher->voucher->points_required }} points
                        </span>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($voucher->created_at)->format('M d, Y') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
    .points-summary-card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .points-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8CBF1C 0%, #5A7B12 100%);
        box-shadow: 0 10px 20px rgba(140, 191, 28, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    
    .points-circle h2 {
        width: 100%;
        text-align: center;
        margin: 0;
        line-height: 1;
    }
    
    .points-circle p {
        width: 100%;
        text-align: center;
        margin: 0;
        font-size: 14px;
    }
    
    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .timeline-card {
        border-radius: 10px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .timeline-item {
        position: relative;
    }
    
    .timeline-item:not(:last-child):before {
        content: '';
        position: absolute;
        left: 20px;
        top: 40px;
        bottom: -5px;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .redeemed-voucher-card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .redeemed-voucher-card:hover {
        transform: translateY(-5px);
    }
    
    .voucher-code {
        border: 1px dashed #dee2e6;
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
    }
    
    .text-primary {
        color: #8CBF1C!important;
    }
</style>
@endsection
