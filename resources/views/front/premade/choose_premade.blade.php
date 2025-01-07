@extends('front.layouts.app')
@section('title', __('Hazır Hədiyyə Qutusu Seçin | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-premade.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">

@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 3) as $stepNumber)
            <div class="choose-box-step">
                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">{{ $stepNumber }}</div>
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Fərdiləşdirin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Qutunuzu fərdiləşdirin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutu Seçin</h3>
            <p style="font-size: 14px; color: #898989">Hazır paketlərimizdən alış-veriş edin: Sizin üçün sürətli, əngəlsiz, göndərilməyə hazır hədiyyə qutuları.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Sifarişə davam etmək üçün aşağıdakı qutulardan seçiminizi edin!</p>
        </div>

        <hr class="mt-5 mb-5">

        <div>
            <div class="row">
                <!-- Left Sidebar for Filtering -->
                <div class="col-12 col-md-3">
                    <div class="filters">
                        <h5>Filter Products</h5>

                        <!-- Recipient Filter -->
                        <div class="filter-section">
                            <label for="recipient">Recipient</label>
                            <select id="recipient" class="form-control">
                                <option value="all">All</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="children">Children</option>
                            </select>
                        </div>

                        <!-- Occasions Filter -->
                        <div class="filter-section">
                            <label for="occasions">Occasions</label>
                            <select id="occasions" class="form-control">
                                <option value="all">All</option>
                                <option value="birthday">Birthday</option>
                                <option value="wedding">Wedding</option>
                                <option value="anniversary">Anniversary</option>
                            </select>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter-section">
                            <label for="price-range">Price Range</label>
                            <input type="range" id="price-range" class="form-control" min="0" max="1000" step="10">
                            <span id="price-range-label">₼ 0 - ₼ 1000</span>
                        </div>

                        <!-- Production Time Filter -->
                        <div class="filter-section">
                            <label for="production-time">Production Time</label>
                            <select id="production-time" class="form-control">
                                <option value="all">All</option>
                                <option value="1">1 day</option>
                                <option value="3">3 days</option>
                                <option value="7">7 days</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar for Products, Search, and Sort -->
                <div class="col-12 col-md-9">
                    <!-- Search and Sort -->
                    <div class="d-flex justify-content-between mb-4">
                        <!-- Search Box -->
                        <div class="search-container">
                            <input type="text" id="search-box" class="form-control" placeholder="Search for boxes...">
                        </div>
                        <!-- Sort Options -->
                        <div class="sort-container">
                            <select id="sort-boxes" class="form-control">
                                <option value="default">Sort by: Default</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                                <option value="name_asc">Name: A to Z</option>
                                <option value="name_desc">Name: Z to A</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="row">
                        @foreach ($premadeBoxDetail as $box)
                            @if($box->is_available) <!-- If box is available -->
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card w-100 h-100 d-flex flex-column align-items-stretch" style="border-color: transparent; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#boxModal{{ $box->id }}">
                                    <div class="rounded">
                                        <div class="text-center position-relative image-container">
                                            <!-- Normal Image -->
                                            <img
                                                src="https://wallpapers.com/images/hd/beautiful-sunset-pictures-ubxtuvfhpoampb6d.jpg"
                                                alt="{{ $box->name }}"
                                                class="card-img-top rounded-top rounded-bottom normal-image">

                                            <!-- Hover Image -->
                                            <img
                                                src="https://images.wallpaperscraft.com/image/single/firtrees_lake_mountains_22568_1280x720.jpg"
                                                alt="{{ $box->name }}"
                                                class="card-img-top rounded-top rounded-bottom hover-image">
                                        </div>
                                    </div>

                                    <div class="card-block my-2" style="flex-grow: 1;">
                                        <h5 class="text-center text-theme h4 mb-1 text-capitalize font-butler">{{ $box->name }}</h5>
                                        <!-- Price -->
                                        <p class="card-text text-center font-avenir-black">₼ {{ number_format($box->price, 2) }}</p>
                                    </div>
                                    <div class="text-center small my-2">
                                        {{ $box->title }}
                                    </div>
                                    <div class="mt-1">
                                        <!-- Add to Cart Button -->
                                        <button class="w-100" data-bs-toggle="modal" data-bs-target="#boxModal{{ $box->id }}">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    @foreach ($premadeBoxDetail as $box)
        <div class="modal fade" id="boxModal{{ $box->id }}" tabindex="-1" aria-labelledby="boxModalLabel{{ $box->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="boxModalLabel{{ $box->id }}">{{ $box->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="card w-100 h-100 d-flex flex-column align-items-stretch" style="border-color: transparent; cursor: pointer;">
                                <div class="rounded">
                                    <!-- Carousel Container -->
                                    <div id="carousel{{ $box->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <!-- Normal Image (First Slide) -->
                                            <div class="carousel-item active">
                                                <img src="https://wallpapers.com/images/hd/beautiful-sunset-pictures-ubxtuvfhpoampb6d.jpg"
                                                     alt="{{ $box->name }}"
                                                     class="card-img-top rounded-top rounded-bottom normal-image">
                                            </div>
                                            <!-- Hover Image (Second Slide) -->
                                            <div class="carousel-item">
                                                <img src="https://images.wallpaperscraft.com/image/single/firtrees_lake_mountains_22568_1280x720.jpg"
                                                     alt="{{ $box->name }}"
                                                     class="card-img-top rounded-top rounded-bottom hover-image">
                                            </div>
                                        </div>
                                        <!-- Carousel Controls -->
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $box->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $box->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <h4>{{ $box->title }}</h4>
                                <p>{{ $box->description }}</p>
                                <p><strong>Price:</strong> ₼ {{ number_format($box->price, 2) }}</p>
                                <p><strong>Occasions:</strong> {{ $box->occasions }}</p>
                                <p><strong>Recipient:</strong> {{ $box->recipient }}</p>
                                <button class="btn btn-theme w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
