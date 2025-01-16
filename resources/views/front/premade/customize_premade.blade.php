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
                    onclick="window.location.href='{{ route($routes[$stepNumber]) }}'"
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

    @if (!$premadeBoxDetail)
        <div class="container my-5 p-5 text-center" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
            <h3 style="color: #a3907a; margin-bottom: 15px">Heç bir qutu seçilməyib.</h3>
            <p style="color: #898989; text-align: center !important;">Zəhmət olmasa əvvəlcə bir qutu seçin.</p>
        </div>
    @else
        <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc;">
            <div class="choose-boxes-header text-center" style="line-height: 0.5">
                <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutunuzu fərdiləşdirin</h3>
                <p style="font-size: 14px; color: #898989; text-align: center !important;">Qutunu, Kartı seçin və Məhsulları Fərdiləşdirin.</p>
                <p style="color: #a3907a; font-size: 14px; font-weight: 600; text-align: center !important;">Sifarişi tamamlamaq üçün seçdiyiniz qutunun içərisindəkilərə nəzər yetirin!</p>
            </div>

            <div class="container mt-5" style="min-width: 1050px;">
                <div id="accordion">
                    <div class="cont mt-5 mx-auto w-100" style="border-radius: 20px; border: 1px solid #ccc;">
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
                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary mt-4 ps-3 text-left" style="color: #898989; font-size: 14px; font-weight: 600">Qutu Seçin! <span class="text-danger">*</span></p>
                                    <div class="boxes-slider-container">
                                        @if(count($giftBoxes) > 4)
                                            <button class="boxes-nav-button boxes-prev position-absolute d-flex justify-content-center align-items-center"
                                                    style="left: 3px; top: 45%; transform: translateY(-50%); width: 15px; height: 15px; cursor: pointer; display: none;">
                                                <i class="fas fa-chevron-left"></i>
                                            </button>
                                        @endif

                                        <div class="d-flex flex-column position-relative">
                                            <div id="boxes-slider-container">
                                                <div class="row boxes-slider-wrapper px-1">
                                                    @if(count($giftBoxes) > 0)
                                                        @foreach ($giftBoxes as $index => $giftBox)
                                                            <div class="col-md-3 box-item" style="{{ $index >= 4 ? 'display: none;' : '' }}">
                                                                <div class="card text-center gift-box-card" style="border: none; box-shadow: none; cursor: pointer;">
                                                                    <img src="{{ asset('storage/' . $giftBox['image']) }}"
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
                                            </div>
                                        </div>

                                        @if(count($giftBoxes) > 4)
                                            <button class="boxes-nav-button boxes-next position-absolute d-flex justify-content-center align-items-center"
                                                    style="right: 0; top: 45%; transform: translateY(-50%); width: 15px; height: 15px; cursor: pointer;">
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Customize it! -->
                                    <div class="px-3 pt-4">
                                        <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left" style="color: #898989; font-size: 14px;">Qutu üzərinə yazı yazın <span class="text-danger">*</span></p>
                                        <textarea class="customizing-text-input-fonts" required></textarea>
                                        <span class="text-danger error-message" style="display: none;">Bu sahə tələb olunur</span>

                                        <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left" style="color: #898989; font-size: 14px; font-weight: 600">Font Seçin <span class="text-danger">*</span></p>
                                        <div class="button-group-customizing-fonts" data-box-index="">
                                            <button class="font-button-customizing-edit" data-font="Playwrite AU SA" style="font-family: Playwrite AU SA">Font A</button>
                                            <button class="font-button-customizing-edit" data-font="Josefin Sans" style="font-family: Josefin Sans;">Font B</button>
                                            <button class="font-button-customizing-edit" data-font="Indie Flower" style="font-family: Indie Flower;">Font C</button>
                                        </div>
                                        <span class="text-danger error-message" style="display: none;">Font seçilməlidir</span>
                                    </div>

                                    <!-- Choose Card! -->
                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left ps-3 pt-3" style="color: #898989; font-size: 14px; font-weight: 600">Kart Seçin! <span class="text-danger">*</span></p>
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
{{--                                                    <span id="reset-slider" style="cursor: pointer; font-size:14px; text-decoration: underline;">(Kartı Dəyişdir)</span>--}}
                                                    <button class="choose-box-choose-button" style="max-width: 250px" id="reset-slider">
                                                        Kartı dəyişdir
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger error-message ps-3" style="display: none;">Kart seçilməlidir</span>

                                    <!-- Form -->
                                    <div class="px-3 pb-3 w-100 d-flex flex-column">
                                        <!-- "To" Field -->
                                        <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                            <label for="to-field" class="px-0 pt-2 mr-2 text-theme-secondary">Kimə <span class="text-danger">*</span></label>
                                            <input type="text" id="to-field" maxlength="70" class="col-md-10 rounded form-control recipient-name-0" placeholder="Alıcı adını daxil edin" required>
                                            <span class="text-danger error-message" style="display: none;">Alıcı adı daxil edilməlidir</span>
                                        </div>

                                        <!-- "From" Field -->
                                        <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                            <label for="from-field" class="px-0 pt-2 mr-2 text-theme-secondary">Kimdən <span class="text-danger">*</span></label>
                                            <input type="text" id="from-field" maxlength="70" class="col-md-10 rounded form-control" placeholder="Adınızı daxil edin" required>
                                            <span class="text-danger error-message" style="display: none;">Göndərən adı daxil edilməlidir</span>
                                        </div>

                                        <!-- "Message" Field -->
                                        <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                            <label for="message-field" class="px-0 pt-2 mr-2 text-theme-secondary">Mesaj <span class="text-danger">*</span></label>
                                            <textarea id="message-field" maxlength="300" class="col-md-10 rounded form-control" placeholder="Mesajınızı buraya daxil edin" required></textarea>
                                            <span class="text-danger error-message" style="display: none;">Mesaj daxil edilməlidir</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger error-message ps-3" style="display: none;">Qutu seçilməlidir</span>

                                <!-- Sağ tərəf: Məhsullar -->
                                <div class="col-md-6">
                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary mt-4 ps-4 text-left" style="color: #898989; font-size: 14px; font-weight: 600">Qutuya daxildir:</p>
                                    <div class="container">
                                        <ul class="list-group gap-2">
                                            @foreach($insidings as $insiding)
                                                <li class="list-group-item rounded" style="border-radius: 20px; border: 1px solid #ccc;">
                                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                                        <div class="d-flex flex-row align-items-center gap-3">
                                                            <img src="{{ asset('storage/' . $insiding->image) }}" alt="{{ $insiding->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 20px;">
                                                            <div>
                                                                <h6 class="mb-0">{{ $insiding->name }}</h6>
                                                                <p class="mb-0" style="font-size: 14px; color: #898989;">{{ $insiding->description }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center p-2"
                                                             style="border: 1px solid #ccc; border-radius: 15px; font-size: 14px;">
                                                            {{ $insiding->quantity }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row flex-wrap flex-md-nowrap justify-content-between gap-1">
                                                        <!-- Məhsul mesajı -->
                                                        @if($insiding->allow_text)
                                                            <div class="mt-2 order-1 order-md-1" style="flex-grow: 4;">
                                                                <div class="form-group d-flex flex-column flex-wrap flex-md-nowrap">
                                                                    <label class="px-0 pt-2 mr-2 text-theme-secondary" style="font-size: 0.9rem;">
                                                                        Mesajınız <span class="text-danger">*</span>
                                                                    </label>
                                                                    <textarea
                                                                        class="w-100 rounded form-control dynamic-textarea"
                                                                        style="height: 65px;"
                                                                        data-insiding-id="{{ $insiding->id }}"
                                                                        placeholder="{{ $insiding->text_field_placeholder ?? 'Message' }}"
                                                                        required
                                                                    ></textarea>
                                                                    <span class="text-danger error-message" style="display: none;">Mesaj daxil edilməlidir</span>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <!-- Foto yükləmə bölməsi -->
                                                        @if($insiding->allow_image_upload)
                                                            <div class="flex-column order-2 order-md-2" style="flex-grow: 4;">
                                                                <div class="d-flex flex-column justify-content-start align-items-start">
                                                                    <p class="text-theme mt-2 mb-1" style="font-size: 0.9rem;">
                                                                        Şəklinizi yükləyin <span class="text-danger">*</span>
                                                                    </p>
                                                                    <div class="d-flex flex-row justify-content-center align-items-center">
                                                                        <label for="image-upload-input-{{ $insiding->id }}"
                                                                               class="d-flex justify-content-center align-items-center image-upload-label"
                                                                               style="width: 80px; height: 80px; border: 2px solid #ccc; border-radius: 20px; padding: 10px; cursor: pointer; position: relative;">
                                                                            <span id="image-preview-{{ $insiding->id }}" style="font-size: 24px; font-weight: bold;">+</span>
                                                                            <img id="image-preview-img-{{ $insiding->id }}" src="" alt="Uploaded Image" style="width: 100%; height: 100%; object-fit: contain; display: none; border-radius: 20px; position: absolute;">
                                                                        </label>
                                                                        <input id="image-upload-input-{{ $insiding->id }}"
                                                                               accept="image/*,.heic"
                                                                               type="file"
                                                                               class="d-none dynamic-image-upload"
                                                                               data-insiding-id="{{ $insiding->id }}"
                                                                               required
                                                                               onchange="previewImage(event, {{ $insiding->id }})">
                                                                    </div>
                                                                    <span class="text-danger error-message" style="display: none;">Şəkil yüklənməlidir</span>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                                    {{-- Variants section --}}
                                                    @if($insiding->allow_variant_selection)
                                                        @php
                                                            $variantData = is_string($insiding->variant_options)
                                                                ? json_decode($insiding->variant_options, true)
                                                                : $insiding->variant_options;
                                                        @endphp

                                                        @if(!empty($variantData) && is_array($variantData))
                                                            @if($insiding->variant_selection_title)
                                                                <h6 class="mt-3 variant-title">
                                                                    {{ $insiding->variant_selection_title }} <span class="text-danger">*</span>
                                                                </h6>
                                                            @endif

                                                            <div class="variants-buttons d-flex flex-wrap justify-content-center mt-2"
                                                                 data-insiding-id="{{ $insiding->id }}">
                                                                @foreach($variantData as $index => $variant)
                                                                    <button
                                                                        class="btn btn-outline-secondary m-1 variant-button"
                                                                        data-price="{{ $variant['price'] ?? $insiding->price }}"
                                                                        data-index="{{ $index }}"
                                                                        onclick="changeVariantActive(this, {{ $insiding->id }})">
                                                                        {{ $variant['name'] ?? 'Unnamed Variant' }}
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                            <span class="text-danger error-message" style="display: none;">Variant seçilməlidir</span>
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
                <div class="w-100 mt-4 d-flex flex-row justify-content-end">
                    <button class="custom-btn"
                            type="button"
                            onclick="window.location.href='{{ route('done_premade') }}'"
                    >
                        <h5 class="mb-0 font-avenir-medium">Səbətə əlavə edin</h5>
                    </button>
                </div>
            </div>
        </div>
    @endif
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src={{ asset('assets/front/js/customize-premade.js') }}></script>

