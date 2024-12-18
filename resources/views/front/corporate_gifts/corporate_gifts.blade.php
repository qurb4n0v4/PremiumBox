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
                            <!-- Modal Trigger -->
                            <button
                                type="button"
                                class="button-corporate-gifts btn btn-outline mt-2"
                                style="color: #a3907a; border: 1px solid #a3907a;"
                                data-bs-toggle="modal"
                                data-bs-target="#giftDetailsModal"
                                data-title="{{ $gift->title }}"
                                data-description="{{ $gift->description }}"
                                data-image="{{ asset('storage/' . $gift->image) }}"
                                data-images="{{ json_encode($gift->images) }}"
                            >
                            See Details
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal Structure -->
        <div class="modal fade" id="giftDetailsModal" tabindex="-1" aria-labelledby="giftDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="giftDetailsModalLabel">Gift Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Image Carousel -->
                        <div id="giftCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner" id="carouselImages">
                                <!-- Dynamically updated images will be inserted here -->
                            </div>
                        </div>
                        <div class="mt-3">
                            <h5 id="giftTitle" class="text-muted">{{ $gift->title }}</h5>
                            <p id="giftDescription" class="text-muted" style="font-size: 14px;">{{ $gift->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        var giftDetailsModal = document.getElementById('giftDetailsModal');
        giftDetailsModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // The button that triggered the modal

            // Get the data attributes from the clicked button
            var title = button.getAttribute('data-title');
            var description = button.getAttribute('data-description');
            var image = button.getAttribute('data-image');
            var additionalImages = JSON.parse(button.getAttribute('data-additional-images')); // Assuming you have additional images as JSON

            // Set the modal title and description
            var modalTitle = giftDetailsModal.querySelector('.modal-title');
            var modalDescription = giftDetailsModal.querySelector('#giftDescription');
            var modalImage = giftDetailsModal.querySelector('#giftCarousel .carousel-inner');

            // Set the title and description
            modalTitle.textContent = title;
            modalDescription.textContent = description;

            // Clear the carousel content
            modalImage.innerHTML = '';

            // Add the main image as the first carousel item
            var carouselItem = document.createElement('div');
            carouselItem.classList.add('carousel-item', 'active');
            var img = document.createElement('img');
            img.src = image;
            img.classList.add('d-block', 'w-100');
            img.alt = 'Gift Image';
            carouselItem.appendChild(img);
            modalImage.appendChild(carouselItem);

            // Add additional images to the carousel
            additionalImages.forEach(function(imageSrc, index) {
                var carouselItem = document.createElement('div');
                carouselItem.classList.add('carousel-item');
                if (index === 0) {
                    carouselItem.classList.add('active');
                }
                var img = document.createElement('img');
                img.src = imageSrc;
                img.classList.add('d-block', 'w-100');
                img.alt = 'Gift Image';
                carouselItem.appendChild(img);
                modalImage.appendChild(carouselItem);
            });

            // Initialize the carousel
            var myCarousel = new bootstrap.Carousel(giftDetailsModal.querySelector('#giftCarousel'), {
                interval: 3000, // Autoplay every 3 seconds
                ride: 'carousel'
            });
        });
    </script>
@endpush


