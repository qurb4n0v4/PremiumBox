@extends('front.layouts.app')
@section('title', __('Hazır Hədiyyə Qutusu Seçin | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-premade.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-items.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/customize-premade.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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

    <div class="container my-5 p-5 choose-boxes-page" style="background-color: #ffffff; max-width: 1150px!important; border-radius: 20px">
        <div class="choose-boxes-header text-center" style="line-height: 0.5">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutunuzu fərdiləşdirin</h3>
            <p style="font-size: 14px; color: #898989; text-align: center !important;">Qutunu, Kartı seçin və Məhsulları Fərdiləşdirin.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600; text-align: center !important;">Sifarişi tamamlamaq üçün seçdiyiniz qutunun içərisindəkilərə nəzər yetirin!</p>
        </div>

        <div class="container mt-5" style="min-width: 1050px">
            <div id="accordion">
                <div class="mt-5 w-100" style="border-radius: 20px; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
                    <!-- Heading və Collapse bölməsi -->
                    <div class="border-theme-secondary pb-3" style="border-bottom-left-radius: 0rem; border-bottom-right-radius: 0rem; border-bottom-width: 0px !important;">
                        <h2 class="mb-0 d-flex flex-row pt-2">
                            <button type="button" class="d-flex flex-row mb-0 btn btn-header-link w-100 text-theme h2 text-left collapse-button pb-0 pt-3 pl-3 pr-3"
                                    data-toggle="collapse" data-target="#collapse-67dbcf95-11ee-4ff5-b8cb-856d23df54f3" aria-expanded="false"
                                    aria-controls="collapse-67dbcf95-11ee-4ff5-b8cb-856d23df54f3"
                                    style="background: none; border: none; outline: none; color: inherit; box-shadow: none;">
                                <div class="flex-grow-1 d-flex flex-md-row flex-column align-items-md-center">
                                    <span class="font-butler text-capitalize mb-0 h4" style="color: #a3907a;">{{ $premadeBoxDetail->name }}</span>
                                    <br class="w-100 d-block d-md-none mb-0">
                                    <span class="mb-0 font-avenir-light recipient-name-text-0 h5"></span>
                                </div>
                            </button>
                            <div class="d-flex justify-content-end mr-4 pt-3 pe-2">
                                <div style="cursor: pointer;">
                                    <a href="{{ route('choose_premade_box') }}" style="color: red" onclick="return confirm('Əvvəlki səhifəyə qayıdacaq. Əminsiniz?')"><i class="far fa-trash-alt h5 mb-0 text-theme-secondary"></i></a>
                                </div>
                            </div>
                        </h2>
                    </div>

                    <!-- Collapse bölməsi -->
                    <div id="collapse-67dbcf95-11ee-4ff5-b8cb-856d23df54f3" class="collapse show w-100" aria-labelledby="heading-67dbcf95-11ee-4ff5-b8cb-856d23df54f3" data-parent="#accordion">
                        <div class="row">
                            <!-- Sol tərəf -->
                            <div class="col-md-6">
                                <p data-v-11909900="" class="font-avenir-black text-theme-secondary mt-4 ps-3 text-left" style="color: #898989; font-size: 14px; font-weight: 600">Qutu Seçin!</p>
                                <div class="boxes-slider-container">
                                    <div class="d-flex flex-column px-3 position-relative">
                                        <div id="boxes-slider-container">
                                            <div class="row boxes-slider-wrapper ps-1">
                                                @if(count($giftBoxes) > 0)
                                                    @foreach ($giftBoxes as $index => $giftBox)
                                                        <div class="col-md-3 box-item" style="{{ $index >= 4 ? 'display: none;' : '' }}">
                                                            <div class="card mb-4 text-center gift-box-card" style="border: none; box-shadow: none; cursor: pointer;">
                                                                <img src="{{ $giftBox['image'] }}"
                                                                     class="card-img-top mx-auto gift-box-img"
                                                                     alt="{{ $giftBox['title'] }}"
                                                                     data-box-id="{{ $index }}"
                                                                     style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;">
                                                                <div class="card-body p-0">
                                                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-center" style="color: #898989; font-size: 14px; font-weight: 600">{{ $giftBox['title'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No Gift Boxes found.</p>
                                                @endif
                                            </div>

                                            @if(count($giftBoxes) > 4)
                                                <button class="boxes-nav-button boxes-prev position-absolute d-flex justify-content-center align-items-center"
                                                        style="left: 3px; top: 45%; transform: translateY(-50%); width: 15px; height: 15px; cursor: pointer; display: none;">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                                <button class="boxes-nav-button boxes-next position-absolute d-flex justify-content-center align-items-center"
                                                        style="right: -2px; top: 45%; transform: translateY(-50%); width: 15px; height: 15px; cursor: pointer;">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Customize it! -->
                                <div class="ps-3">
                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left" style="color: #898989; font-size: 14px;">Qutu üzərinə yazı yazın</p>
                                    <textarea class="customizing-text-input-fonts"></textarea>
                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left" style="color: #898989; font-size: 14px; font-weight: 600">Font Seçin</p>
                                    <div class="button-group-customizing-fonts" data-box-index="">
                                        <button class="font-button-customizing-edit" data-font="Playwrite AU SA" style="font-family: Playwrite AU SA">Font A</button>
                                        <button class="font-button-customizing-edit" data-font="Josefin Sans" style="font-family: Josefin Sans;">Font B</button>
                                        <button class="font-button-customizing-edit" data-font="Indie Flower" style="font-family: Indie Flower;">Font C</button>
                                    </div>
                                </div>

                                <!-- Choose Card! -->
                                <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left ps-3 pt-3" style="color: #898989; font-size: 14px; font-weight: 600">Kart Seçin!</p>
                                <div class="slider-container">
                                    <div class="d-flex row px-3">
                                        <div id="slider-container">
                                            <div class="row">
                                                @foreach($cards as $card)
                                                    <div class="col-6 px-2 col-md-6 card-item m-auto" data-id="{{ $card->id }}" style="width: 220px; height: 90px; margin-bottom: 75px!important;">
                                                        <img
                                                            alt="{{ $card->name }}"
                                                            src="{{ asset('storage/' . $card->image) }}"
                                                            class="rounded img-fluid w-100 select-card d-block h-100 object-fit-cover"
                                                            style="min-height: 150px; height: auto; object-fit: contain; cursor: pointer;"
                                                            data-name="{{ $card->name }}"
                                                            data-price="{{ '₼ ' . $card->price ?? '' }}"
                                                        >
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Prev və Next düymələri -->
                                            @if(count($cards) > 4)
                                                <button class="nav-button prev position-absolute d-flex justify-content-center align-items-center">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                                <button class="nav-button next position-absolute d-flex justify-content-center align-items-center">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            @endif
                                        </div>

                                        <!-- Seçilən kartın göstərilməsi -->
                                        <div id="selected-card-container" style="display: none; margin-top: 20px">
                                            <div class="text-center">
                                                <img
                                                    id="selected-card-image"
                                                    src=""
                                                    alt=""
                                                    class="rounded img-fluid w-100 mb-3 fixed-size-image">
                                                <h4 id="selected-card-name" style="text-align: center !important;"></h4>
                                                <p id="selected-card-price" style="font-size: 18px; text-align: center !important;"></p>
                                                <span id="reset-slider" style="cursor: pointer; font-size:14px; text-decoration: underline;">(Kartı Dəyişdir)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form -->
                                <div class="ps-3 pb-3 w-100 d-flex flex-column">
                                    <!-- "To" Field -->
                                    <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                        <label for="to-field" class="px-0 pt-2 mr-2 text-theme-secondary">To</label>
                                        <input
                                            type="text"
                                            id="to-field"
                                            maxlength="70"
                                            class="col-md-10 rounded form-control recipient-name-0"
                                            placeholder="Enter recipient name">
                                    </div>

                                    <!-- "From" Field -->
                                    <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                        <label for="from-field" class="px-0 pt-2 mr-2 text-theme-secondary">From</label>
                                        <input
                                            type="text"
                                            id="from-field"
                                            maxlength="70"
                                            class="col-md-10 rounded form-control"
                                            placeholder="Enter your name">
                                    </div>

                                    <!-- "Message" Field -->
                                    <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                        <label for="message-field" class="px-0 pt-2 mr-2 text-theme-secondary">Message</label>
                                        <textarea
                                            id="message-field"
                                            maxlength="300"
                                            class="col-md-10 rounded form-control"
                                            placeholder="Write your message here"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Sağ tərəf: Məhsullar -->
                            <div class="col-md-6">
                                <p data-v-11909900="" class="font-avenir-black text-theme-secondary mt-4 ps-4 text-left" style="color: #898989; font-size: 14px; font-weight: 600">Qutuya daxildir:</p>
                                <div class="container">
                                    <ul class="list-group gap-2">
                                        @foreach($insidings as $insiding)
                                            <li class="list-group-item rounded" style="border-radius: 20px; border: 1px solid #ccc;">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $insiding->image_path) }}"
                                                         alt="{{ $insiding->name }}"
                                                         class="mr-3 rounded"
                                                         style="width: 75px; height: 75px; object-fit: contain;">
                                                    <div class="flex-grow-1">
                                                        <h4 class="text-capitalize text-dark">{{ $insiding->name }}</h4>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center p-2"
                                                         style="border: 1px solid #ccc; border-radius: 15px; font-size: 14px;">
                                                        1
                                                    </div>
                                                </div>

                                                <!-- Məhsul mesajı və şəkil yükləmə bölməsi -->
                                                <div class="d-flex flex-row flex-wrap flex-md-nowrap justify-content-between gap-1">
                                                    <!-- Məhsul mesajı -->
                                                    @if($insiding->allow_text)
                                                        <div class="mt-2 order-1 order-md-1" style="flex-grow: 4;">
                                                            <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                                                <label class="px-0 pt-2 mr-2 text-theme-secondary" style="font-size: 0.9rem;">Message</label>
                                                                <textarea class="w-100 rounded form-control" style="height: 65px;"
                                                                          placeholder="{{ $insiding->text_field_placeholder ?? 'Message' }}"></textarea>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Foto yükləmə bölməsi -->
                                                    @if($insiding->allow_image_upload)
                                                        <div class="flex-column order-2 order-md-2" style="flex-grow: 4;">
                                                            <div class="d-flex flex-column justify-content-start align-items-start">
                                                                <p class="text-theme mt-2 mb-1" style="font-size: 0.9rem;">Upload Your Photos</p>
                                                                <div class="d-flex flex-row justify-content-center align-items-center">
                                                                    <label for="image-upload-input-{{ $insiding->id }}"
                                                                           class="d-flex justify-content-center align-items-center"
                                                                           style="width: 80px; height: 80px; border: 2px solid #ccc; border-radius: 20px; padding: 10px; cursor: pointer; position: relative;">
                                                                        <span id="image-preview-{{ $insiding->id }}" style="font-size: 24px; font-weight: bold;">+</span>
                                                                        <img id="image-preview-img-{{ $insiding->id }}" src="" alt="Uploaded Image" style="width: 100%; height: 100%; object-fit: contain; display: none; border-radius: 20px; position: absolute;">
                                                                    </label>
                                                                    <input id="image-upload-input-{{ $insiding->id }}" accept="image/*,.heic" type="file" class="d-none" onchange="previewImage(event, {{ $insiding->id }})">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Add variants section --}}
                                                @if($insiding->allow_variant_selection)
                                                @php
                                                    $variantData = is_string($insiding->variant_options)
                                                        ? json_decode($insiding->variant_options, true)
                                                        : $insiding->variant_options;
                                                @endphp

                                                @if(!empty($variantData) && is_array($variantData))
                                                    @if($insiding->variant_selection_title)
                                                        <h6 class="mt-3 variant-title">{{ $insiding->variant_selection_title }}</h6>
                                                    @endif

                                                    <div class="variants-buttons d-flex flex-wrap justify-content-center mt-2">
                                                        @foreach($variantData as $index => $variant)
                                                            <button
                                                                class="btn btn-outline-secondary m-1 variant-button {{ $index === 0 ? 'active' : '' }}"
                                                                data-price="{{ $variant['price'] ?? $insiding->price }}"
                                                                data-index="{{ $index }}"
                                                                onclick="changeVariantActive({{ $index }})">
                                                                {{ $variant['name'] ?? 'Unnamed Variant' }}
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src={{ asset('assets/front/js/customize-premade.js') }}></script>

