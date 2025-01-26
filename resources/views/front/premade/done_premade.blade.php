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
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Sifarişinizi səbətinizə əlavə edildi!</h3>
            <p style="font-size: 14px; color: #898989">Seçdiyiniz bütün məhsullar və məhsullar haqqında detaylı informasiya səbətinizdə qeyd olunmuşdur.</p>
        </div>

        <hr class="mt-5 mb-5">
        <div style="background-color: #f0f9e8; color: #2e7d32; padding: 15px; border-radius: 10px; font-size: 16px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            Sifarişiniz səbətinizə əlavə edildi! Sifarişinizi təsdiqləmək üçün səbətinizə baxa bilərsiniz.
        </div>
    </div>
@endsection
