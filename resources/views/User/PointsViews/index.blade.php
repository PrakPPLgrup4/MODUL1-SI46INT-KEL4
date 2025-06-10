@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">My Rewards & Points</h1>
            <p class="lead text-muted">Earn points with every activity and redeem exciting rewards</p>
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
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="text-center mb-4 border-bottom pb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-circle-up text-success me-2"></i>
                                    <div>
                                        <h3 class="mb-0">{{ $userPoints->total_earned }}</h3>
                                        <small class="text-muted">Total Earned</small>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-circle-down text-danger me-2"></i>
                                    <div>
                                        <h3 class="mb-0">{{ $userPoints->total_spent }}</h3>
                                        <small class="text-muted">Total Spent</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('points.history') }}" class="btn btn-outline-primary">
                            <i class="fas fa-history me-2"></i> View Points History
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-gift text-primary me-2 fs-4"></i>
                        <h4 class="mb-0">How to Earn Points</h4>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="mb-2">Create a Journal</h5>
                        <p class="text-muted">Earn 10 points each time you create a new journal entry. Journaling regularly helps track your mental health progress while earning rewards!</p>
                    </div>
                    
                    <div class="alert alert-info mb-4">
                        <div class="d-flex">
                            <i class="fas fa-info-circle me-2 mt-1"></i>
                            <div>
                                <strong>Note:</strong> Points are only earned through journal entries. Create journals regularly to accumulate points that can be redeemed for valuable vouchers.
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="mb-2">Refer a Friend</h5>
                        <p class="text-muted">Earn 50 points when a friend signs up using your referral code</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0"><i class="fas fa-ticket-alt text-primary me-2"></i> Available Vouchers</h3>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort me-1"></i> Sort By
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="#">Points: Low to High</a></li>
                    <li><a class="dropdown-item" href="#">Points: High to Low</a></li>
                    <li><a class="dropdown-item" href="#">Expiry Date</a></li>
                </ul>
            </div>
        </div>
        @if($vouchers->count() > 0)
            @foreach($vouchers as $voucher)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 voucher-card">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $voucher->name }}</h5>
                            <span class="badge bg-white text-primary">{{ $voucher->points_required }} points</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="card-text">{{ $voucher->description }}</p>
                        @if($voucher->valid_until)
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="far fa-clock me-2"></i>
                            <small>Valid until: {{ \Carbon\Carbon::parse($voucher->valid_until)->format('M d, Y') }}</small>
                        </div>
                        @endif
                        <div class="voucher-code mb-3 p-2 bg-light rounded text-center">
                            <small class="text-muted">Code:</small>
                            <span class="fw-bold">{{ $voucher->code }}</span>
                        </div>
                        <div class="progress mb-3" style="height: 10px;">
                            @php
                                $percentage = min(100, ($userPoints->points / $voucher->points_required) * 100);
                            @endphp
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted d-block mb-3">You have {{ $userPoints->points }} of {{ $voucher->points_required }} points needed</small>
                        <div class="d-grid">
                            <a href="{{ route('points.voucher', $voucher->id) }}" class="btn {{ $userPoints->points < $voucher->points_required ? 'btn-outline-secondary disabled' : 'btn-primary' }}">
                                @if($userPoints->points < $voucher->points_required)
                                    <i class="fas fa-lock me-2"></i> Need {{ $voucher->points_required - $userPoints->points }} More Points
                                @else
                                    <i class="fas fa-gift me-2"></i> Redeem Now
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No vouchers available at the moment. Please check back later.
                </div>
            </div>
        @endif
    </div>

    @if($redeemedVouchers->count() > 0)
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">My Redeemed Vouchers</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Voucher</th>
                            <th>Redemption Code</th>
                            <th>Points Spent</th>
                            <th>Redeemed On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($redeemedVouchers as $redemption)
                        <tr>
                            <td>{{ $redemption->voucher->name }}</td>
                            <td><code>{{ $redemption->redemption_code }}</code></td>
                            <td>{{ $redemption->points_spent }}</td>
                            <td>{{ \Carbon\Carbon::parse($redemption->redeemed_at)->format('M d, Y h:i A') }}</td>
                            <td>
                                @if($redemption->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($redemption->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                                @elseif($redemption->status == 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
