@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('points.index') }}">Rewards & Points</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Voucher Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">{{ $voucher->name }}</h3>
                        <span class="badge bg-white text-primary fs-5">{{ $voucher->points_required }} points</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <div class="voucher-image-container">
                                @if($voucher->image_path)
                                    <img src="{{ asset('images/vouchers/' . $voucher->image_path) }}" alt="{{ $voucher->name }}" class="img-fluid rounded">
                                @else
                                    <div class="voucher-placeholder d-flex align-items-center justify-content-center rounded">
                                        <i class="fas fa-ticket-alt fa-4x text-primary"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">Description</h4>
                            <p class="card-text fs-5">{{ $voucher->description }}</p>
                            
                            @if($voucher->valid_until)
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="far fa-clock me-2"></i>
                                <span>Valid until: {{ \Carbon\Carbon::parse($voucher->valid_until)->format('M d, Y') }}</span>
                            </div>
                            @endif
                            
                            <div class="voucher-code mb-4 p-3 bg-light rounded text-center">
                                <small class="text-muted d-block mb-1">Voucher Code:</small>
                                <span class="fw-bold fs-4">{{ $voucher->code }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="mb-3">Redemption Progress</h4>
                            <div class="progress mb-3" style="height: 20px;">
                                @php
                                    $percentage = min(100, ($userPoints->points / $voucher->points_required) * 100);
                                @endphp
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ round($percentage) }}%
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Your Points: {{ $userPoints->points }}</span>
                                <span class="text-muted">Required: {{ $voucher->points_required }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h4 class="mb-3">Terms & Conditions</h4>
                                    <ul class="mb-0">
                                        <li>This voucher is valid for one-time use only</li>
                                        <li>Cannot be combined with other promotions or discounts</li>
                                        <li>No cash value or cash back</li>
                                        @if($voucher->terms)
                                            @foreach(explode("\n", $voucher->terms) as $term)
                                                <li>{{ $term }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            @if($userPoints->points >= $voucher->points_required)
                                <form action="{{ route('vouchers.redeem', $voucher->id) }}" method="POST">
                                    @csrf
                                    <div class="alert alert-info mb-4">
                                        <i class="fas fa-info-circle me-2"></i>
                                        By redeeming this voucher, <strong>{{ $voucher->points_required }} points</strong> will be deducted from your account.
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-gift me-2"></i> Redeem This Voucher
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-warning mb-4">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    You need <strong>{{ $voucher->points_required - $userPoints->points }} more points</strong> to redeem this voucher.
                                </div>
                                <div class="d-grid">
                                    <a href="{{ route('views.journal') }}" class="btn btn-outline-primary btn-lg">
                                        <i class="fas fa-book me-2"></i> Create Journal to Earn Points
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('points.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Back to Rewards
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .voucher-placeholder {
        height: 200px;
        background-color: #f8f9fa;
        color: #8CBF1C;
    }
    
    .voucher-image-container {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .voucher-image-container img {
        max-height: 100%;
        object-fit: contain;
    }
</style>
@endsection
