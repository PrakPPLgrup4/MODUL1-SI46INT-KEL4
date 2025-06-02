@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Redeem Your Voucher</h1>
            <p class="lead text-muted">Review the details and confirm your voucher redemption</p>
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
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0 mb-4 voucher-detail-card">
                <div class="card-header bg-primary text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">{{ $voucher->name }}</h4>
                        <span class="badge bg-white text-primary px-3 py-2">{{ $voucher->points_required }} points</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="voucher-code-container mb-4 p-3 bg-light rounded text-center position-relative">
                        <div class="position-absolute top-0 start-0 translate-middle-y ms-3 badge bg-primary">VOUCHER CODE</div>
                        <h3 class="voucher-code mt-2 mb-0">{{ $voucher->code }}</h3>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="description-box p-3 rounded">
                                <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i> Description</h5>
                                <p class="mb-0">{{ $voucher->description }}</p>
                            </div>
                        </div>
                    <div class="d-grid gap-2 mt-4">
                        @if($userPoints->points >= $voucher->points_required)
                        <form action="{{ route('vouchers.redeem', $voucher->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg" onclick="return confirm('Are you sure you want to redeem this voucher for {{ $voucher->points_required }} points?')">
                                Redeem Voucher
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-lg" disabled>
                            Need {{ $voucher->points_required - $userPoints->points }} more points
                        </button>
                        @endif
                        <a href="{{ route('points.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
