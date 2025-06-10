@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Choose Your Counseling Category</h1>
            <p class="lead text-muted">Select the type of counseling that best addresses your current needs</p>
        </div>
    </div>

    <div class="row">
        @php
            $categoryImages = [
                'Individual Counseling' => 'psy1.png',
                'Couples Therapy' => 'psy2.png',
                'Family Counseling' => 'psy3.png',
                'Anxiety Management' => 'Anxiety.png',
                'Depression Treatment' => 'Depression.png',
                'Career Counseling' => 'Stress.png',
            ];
        @endphp
        
        @foreach($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="category-card">
                <div class="category-card-inner">
                    <div class="category-image">
                        @php
                            $imageName = isset($categoryImages[$category->name]) ? $categoryImages[$category->name] : 'psy1.png';
                        @endphp
                        <img src="{{ asset('images/' . $imageName) }}" alt="{{ $category->name }}">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">{{ $category->name }}</h3>
                        <p class="category-description">{{ $category->description }}</p>
                        <div class="category-price">
                            <span class="price-tag">Rp {{ number_format($category->price, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('appointments.psychiatrists', $category->id) }}" class="btn-select-category">
                            <span>Select</span>
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
                    <h4 class="mb-3">Why Choose Our Counseling Services?</h4>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-md text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5>Expert Specialists</h5>
                                    <p class="text-muted">Our team consists of highly qualified and experienced mental health professionals.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-lock text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5>Confidentiality</h5>
                                    <p class="text-muted">Your privacy is our priority. All sessions are completely confidential.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-calendar-check text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5>Flexible Scheduling</h5>
                                    <p class="text-muted">Choose from a variety of available time slots that fit your schedule.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-heart text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5>Personalized Care</h5>
                                    <p class="text-muted">Each session is tailored to address your specific needs and concerns.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Category Card Styles */
    .category-card {
        position: relative;
        height: 100%;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
    }
    
    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .category-card-inner {
        display: flex;
        flex-direction: column;
        height: 100%;
        background-color: white;
    }
    
    .category-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    
    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .category-card:hover .category-image img {
        transform: scale(1.1);
    }
    
    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));
    }
    
    .category-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .category-title {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        position: relative;
        padding-bottom: 12px;
    }
    
    .category-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #8CBF1C, #5A9216);
        border-radius: 3px;
    }
    
    .category-description {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }
    
    .category-price {
        margin-bottom: 20px;
    }
    
    .price-tag {
        display: inline-block;
        background-color: #f0f7e6;
        color: #5A9216;
        font-weight: 700;
        font-size: 16px;
        padding: 8px 16px;
        border-radius: 30px;
    }
    
    .btn-select-category {
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
    }
    
    .btn-select-category span {
        margin-right: 10px;
    }
    
    .btn-select-category i {
        transition: transform 0.3s ease;
    }
    
    .btn-select-category:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(140, 191, 28, 0.4);
        color: white;
    }
    
    .btn-select-category:hover i {
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
</style>
@endsection
