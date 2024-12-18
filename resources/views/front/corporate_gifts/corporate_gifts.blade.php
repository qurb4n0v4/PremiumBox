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
            @foreach($corporateGifts as $index => $gift)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 h-100 card-custom">
                        <div class="card-img-top overflow-hidden" style="aspect-ratio: 1/1;">
                            <img src="{{ asset('storage/' . $gift->image) }}" alt="{{ $gift->title }}"
                                 class="img-fluid h-100 w-100 object-fit-cover" style="border-radius: 10px;" loading="lazy">
                        </div>
                        <div class="card-body text-center">
                            <p class="text-muted mb-2" style="font-size: 13px;">{{ $gift->paragraph }}</p>
                            <h5 style="color: #a3907a;">{{ $gift->title }}</h5>
                            <button
                                type="button"
                                class="button-corporate-gifts btn btn-outline mt-2"
                                style="color: #a3907a; border: 1px solid #a3907a;"
                                data-bs-toggle="modal"
                                data-bs-target="#giftDetailsModal{{ $index }}"
                            >
                                See Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Structure -->
                <div class="modal fade" id="giftDetailsModal{{ $index }}" tabindex="-1" aria-labelledby="giftDetailsModalLabel{{ $index }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 53%">
                        <div class="modal-content rounded-4">
                            <div class="modal-body pt-5">
                                <!-- Two-up Image Carousel -->
                                <div id="giftCarousel{{ $index }}" class="carousel slide two-up-carousel" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @php
                                            $images = is_string($gift->images) ? json_decode($gift->images, true) : $gift->images;
                                            $images = $images ?: [$gift->image];
                                            $chunks = array_chunk($images, 2);
                                        @endphp

                                        @foreach($chunks as $key => $imageGroup)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @foreach($imageGroup as $imageUrl)
                                                        <div class="mx-1" style="height: 340px; width: 340px; overflow: hidden;">
                                                            <img src="{{ asset('storage/' . $imageUrl) }}"
                                                                 class="d-block w-100 h-100 object-fit-cover"
                                                                 alt="Gift Image">
                                                        </div>
                                                    @endforeach

                                                    @if(count($imageGroup) < 2)
                                                        <div class="mx-1" style="height: 340px; width: 340px; overflow: hidden;">
                                                            <img src="{{ asset('storage/' . $gift->image) }}"
                                                                 class="d-block w-100 h-100 object-fit-cover"
                                                                 alt="Default Image">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-5" style="text-align: center">
                                    <h6 style="color: #343a40">{{ $gift->paragraph }}</h6>
                                    <h5 style="color: #a3907a">{{ $gift->title }}</h5>
                                    <p style="color: #a3907a">{{ $gift->created_at->format('Y') }}</p>
                                    <p style="color: #898989">{{ $gift->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const twoupCarousels = document.querySelectorAll('.two-up-carousel');
                twoupCarousels.forEach(carousel => {
                    new bootstrap.Carousel(carousel, {
                        interval: 2000,
                        ride: 'carousel'
                    });
                });
            });
        </script>
    @endpush
@endsection
