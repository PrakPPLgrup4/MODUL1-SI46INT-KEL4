@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Choose Your Specialist</h1>
            <p class="lead text-muted">Select a specialist for your <span class="fw-bold text-primary">{{ $category->name }}</span> appointment</p>
        </div>
    </div>

    <div class="row">
        @php
            $imageSources = [
                1 => 'doctor1.png',
                2 => 'psy1.png',
                3 => 'psy2.png',
                4 => 'psy3.png',
            ];
        @endphp
        
        @foreach($psychiatrists as $psychiatrist)
        <div class="col-md-4 mb-4">
            <div class="psychiatrist-card">
                <div class="psychiatrist-header">
                </div>
                <div class="psychiatrist-body">
                    <div class="psychiatrist-image">
                        @php
                            $imageIndex = $loop->iteration;
                            if ($imageIndex > count($imageSources)) {
                                $imageIndex = $imageIndex % count($imageSources);
                                if ($imageIndex == 0) $imageIndex = count($imageSources);
                            }
                            $imageSource = $imageSources[$imageIndex];
                        @endphp
                        <img src="{{ asset('images/' . $imageSource) }}" alt="{{ $psychiatrist-> full_name }}">
                    </div>
                    <div class="psychiatrist-info">
                        <h3 class="psychiatrist-name"> {{ $psychiatrist->full_name }}</h3>
                        <div class="psychiatrist-experience">
                            <i class="fas fa-certificate"></i> {{ $psychiatrist->rating_count }} Rating
                        </div>
                        <div class="psychiatrist-bio">
                            {{ Str::limit($psychiatrist->description, 150) }}
                        </div>
                        <a href="{{ route('appointments.slots') }}?category={{ $category->id }}&psychiatrist={{ $psychiatrist->id }}" class="btn-select-psychiatrist">
                            <span>Select This Specialist</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-3">What to Expect From Your Session</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-start mb-3">
                            <span class="badge bg-primary rounded-circle p-2 me-3 mt-1"><i class="fas fa-comments"></i></span>
                            <div>
                                <h5>Initial Assessment</h5>
                                <p class="text-muted">Your specialist will begin by understanding your concerns and goals for the session.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start mb-3">
                            <span class="badge bg-primary rounded-circle p-2 me-3 mt-1"><i class="fas fa-brain"></i></span>
                            <div>
                                <h5>Personalized Approach</h5>
                                <p class="text-muted">Based on your needs, your specialist will use appropriate therapeutic techniques.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <span class="badge bg-primary rounded-circle p-2 me-3 mt-1"><i class="fas fa-clipboard-list"></i></span>
                            <div>
                                <h5>Action Plan</h5>
                                <p class="text-muted">You'll receive practical strategies and a plan for moving forward after your session.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('appointments.categories') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Categories
            </a>
        </div>
    </div>
</div>

<style>
    /* Psychiatrist Card Styles */
    .psychiatrist-card {
        background-color: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        height: 100%;
        position: relative;
    }
    
    .psychiatrist-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .psychiatrist-header {
        height: 80px;
        background: linear-gradient(135deg, #8CBF1C, #5A9216);
        position: relative;
    }
    
    .psychiatrist-badge {
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
    
    .psychiatrist-body {
        padding: 0 25px 25px;
        position: relative;
    }
    
    .psychiatrist-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: -60px auto 15px;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        background-color: #f0f7e6;
    }
    
    .psychiatrist-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .psychiatrist-info {
        text-align: center;
    }
    
    .psychiatrist-name {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }
    
    .psychiatrist-experience {
        color: #777;
        font-size: 15px;
        margin-bottom: 15px;
        display: inline-block;
        padding: 5px 12px;
        background-color: #f0f7e6;
        border-radius: 20px;
    }
    
    .psychiatrist-experience i {
        color: #8CBF1C;
        margin-right: 5px;
    }
    
    .psychiatrist-bio {
        color: #555;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 25px;
        text-align: center;
    }
    
    .btn-select-psychiatrist {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(90deg, #8CBF1C, #5A9216);
        color: white;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(140, 191, 28, 0.3);
        width: 100%;
    }
    
    .btn-select-psychiatrist span {
        margin-right: 10px;
    }
    
    .btn-select-psychiatrist i {
        transition: transform 0.3s ease;
    }
    
    .btn-select-psychiatrist:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(140, 191, 28, 0.4);
        color: white;
    }
    
    .btn-select-psychiatrist:hover i {
        transform: translateX(5px);
    }
    
    .btn-primary {
        background-color: #8CBF1C;
        border-color: #8CBF1C;
    }
    
    .btn-primary:hover {
        background-color: #7aa919;
        border-color: #7aa919;
    }
    
    .text-primary {
        color: #8CBF1C!important;
    }
    
    .bg-primary {
        background-color: #8CBF1C!important;
    }
    
    .badge.bg-primary {
        background-color: #8CBF1C!important;
    }
</style>
@endsection
