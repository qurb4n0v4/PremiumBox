@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-items.css') }}">
@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                <a href="{{ route('choose.step', $stepNumber) }}" style="text-decoration: none" class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </a>
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Əşyaları əlavə edin', 'Təbrik kartını seçin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Məhsulları seçin</h3>
            <p style="font-size: 14px; color: #898989">Sizin üçün ən yaxşı məhsulları seçdik.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Aşağıdakı məhsulları seçin, qutunu doldurun və özəlləşdirin!</p>
        </div>

        <hr style="color: #898989">

        <div class="gy-4 mt-4" style="margin-top: 30px!important;">

            <div>
                <div class="row">
                    <!-- Sol Sidebar (Filtrləmə) -->
                    <div class="col-12 col-md-3">
                        <div class="filters">
                            <h5>Məhsulları Filtrləyin</h5>
                            <!-- Alıcı Filtresi -->
                            <div class="filter-section">
                                <label for="recipient">Alıcı</label>
                                <select id="recipient" class="form-control">
                                    <option value="all">Hamısı</option>
                                    <option value="male">Kişi</option>
                                    <option value="female">Qadın</option>
                                    <option value="children">Uşaq</option>
                                </select>
                            </div>
                            <!-- Xüsusi Günlər -->
                            <div class="filter-section">
                                <label for="occasions">Xüsusi Günlər</label>
                                <select id="occasions" class="form-control">
                                    <option value="all">Hamısı</option>
                                    <option value="birthday">Ad günü</option>
                                    <option value="wedding">Toy</option>
                                    <option value="anniversary">İl dönümü</option>
                                </select>
                            </div>
                            <!-- Qiymət Aralığı -->
                            <div class="filter-section">
                                <label for="price-range">Qiymət Aralığı</label>
                                <input type="range" id="price-range" class="form-control" min="0" max="1000" step="10">
                                <span id="price-range-label">₼ 0 - ₼ 1000</span>
                            </div>
                            <!-- İstehsal Müddəti -->
                            <div class="filter-section">
                                <label for="production-time">İstehsal Müddəti</label>
                                <select id="production-time" class="form-control">
                                    <option value="all">Hamısı</option>
                                    <option value="1">1 gün</option>
                                    <option value="3">3 gün</option>
                                    <option value="7">7 gün</option>
                                </select>
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
                            @foreach ($chooseItems as $item)
                                <div class="col-md-4 mb-4">
                                    <div class="card text-center border-0">
                                        <div class="image-wrapper" style="position: relative;">
                                            <img
                                                src="{{ asset('storage/' . $item->normal_image) }}"
                                                alt="{{ $item->name }}"
                                                class="img-fluid normal-image"
                                            >
                                            @if($item->hover_image)
                                                <img
                                                    src="{{ asset('storage/' . $item->hover_image) }}"
                                                    alt="{{ $item->name }}"
                                                    class="img-fluid hover-image"
                                                >
                                            @endif
                                        </div>

                                        <h5 class="mt-3">{{ $item->company_name }}</h5>

                                        <p style="margin-top: -5px">{{ $item->name }}</p>

                                        <p class="text-muted" style="margin-top: -13px; color: #343a40!important;">₼{{ number_format($item->price, 2) }}</p>

                                        <!-- Button -->
                                        <button class="choose-items-button">
                                            {{ $item->button }}
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

<script>
    document.querySelectorAll('.choose-box-circle').forEach(circle => {
        circle.addEventListener('click', function (e) {
            const step = this.textContent.trim();
            window.location.href = `/choose-step/${step}`;
        });
    });

</script>

