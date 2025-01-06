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

        <hr>

        <div class="container">
            <div class="row">
                @foreach ($premadeBoxes as $box)
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card w-100 h-100 d-flex flex-column align-items-stretch" style="border-color: transparent; cursor: pointer;">
                            <div class="rounded">
                                <div class="text-center position-relative">
                                    <!-- Normal Image -->
                                    <img src="{{ asset('storage/' . $box->normal_image) }}" alt="{{ $box->name }}" class="card-img-top rounded-top rounded-bottom" style="object-fit: contain !important;">
                                </div>
                            </div>
                            <div class="card-block my-2" style="flex-grow: 1;">
                                <h5 class="text-center text-theme h4 mb-1 text-capitalize font-butler">{{ $box->name }}</h5>
                                <!-- Price -->
                                <p class="card-text text-center font-avenir-black">Rp {{ number_format($box->price, 2) }}</p>
                            </div>
                            <div class="text-center small my-2">
                                {{ $box->title }}
                            </div>
                            <div class="mt-1">
                                <!-- Add to Cart Button -->
                                <button class="w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection

