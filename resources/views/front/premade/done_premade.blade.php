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

{{--        @foreach ($premadeBoxes as $box)--}}
            @foreach (range(1, 3) as $stepNumber)
                <div
                    class="choose-box-step"
                    onclick="window.location.href='{{ route($routes[$stepNumber]) }}'"
                    style="cursor: pointer;"
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
{{--        @endforeach--}}
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutu Seçin</h3>
            <p style="font-size: 14px; color: #898989">Hazır paketlərimizdən alış-veriş edin: Sizin üçün sürətli, əngəlsiz, göndərilməyə hazır hədiyyə qutuları.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Sifarişə davam etmək üçün aşağıdakı qutulardan seçiminizi edin!</p>
        </div>

        <hr class="mt-5 mb-5">

        Done!
    </div>
@endsection
