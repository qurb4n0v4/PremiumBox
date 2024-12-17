@extends('front.layouts.app')

@section('content')
    <div class="container my-5 p-5" style="background-color: #ffffff; border-radius: 20px;">
        <div class="text-center corporate-gifts">
            <h2 class="fw-bold" style="color: #a3907a;">Corporate Gifts</h2>
            <p class="corporate-text" style="color: #898989;">
                Box & Tale is here to help you celebrate your special moments, whether it's small or BIG ONE! <br>
                <a href="#" class="text-decoration-none click-corporate" style="color: #a3907a;">Click to Contact Our Corporate Team</a>
            </p>
        </div>

        <div class="row mt-5 py-3" style="border-top: 1px solid #d6d6d6;">
            @foreach($corporateGifts as $gift)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 h-100 card-custom">
                        <div class="card-img-top overflow-hidden" style="aspect-ratio: 1/1;">
                            <img src="{{ asset('storage/' . $gift->image) }}" alt="{{ $gift->title }}"
                                 class="img-fluid h-100 w-100 object-fit-cover" style="border-radius: 10px;" loading="lazy">
                        </div>
                        <div class="card-body text-center">
                            <p class="text-muted mb-2" style="font-size: 13px;">{{ $gift->paragraph }}</p>
                            <h5 style="color: #a3907a;">{{ $gift->title }}</h5>
                            <a href="#" class="button-corporate-gifts btn btn-outline mt-2"
                               style="color: #a3907a; border: 1px solid #a3907a;">See Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>

@endsection
