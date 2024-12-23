@extends('front.layouts.app')

@section('title', __('Build a Gift Box | BOX & TALE'))

@section('content')

    <!-- Horizontal Line -->
    <div class="choose-box-line"></div>

    <!-- Step titles -->
    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">{{ $stepNumber }}</div>
                <div class="choose-box-text">
                    <h3>{{ ['Choose Box', 'Choose Items', 'Choose Cards', 'Done'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Pick your preferred box', 'Select the items to add', 'Pick a greeting card', 'Finalize your order'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Gift Boxes Section -->
    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Choose a Box</h3>
            <p style="font-size: 14px; color: #898989">Welcome to the most convenient way to create a unique and personalized gift box for your special loved ones.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Start by choosing the desired color of your gift box!</p>
        </div>
        <div class="row gy-4 mt-4">
            @php
                $nonEmptyCategories = $categories->filter(fn($category) => $category->boxes->isNotEmpty());
            @endphp

            @foreach($nonEmptyCategories as $index => $category)
                <div class="col-12 mb-3">
                    <div class="category-name-boxsize">
                        <h4 style="position: relative; margin-right: 15px;">{{ $category->name }}</h4>
                        <p style="color: #898989; font-size: 13px; margin-top: 0;">{{ $category->box_size }}</p>
                    </div>
                </div>

                <div class="row">
                    @foreach($category->boxes as $box)
                        <div class="col-md-6 col-lg-3">
                            <div class="card gift-box-card h-100">
                                <img src="{{ asset('storage/' . $box->image) }}" alt="{{ $box->title }}" loading="lazy">
                                <div class="gift-box-content">
                                    <h5 class="gift-box-title">{{ $box->company_name }}</h5>
                                    <h5 class="gift-box-name">{{ $box->title }}</h5>
                                    <p class="gift-box-price">₼ {{ $box->price }}</p>
                                    <button class="choose-box-choose-button">Choose Box</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($index < $nonEmptyCategories->count() - 1)
                    <div class="col-12">
                        <hr style="border-top: 1px solid #a3907a; margin: 20px 0;">
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <style>
        /* Category name and box size styles */
        .category-name-boxsize h4 {
            color: #898989;
            margin-bottom: 5px;
        }

        .category-name-boxsize p {
            margin: 0;
            font-size: 13px;
            color: #898989;
        }

        /* Gift box card styles */
        .gift-box-card {
            border: none;
            width: 100%;
            height: 400px;
            margin: 0 auto;
        }

        .gift-box-card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            border-radius: 15px;
        }

        /* Content container styles */
        .gift-box-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            text-align: center;
        }

        /* Text styles */
        .gift-box-title {
            font-size: 14px;
            margin-bottom: 2px;
            color: #898989;
        }

        .gift-box-name {
            font-size: 16px;
            margin-bottom: 2px;
            color: #a39079;
        }

        .gift-box-price {
            font-size: 13px;
            margin-bottom: 12px;
            color: #212529;
        }

        /* Button styles */
        .choose-box-choose-button {
            font-size: 13px;
            padding: 8px 40px;
            border-radius: 10px;
            background-color: #ffffff;
            color: #a39079;
            border: 1px solid #a39079;
            transition: background-color 0.3s, color 0.3s;
        }

        .choose-box-choose-button:hover {
            background-color: #a39079;
            color: #ffffff;
        }
    </style>
@endsection
