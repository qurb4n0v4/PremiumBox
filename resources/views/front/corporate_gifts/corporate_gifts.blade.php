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
                            >
                                See Details
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal fade" id="giftDetailsModal" tabindex="-1" aria-labelledby="giftDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="giftDetailsModalLabel">Gift Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Autoplay Image Slider -->
                        <div id="giftCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Example images - replace with dynamic content -->
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/' . $gift->image) }}" class="d-block w-100" alt="Gift Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $gift->image) }}" class="d-block w-100" alt="Gift Image 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $gift->image) }}" class="d-block w-100" alt="Gift Image 3">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h5 id="giftTitle" class="text-muted">{{ $gift->title }}</h5>
                            <p id="giftParagraph" class="text-muted" style="font-size: 14px;">Additional Information</p>
                            <p id="giftYear" class="text-muted" style="font-size: 14px;">Year</p>
                            <p id="giftDescription">Detailed Description</p>
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
            var button = event.relatedTarget;

            var title = button.getAttribute('data-title');
            var description = button.getAttribute('data-description');
            var image = button.getAttribute('data-image');

            var modalTitle = giftDetailsModal.querySelector('.modal-title');
            var modalDescription = giftDetailsModal.querySelector('#giftDescription');
            var modalImage = giftDetailsModal.querySelector('#giftImage');

            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modalImage.src = image;
        });


        document.addEventListener('DOMContentLoaded', function() {
            // Example of setting modal content dynamically
            function updateGiftModal(title, paragraph, year, description, images) {
                document.getElementById('giftTitle').textContent = title;
                document.getElementById('giftParagraph').textContent = paragraph;
                document.getElementById('giftYear').textContent = year;
                document.getElementById('giftDescription').textContent = description;

                // Update carousel images
                const carouselInner = document.querySelector('#giftCarousel .carousel-inner');
                carouselInner.innerHTML = ''; // Clear existing items

                images.forEach((src, index) => {
                    const carouselItem = document.createElement('div');
                    carouselItem.classList.add('carousel-item');
                    if (index === 0) carouselItem.classList.add('active');

                    const img = document.createElement('img');
                    img.src = src;
                    img.classList.add('d-block', 'w-100');
                    img.alt = `Gift Image ${index + 1}`;

                    carouselItem.appendChild(img);
                    carouselInner.appendChild(carouselItem);
                });

                // Reinitialize carousel
                new bootstrap.Carousel(document.getElementById('giftCarousel'), {
                    interval: 3000, // Autoplay every 3 seconds
                    ride: 'carousel'
                });
            }

            // Example usage
            // updateGiftModal('Vintage Watch', 'A classic timepiece', '1965', 'Beautifully preserved...', ['/path/to/image1.jpg', '/path/to/image2.jpg']);
        });
    </script>
@endpush
