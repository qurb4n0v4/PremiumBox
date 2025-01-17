@extends('front.layouts.app')
@section('title', __('Hazır Hədiyyə Qutusu Seçin | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-premade.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @php
            $routes = [
                1 => 'choose_premade_box',
                2 => 'customize_premade_box',
                3 => 'done_premade'
            ];

            $stepTitles = ['Qutu Seçin', 'Fərdiləşdirin', 'Tamamlandı'];
            $stepDescriptions = ['Seçdiyiniz qutunu seçin', 'Qutunuzu fərdiləşdirin', 'Sifarişi tamamlayın'];
        @endphp

        @foreach (range(1, 3) as $stepNumber)
            <div
                class="choose-box-step"
                @if($stepNumber < 3)
                    @if($stepNumber == 2)
                        onclick="window.location.href='{{ isset($selectedBoxId) ? route($routes[$stepNumber], $selectedBoxId) : route($routes[$stepNumber]) }}'"
                @else
                    onclick="window.location.href='{{ route($routes[$stepNumber]) }}'"
                @endif
                style="cursor: pointer;"
                @endif
            >
                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </div>
                <div class="choose-box-text">
                    <h3>{{ $stepTitles[$stepNumber - 1] }}</h3>
                    <p>{{ $stepDescriptions[$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutu Seçin</h3>
            <p style="font-size: 14px; color: #898989">Hazır paketlərimizdən alış-veriş edin: Sizin üçün sürətli, əngəlsiz, göndərilməyə hazır hədiyyə qutuları.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Sifarişə davam etmək üçün aşağıdakı qutulardan seçiminizi edin!</p>
        </div>

        <hr class="mt-5 mb-5">

        <div>
            <div class="row">
                <!-- Sol Sidebar (Filtrləmə) -->
                <div class="col-12 col-md-3">
                    <div class="filters">
                        <h5>Məhsulları Filtrləyin</h5>

                        <!-- Alıcı Filtresi -->
                        <div class="filter-section my-4">
                            <label class="filter-label mb-2">Alıcı</label>
                            <div class="filter-buttons">
                                @foreach($recipients as $recipient)
                                    <button class="filter-btn"
                                            data-filter="recipient"
                                            data-value="{{ $recipient['name'] }}">
                                        {{ $recipient['name'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Xüsusi Günlər -->
                        <div class="filter-section mb-4">
                            <label class="filter-label mb-2">Xüsusi Günlər</label>
                            <div class="filter-buttons">
                                @foreach($occasions as $occasion)
                                    <button class="filter-btn"
                                            data-filter="occasion"
                                            data-value="{{ $occasion['name'] }}">
                                        {{ $occasion['name'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Qiymət Aralığı -->
                        <div class="filter-section mb-4">
                            <label class="filter-label mb-2">Qiymət Aralığı</label>
                            <div class="price-range-container">
                                <div class="price-inputs d-flex gap-2">
                                    <input type="number"
                                           class="form-control form-control-sm"
                                           id="min-price"
                                           placeholder="Min">
                                    <input type="number"
                                           class="form-control form-control-sm"
                                           id="max-price"
                                           placeholder="Max">
                                </div>
                                <button class="filter-btn w-100 mt-2"
                                        data-filter="price">
                                    Tətbiq et
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sağ Sidebar (Məhsullar) -->
                <div class="col-12 col-md-9">
                    <!-- Axtar və Sırala -->
                    <div class="d-flex justify-content-between mb-4">
                        <!-- Axtarış -->
                        <div class="search-container">
                            <input type="text" id="search-box" class="form-control" placeholder="Qutuları axtarın...">
                        </div>
                        <!-- Sırala -->
                        <div class="sort-container">
                            <select id="sort-boxes" class="form-control">
                                <option value="default">Sırala: Varsayılan</option>
                                <option value="price_asc">Qiymət: Artan</option>
                                <option value="price_desc">Qiymət: Azalan</option>
                                <option value="name_asc">Ad: A-dan Z-yə</option>
                                <option value="name_desc">Ad: Z-dən A-ya</option>
                            </select>
                        </div>
                    </div>

                    <!-- Məhsullar -->
                    <div class="row">
                        @foreach ($premadeBoxes as $box)
                            @php
                                $boxDetail = $box->details;
                                $uniqueCarouselId = "boxCarousel_{$box->id}";
                                $uniqueModalId = "modal_{$box->id}";
                            @endphp
                            <div class="col-12 col-md-4 mb-4 premade-box"
                                 data-recipient="{{ $box->recipient }}"
                                 data-occasion="{{ $box->occasion }}"
                                 data-price="{{ $box->price }}">

                                <div class="card w-100 h-100 d-flex flex-column align-items-center" style="border-color: transparent; cursor: pointer;">
                                    <div class="rounded">
                                        <div class="text-center position-relative image-container" style="height: 200px; width: 200px; overflow: hidden;">
                                            <!-- Normal Image -->
                                            <img
                                                src="{{ asset('storage/' . $box->normal_image) }}"
                                                alt="{{ $box->name }}"
                                                class="card-img-top rounded-top rounded-bottom d-block w-100 h-100 object-fit-cover"
                                            >

                                            <!-- Hover Image -->
                                            @if ($box->hover_image)
                                                <img
                                                    src="{{ asset('storage/' . $box->hover_image) }}"
                                                    alt="{{ $box->name }}"
                                                    class="card-img-top rounded-top rounded-bottom d-block w-100 h-100 object-fit-cover"
                                                >
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-block my-2" style="flex-grow: 1;">
                                        <h6 class="gift-box-title">{{ $box->title }}</h6>
                                        <div class="gift-box-name">
                                            {{ $box->name }}
                                        </div>
                                    </div>
                                    <p class="gift-box-price">₼ {{ number_format($box->price, 2) }}</p>
                                    <div class="mt-1" style="text-align: center !important;">
                                        <!-- Səbətə Əlavə -->
                                        <button class="choose-box-choose-button" style="text-align: center" data-bs-toggle="modal" data-bs-target="#{{ $uniqueModalId }}">Səbətə Əlavə</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal" id="{{ $uniqueModalId }}">
                                <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                    <div class="modal-content rounded-4">

                                        <div class="modal-body p-4">
                                            <div class="d-flex align-items-start gap-4">
                                                <!-- Slider -->
                                                <div class="position-relative" style="width: 360px; flex-shrink: 0;">

                                                    <div class="carousel slider" id="{{ $uniqueCarouselId }}" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @if($premadeBoxDetail && !empty($premadeBoxDetail->images))
                                                                @foreach($premadeBoxDetail->images as $key => $image)
                                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                        <div style="height: 340px; width: 360px; overflow: hidden;">
                                                                            <img src="{{ asset('storage/' . $image) }}"
                                                                                 class="slider-item d-block w-100 h-100 object-fit-cover"
                                                                                 alt="Box Image">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="carousel-item active">
                                                                    <div style="height: 340px; width: 360px; overflow: hidden;">
                                                                        <img src="{{ asset('storage/' . $box->normal_image) }}"
                                                                             class="slider-item d-block w-100 h-100 object-fit-cover"
                                                                             alt="Box Image">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{--                                                    <button class="slider-prev">‹</button>--}}
                                                    {{--                                                    <button class="slider-next">›</button>--}}
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $uniqueCarouselId }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Əvvəlki</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $uniqueCarouselId }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Sonrakı</span>
                                                    </button>
                                                </div>

                                                <!-- Details -->
                                                <div class="flex-grow-1">
                                                    <div class="text-start">
                                                        <h2 class="mb-2" style="color: #898989; font-size: 14px;">{{ $box->title }}</h2>
                                                        <div class="gift-box-name" style="font-size: 21px; font-weight: 600">
                                                            {{ $box->name }}
                                                        </div>
                                                        <p class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500">₼ {{ $box->price }}</p>
                                                        @if($box->details->first() && $box->details->first()->paragraph)
                                                            <div data-v-231e0cc6="" class="font-avenir-light mb-3">
                                                                <p data-v-231e0cc6="" class="mb-0 text-center description text-theme-secondary" style="overflow-wrap: break-word;">
                                                                    @if(strlen($box->details->first()->paragraph) > 100)
                                                                        <span class="short-paragraph">{{ substr($box->details->first()->paragraph, 0, 100) }}...</span>
                                                                        <span class="d-none full-paragraph">{{ $box->details->first()->paragraph }}</span>
                                                                    @else
                                                                        <span>{{ $box->details->first()->paragraph }}</span>
                                                                    @endif
                                                                </p>
                                                                @if(strlen($box->details->first()->paragraph) > 100)
                                                                    <div class="text-center mb-2">
                                                                        <a href="javascript:void(0);" class="toggle-button" style="font-size: 12px; font-weight: normal" onclick="toggleParagraph(this)">Show More</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <p>Details not available.</p>
                                                        @endif
                                                    </div>

                                                    <!-- What's Inside -->
                                                    <div class="accordion mb-4">
                                                        <div class="accordion-header">
                                                            <h2 class="mb-0 text-center">
                                                                <button type="button"
                                                                        class="pt-0 btn btn-header-link pl-md-0 text-theme h5 text-center collapse-button px-3"
                                                                        onclick="toggleAccordion('collapse-inside-{{ $box->id }}')">
                                                                    <span class="mr-1" style="color: #898989; font-size: 12px">What's Inside</span>
                                                                </button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse-inside-{{ $box->id }}" class="collapse-content">
                                                            <div class="collapse-inner">
                                                                <div class="d-flex flex-column align-items-center pb-3">
                                                                    <div style="max-width: 80vw !important;">
                                                                        @foreach($box->insidings as $insiding)
                                                                            <div class="d-flex align-items-center pb-3 gap-3">
                                                                                <img src="{{ $insiding->image }}"
                                                                                     alt="{{ $insiding->name }}"
                                                                                     style="width: 35px; height: 35px; object-fit: contain;">
                                                                                <div class="d-flex flex-column justify-content-start pl-3">
                                                                                    <p class="font-butler text-theme-secondary text-capitalize mb-0">
                                                                                        {{ $insiding->name }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Customize Button -->
                                                    <div>
                                                        <button
                                                            type="button"
                                                            class="choose-box-customize-button"
                                                            onclick="window.location.href='{{ route('customize_premade_box', $box->id) }}'"
                                                        >
                                                            Tənzimləmək
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS ve Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<script>
    document.querySelectorAll('.slider-container').forEach(container => {
        const slider = container.querySelector('.slider');
        const items = container.querySelectorAll('.slider-item');
        const prevButton = container.querySelector('.slider-prev');
        const nextButton = container.querySelector('.slider-next');

        let currentIndex = 0;

        const updateSlider = () => {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        };

        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
            updateSlider();
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
            updateSlider();
        });
    });

    function toggleParagraph(link) {
        const container = link.closest('.font-avenir-light');
        const shortParagraph = container.querySelector('.short-paragraph');
        const fullParagraph = container.querySelector('.full-paragraph');

        if (shortParagraph && fullParagraph) {
            if (fullParagraph.classList.contains('d-none')) {
                shortParagraph.classList.add('d-none');
                fullParagraph.classList.remove('d-none');
                link.textContent = "Show Less";
            } else {
                shortParagraph.classList.remove('d-none');
                fullParagraph.classList.add('d-none');
                link.textContent = "Show More";
            }
        }
    }

    function toggleAccordion(id) {
        const content = document.getElementById(id);
        const allContents = document.querySelectorAll('.collapse-content');

        allContents.forEach(item => {
            if (item.id !== id && item.style.height !== '0px') {
                item.style.height = '0px';
            }
        });

        if (content.style.height === '0px' || content.style.height === '') {
            content.style.height = content.scrollHeight + 'px';
        } else {
            content.style.height = '0px';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const contents = document.querySelectorAll('.collapse-content');
        contents.forEach(content => {
            content.style.height = '0px';
        });
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     const filterButtons = document.querySelectorAll('.filter-btn');
    //     const boxes = document.querySelectorAll('.premade-box');
    //     const searchBox = document.getElementById('search-box');
    //     const sortSelect = document.getElementById('sort-boxes');
    //
    //     let activeFilters = {
    //         recipient: null,
    //         occasion: null,
    //         price: {
    //             min: null,
    //             max: null
    //         }
    //     };
    //
    //     // Filter butonları için event listener
    //     filterButtons.forEach(button => {
    //         button.addEventListener('click', function() {
    //             const filterType = this.dataset.filter;
    //             const filterValue = this.dataset.value;
    //
    //             // Toggle active class
    //             if (filterType !== 'price') {
    //                 if (activeFilters[filterType] === filterValue) {
    //                     // Aynı butona tekrar tıklandıysa filtreyi kaldır
    //                     activeFilters[filterType] = null;
    //                     this.classList.remove('active');
    //                 } else {
    //                     // Diğer butonlardan active class'ı kaldır
    //                     document.querySelectorAll(`.filter-btn[data-filter="${filterType}"]`)
    //                         .forEach(btn => btn.classList.remove('active'));
    //
    //                     // Yeni filtre değerini ata ve butonu aktif yap
    //                     activeFilters[filterType] = filterValue;
    //                     this.classList.add('active');
    //                 }
    //             } else {
    //                 // Fiyat filtresi için
    //                 const minPrice = parseFloat(document.getElementById('min-price').value) || null;
    //                 const maxPrice = parseFloat(document.getElementById('max-price').value) || null;
    //
    //                 activeFilters.price = {
    //                     min: minPrice,
    //                     max: maxPrice
    //                 };
    //             }
    //
    //             applyFilters();
    //         });
    //     });
    //
    //     function applyFilters() {
    //         boxes.forEach(box => {
    //             let shouldShow = true;
    //
    //             // Recipient filter
    //             if (activeFilters.recipient !== null) {
    //                 shouldShow = box.dataset.recipient === activeFilters.recipient;
    //             }
    //
    //             // Occasion filter
    //             if (shouldShow && activeFilters.occasion !== null) {
    //                 shouldShow = box.dataset.occasion === activeFilters.occasion;
    //             }
    //
    //             // Price filter
    //             if (shouldShow && (activeFilters.price.min !== null || activeFilters.price.max !== null)) {
    //                 const price = parseFloat(box.dataset.price);
    //                 if (activeFilters.price.min !== null && price < activeFilters.price.min) {
    //                     shouldShow = false;
    //                 }
    //                 if (activeFilters.price.max !== null && price > activeFilters.price.max) {
    //                     shouldShow = false;
    //                 }
    //             }
    //
    //             // Update visibility
    //             box.style.display = shouldShow ? '' : 'none';
    //         });
    //     }
    //
    //     // Reset filters button (add this to your HTML if needed)
    //     const resetButton = document.createElement('button');
    //     resetButton.textContent = 'Filtrleri Sıfırla';
    //     resetButton.className = 'filter-btn mt-3 w-100';
    //     resetButton.addEventListener('click', function() {
    //         activeFilters = {
    //             recipient: null,
    //             occasion: null,
    //             price: {
    //                 min: null,
    //                 max: null
    //             }
    //         };
    //
    //         // Reset all active classes
    //         filterButtons.forEach(btn => btn.classList.remove('active'));
    //
    //         // Reset price inputs
    //         document.getElementById('min-price').value = '';
    //         document.getElementById('max-price').value = '';
    //
    //         // Show all boxes
    //         boxes.forEach(box => box.style.display = '');
    //     });
    //
    //     // Add reset button to filters container
    //     document.querySelector('.filters').appendChild(resetButton);
    // });

    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const boxes = document.querySelectorAll('.premade-box');
        const searchBox = document.getElementById('search-box');
        const sortSelect = document.getElementById('sort-boxes');

        let activeFilters = {
            recipient: null,
            occasion: null,
            price: {
                min: null,
                max: null
            }
        };

        // Arama fonksiyonu
        searchBox.addEventListener('input', function() {
            applyFilters();
        });

        // Sıralama fonksiyonu
        sortSelect.addEventListener('change', function() {
            const boxesArray = Array.from(boxes);
            const sortValue = this.value;

            boxesArray.sort((a, b) => {
                switch(sortValue) {
                    case 'price_asc':
                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    case 'price_desc':
                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    case 'name_asc':
                        return a.querySelector('.gift-box-name').textContent.trim()
                            .localeCompare(b.querySelector('.gift-box-name').textContent.trim());
                    case 'name_desc':
                        return b.querySelector('.gift-box-name').textContent.trim()
                            .localeCompare(a.querySelector('.gift-box-name').textContent.trim());
                    default:
                        return 0;
                }
            });

            const container = boxes[0].parentElement;
            boxesArray.forEach(box => container.appendChild(box));
        });

        // Filter butonları için event listener
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterType = this.dataset.filter;
                const filterValue = this.dataset.value;

                // Toggle active class
                if (filterType !== 'price') {
                    if (activeFilters[filterType] === filterValue) {
                        // Aynı butona tekrar tıklandıysa filtreyi kaldır
                        activeFilters[filterType] = null;
                        this.classList.remove('active');
                    } else {
                        // Diğer butonlardan active class'ı kaldır
                        document.querySelectorAll(`.filter-btn[data-filter="${filterType}"]`)
                            .forEach(btn => btn.classList.remove('active'));

                        // Yeni filtre değerini ata ve butonu aktif yap
                        activeFilters[filterType] = filterValue;
                        this.classList.add('active');
                    }
                } else {
                    // Fiyat filtresi için
                    const minPrice = parseFloat(document.getElementById('min-price').value) || null;
                    const maxPrice = parseFloat(document.getElementById('max-price').value) || null;

                    activeFilters.price = {
                        min: minPrice,
                        max: maxPrice
                    };
                }

                applyFilters();
            });
        });

        function applyFilters() {
            const searchTerm = searchBox.value.toLowerCase();

            boxes.forEach(box => {
                let shouldShow = true;

                // Arama filtresi
                const boxName = box.querySelector('.gift-box-name').textContent.toLowerCase();
                const boxTitle = box.querySelector('.gift-box-title').textContent.toLowerCase();
                if (searchTerm && !boxName.includes(searchTerm) && !boxTitle.includes(searchTerm)) {
                    shouldShow = false;
                }

                // Recipient filter
                if (shouldShow && activeFilters.recipient !== null) {
                    shouldShow = box.dataset.recipient === activeFilters.recipient;
                }

                // Occasion filter
                if (shouldShow && activeFilters.occasion !== null) {
                    shouldShow = box.dataset.occasion === activeFilters.occasion;
                }

                // Price filter
                if (shouldShow && (activeFilters.price.min !== null || activeFilters.price.max !== null)) {
                    const price = parseFloat(box.dataset.price);
                    if (activeFilters.price.min !== null && price < activeFilters.price.min) {
                        shouldShow = false;
                    }
                    if (activeFilters.price.max !== null && price > activeFilters.price.max) {
                        shouldShow = false;
                    }
                }

                // Update visibility
                box.style.display = shouldShow ? '' : 'none';
            });
        }

        // Reset filters button
        const resetButton = document.createElement('button');
        resetButton.textContent = 'Filtrleri Sıfırla';
        resetButton.className = 'filter-btn mt-3 w-100';
        resetButton.addEventListener('click', function() {
            activeFilters = {
                recipient: null,
                occasion: null,
                price: {
                    min: null,
                    max: null
                }
            };

            // Reset all active classes
            filterButtons.forEach(btn => btn.classList.remove('active'));

            // Reset price inputs
            document.getElementById('min-price').value = '';
            document.getElementById('max-price').value = '';

            // Reset search box
            searchBox.value = '';

            // Reset sort select
            sortSelect.value = 'default';

            // Show all boxes
            boxes.forEach(box => box.style.display = '');
        });

        // Add reset button to filters container
        document.querySelector('.filters').appendChild(resetButton);
    });

    // Slider ve diğer fonksiyonlar
    document.querySelectorAll('.slider-container').forEach(container => {
        const slider = container.querySelector('.slider');
        const items = container.querySelectorAll('.slider-item');
        const prevButton = container.querySelector('.slider-prev');
        const nextButton = container.querySelector('.slider-next');

        let currentIndex = 0;

        const updateSlider = () => {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        };

        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
            updateSlider();
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
            updateSlider();
        });
    });

    function toggleParagraph(link) {
        const container = link.closest('.font-avenir-light');
        const shortParagraph = container.querySelector('.short-paragraph');
        const fullParagraph = container.querySelector('.full-paragraph');

        if (shortParagraph && fullParagraph) {
            if (fullParagraph.classList.contains('d-none')) {
                shortParagraph.classList.add('d-none');
                fullParagraph.classList.remove('d-none');
                link.textContent = "Show Less";
            } else {
                shortParagraph.classList.remove('d-none');
                fullParagraph.classList.add('d-none');
                link.textContent = "Show More";
            }
        }
    }

    function toggleAccordion(id) {
        const content = document.getElementById(id);
        const allContents = document.querySelectorAll('.collapse-content');

        allContents.forEach(item => {
            if (item.id !== id && item.style.height !== '0px') {
                item.style.height = '0px';
            }
        });

        if (content.style.height === '0px' || content.style.height === '') {
            content.style.height = content.scrollHeight + 'px';
        } else {
            content.style.height = '0px';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const contents = document.querySelectorAll('.collapse-content');
        contents.forEach(content => {
            content.style.height = '0px';
        });
    });
</script>
