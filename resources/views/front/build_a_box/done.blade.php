@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-a-cart.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
        $hideFooter = true;
    @endphp

    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                @if ($stepNumber < 4 || session('currentStep') >= $stepNumber) {{-- Adım tamamlanmadığı sürece ilerleme yapılamaz --}}
                <a href="{{ route('choose.step', $stepNumber) }}"
                   style="text-decoration: none"
                   class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </a>
                @else
                    <span
                        class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}"
                        style="cursor: not-allowed;">
                    {{ $stepNumber }}
                </span>
                @endif
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Əşyaları əlavə edin', 'Təbrik kartını seçin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Sifarişinizi səbətinizə əlavə edin.</h3>
            <p style="font-size: 14px; color: #898989">Seçdiyiniz bütün məhsullar və məhsullar haqqında detaylı informasiya aşağıda qeyd olunmuşdur.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Sifarişinizi səbətinizə əlavə etmək üçün sadəcə olaraq "Səbət əlavə et" butonuna klik etməyiniz kifayətdir.</p>

            <div id="selectionsSummary" class="selected-items-summary">
                @if(Session::has('selected_box'))
                    @php $box = Session::get('selected_box'); @endphp
                    <div class="selected-box">
                        <h4>Seçilmiş Qutu</h4>
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                            <img src="{{ asset('storage/' . $box['box_image']) }}" alt="Box Image">
                            <div class="details">
                                <h5>{{ $box['box_name'] }}</h5>
                                <p>Fərdiləşdirmə: {{ $box['customization_text'] }}</p>
                                <p>Qiymət: ₼{{ $box['box_price'] }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(Session::has('selected_item'))
                    @php $items = Session::get('selected_item'); @endphp
                    <div class="selected-item">
                        <h4>Seçilmiş Əşyalar</h4>
                        @if(is_array($items) && count($items) > 0)
                            @foreach($items as $index => $item)
                                <div class="item-details">
                                    <button class="remove-btn" onclick="removeSelection('item', {{ $index }})">&times;</button>
                                    <img src="{{ asset('storage/' . $item['item_image']) }}" alt="Item Image" class="main-item-image">
                                    <div class="details">
                                        <h5>{{ $item['item_name'] }}</h5>

                                        {{-- Show selected variant if exists --}}
                                        @if(isset($item['selected_variant']) && $item['selected_variant'])
                                            <p class="variant-info">
                                                <span class="info-label">Variant:</span>
                                                {{ $item['selected_variant'] }}
                                            </p>
                                        @endif

                                        {{-- Show custom text if exists --}}
                                        @if(isset($item['user_text']) && $item['user_text'])
                                            <p class="text-info">
                                                <span class="info-label">Mətn:</span>
                                                {{ $item['user_text'] }}
                                            </p>
                                        @endif

                                        {{-- Show uploaded images if exist --}}
                                        @if(isset($item['uploaded_images']) && !empty($item['uploaded_images']))
                                            <div class="uploaded-images">
                                                <p class="info-label">Yüklənmiş şəkillər:</p>
                                                <div class="image-thumbnails">
                                                    @foreach($item['uploaded_images'] as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Uploaded image" class="thumbnail">
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <p class="price">Qiymət: ₼{{ number_format($item['item_price'], 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Heç bir əşya seçilməyib.</p>
                        @endif
                    </div>

                    <style>
                        .selected-item {
                            padding: 15px;
                            background: #fff;
                            border-radius: 8px;
                            margin-top: 20px;
                        }

                        .item-details {
                            position: relative;
                            display: flex;
                            align-items: start;
                            padding: 15px;
                            border: 1px solid #eee;
                            border-radius: 8px;
                            margin-bottom: 10px;
                        }

                        .main-item-image {
                            width: 100px;
                            height: 100px;
                            object-fit: cover;
                            border-radius: 6px;
                            margin-right: 15px;
                        }

                        .details {
                            flex-grow: 1;
                        }

                        .info-label {
                            font-weight: 600;
                            color: #666;
                            margin-right: 5px;
                        }

                        .uploaded-images {
                            margin-top: 10px;
                        }

                        .image-thumbnails {
                            display: flex;
                            gap: 10px;
                            margin-top: 5px;
                            flex-wrap: wrap;
                        }

                        .thumbnail {
                            width: 50px;
                            height: 50px;
                            object-fit: cover;
                            border-radius: 4px;
                            border: 1px solid #eee;
                        }

                        .remove-btn {
                            position: absolute;
                            top: 10px;
                            right: 10px;
                            background: none;
                            border: none;
                            font-size: 20px;
                            color: #666;
                            cursor: pointer;
                            padding: 0 5px;
                        }

                        .remove-btn:hover {
                            color: #dc3545;
                        }

                        .variant-info, .text-info, .price {
                            margin: 5px 0;
                            font-size: 14px;
                        }

                        h5 {
                            margin: 0 0 10px 0;
                            color: #333;
                        }
                    </style>
                @endif

                @if(Session::has('selected_card'))
                    @php $card = Session::get('selected_card'); @endphp
                    <div class="selected-card">
                        <h4>Seçilmiş Kart</h4>
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('card')">&times;</button>
                            <img src="{{ asset('storage/' . $card['card_image']) }}" alt="Card Image">
                            <div class="details">
                                <h5>{{ $card['card_name'] }}</h5>
                                <p>Kimə: {{ $card['recipient_name'] }}</p>
                                <p>Kimdən: {{ $card['sender_name'] }}</p>
                                <p>Mesaj: {{ $card['card_message'] }}</p>
                                <p>Qiymət: ₼{{ $card['card_price'] }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="total-price">
                    @php
                        $totalPrice = 0;
                        if(Session::has('selected_box')) {
                            $totalPrice += Session::get('selected_box')['box_price'];
                        }
                        if(Session::has('selected_item')) {
                            $items = Session::get('selected_item');
                            foreach($items as $item) {
                                $totalPrice += $item['item_price'];
                            }
                        }
                        if(Session::has('selected_card')) {
                            $totalPrice += Session::get('selected_card')['card_price'];
                        }
                    @endphp
                    <h4>Ümumi Məbləğ: ₼{{ number_format($totalPrice, 2) }}</h4>
                </div>
            </div>

            <style>
                .item-details {
                    position: relative;
                    padding: 10px;
                    margin: 10px 0;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }

                .remove-btn {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    background: #ff4444;
                    color: white;
                    border: none;
                    border-radius: 50%;
                    width: 24px;
                    height: 24px;
                    line-height: 24px;
                    text-align: center;
                    cursor: pointer;
                    font-size: 16px;
                    padding: 0;
                }

                .remove-btn:hover {
                    background: #cc0000;
                }

                .complete-order-button-on-basket{
                    font-size: 20px;
                    width: 26%;
                    padding: 15px !important;
                    border-radius: 10px;
                    background-color: var(--white);
                    color: var(--primary-color);
                    border: 1px solid var(--primary-color);
                    transition: background-color 0.3s, color 0.3s;
                    cursor: pointer;
                    margin-top: 30px;
                }

                .complete-order-button-on-basket:hover {
                    background-color: var(--primary-color);
                    color: var(--white);
                    opacity: 0.9;
                }
            </style>

            <script>
                function removeSelection(type, index = null) {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (!token) {
                        console.error('CSRF token not found');
                        return;
                    }

                    const buttonElement = event.target;
                    const itemElement = buttonElement.closest('.item-details');
                    if (itemElement) {
                        itemElement.style.opacity = '0.5';
                    }

                    const url = `${window.location.origin}/remove-selection`;

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            type: type,
                            index: index
                        })
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                if (type === 'box') {
                                    // Box silindikdə xəbərdarlıq göstər və choose_a_box səhifəsinə yönləndir
                                    alert('Qutu seçimi məcburidir! Zəhmət olmasa yeni qutu seçin.');
                                    window.location.href = '/choose_a_box';
                                } else {
                                    // Digər elementlər silindikdə sadəcə səhifəni yenilə
                                    window.location.reload();
                                }
                            } else {
                                console.error('Server error:', data.message);
                                if (itemElement) {
                                    itemElement.style.opacity = '1';
                                }
                                alert('Server xətası: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            if (itemElement) {
                                itemElement.style.opacity = '1';
                            }
                            alert('Xəta baş verdi. Yenidən cəhd edin.');
                        });
                }

                function updateSelectionsSummary() {
                    fetch('/get-selections')
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const selections = data.data;
                                let html = '';

                                // Box
                                if (selections.box) {
                                    html += `
                    <div class="selected-box">
                        <h4>Seçilmiş Qutu</h4>
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                            <img src="${selections.box.box_image}" alt="Box Image">
                            <div class="details">
                                <h5>${selections.box.box_name}</h5>
                                <p>Fərdiləşdirmə: ${selections.box.customization_text}</p>
                                <p>Qiymət: ₼${selections.box.box_price}</p>
                            </div>
                        </div>
                    </div>
                `;
                                }

                                // Items
                                if (selections.item && selections.item.length > 0) {
                                    html += '<div class="selected-item"><h4>Seçilmiş Əşyalar</h4>';
                                    selections.item.forEach((item, index) => {
                                        html += `
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('item', ${index})">&times;</button>
                            <img src="${item.item_image}" alt="Item Image">
                            <div class="details">
                                <h5>${item.item_name}</h5>
                                ${item.selected_variants ? `<p>Variantlar: ${item.selected_variants}</p>` : ''}
                                ${item.user_text ? `<p>Mətn: ${item.user_text}</p>` : ''}
                                <p>Qiymət: ₼${item.item_price}</p>
                            </div>
                        </div>
                    `;
                                    });
                                    html += '</div>';
                                }

                                // Card
                                if (selections.card) {
                                    html += `
                    <div class="selected-card">
                        <h4>Seçilmiş Kart</h4>
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('card')">&times;</button>
                            <img src="${selections.card.card_image}" alt="Card Image">
                            <div class="details">
                                <h5>${selections.card.card_name}</h5>
                                <p>Kimə: ${selections.card.recipient_name}</p>
                                <p>Kimdən: ${selections.card.sender_name}</p>
                                <p>Qiymət: ₼${selections.card.card_price}</p>
                            </div>
                        </div>
                    </div>
                `;
                                }

                                // Total Price
                                html += `
                <div class="total-price">
                    <h4>Ümumi Məbləğ: ₼${selections.total_price.toFixed(2)}</h4>
                </div>
            `;

                                document.getElementById('selectionsSummary').innerHTML = html;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }

                document.addEventListener('DOMContentLoaded', updateSelectionsSummary);
            </script>

            <button id="save-button"  class="complete-order-button-on-basket">Səbətə əlavə et</button>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        {{--$('#save-button').on('click', function () {--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ route('save.to.database') }}",--}}
        {{--        method: "POST",--}}
        {{--        data: {--}}
        {{--            _token: "{{ csrf_token() }}",--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            if (response.success) {--}}
        {{--                alert(response.message);--}}
        {{--            } else {--}}
        {{--                alert("Xəta baş verdi: " + response.message);--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (xhr) {--}}
        {{--            alert("Serverdə xəta baş verdi: " + xhr.responseJSON.message);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}


        $('#save-button').on('click', function () {
            // Check if user is logged in
            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

            if (!isLoggedIn) {
                Swal.fire({
                    title: 'Giriş tələb olunur',
                    text: 'Davam etmək üçün hesabınıza daxil olmalısınız',
                    icon: 'warning',
                    confirmButtonText: 'Daxil ol'
                }).then(() => {
                    window.location.href = '/';
                });
                return;
            }

            // Show loading alert
            Swal.fire({
                title: 'Əməliyyat yerinə yetirilir...',
                text: 'Zəhmət olmasa gözləyin',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('save.to.database') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu əməliyyat',
                            text: response.message || 'Məlumatlar uğurla yadda saxlanıldı'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Əməliyyat uğursuz oldu',
                            text: response.message || 'Sistemdə xəta baş verdi'
                        });
                    }
                },
                error: function (xhr) {
                    let errorMessage = 'Serverdə naməlum xəta baş verdi';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status) {
                        switch (xhr.status) {
                            case 401:
                                errorMessage = 'İstifadəçi səlahiyyəti yoxdur';
                                break;
                            case 403:
                                errorMessage = 'Bu əməliyyatı yerinə yetirmək üçün icazəniz yoxdur';
                                break;
                            case 404:
                                errorMessage = 'Sorğu edilən resurs tapılmadı';
                                break;
                            case 500:
                                errorMessage = 'Daxili server xətası baş verdi';
                                break;
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta',
                        text: errorMessage
                    });
                }
            });
        });
    </script>

    <style>
        /* Title Section Responsive Fixes */
        .choose-boxes-header {
            text-align: center;
            padding: 2rem 1rem;
            line-height: 1.6;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .choose-boxes-header h3 {
            color: #a3907a;
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            margin-bottom: 1rem;
            font-weight: 700;
            line-height: 1.4;
            padding: 0 15px;
        }

        .choose-boxes-header p {
            color: #898989;
            font-size: clamp(0.8rem, 1.8vw, 0.95rem);
            margin-bottom: 0.8rem;
            padding: 0 15px;
            line-height: 1.5;
        }

        /* Text Alignment and Spacing Fixes */
        .details {
            flex: 1;
            min-width: 250px;
            padding: 0 15px;
            text-align: left;
        }

        /* User Uploaded Images Size Fix - Square Shape */
        .uploaded-images {
            margin-top: 1rem;
            width: 100%;
        }

        .image-thumbnails {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
            justify-content: flex-start;
        }

        .thumbnail {
            width: 60px;  /* Fixed width for square shape */
            height: 60px; /* Same as width for square shape */
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
        }

        /* Main Item Image Size Adjustments - Square Shape */
        .item-details img,
        .main-item-image,
        .selected-box img{
            width: 120px;  /* Fixed width for square shape */
            height: 120px; /* Same as width for square shape */
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        /* Add to Cart Button Responsive Styles */
        .complete-order-button-on-basket {
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            width: clamp(200px, 40%, 300px);
            padding: clamp(0.8rem, 1.5vw, 1rem) !important;
            border-radius: 10px;
            background-color: var(--white);
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            margin: 30px auto 0;
            display: block;
        }

        .complete-order-button-on-basket:hover {
            background-color: var(--primary-color);
            color: var(--white);
            opacity: 0.9;
        }

        /* Responsive Breakpoints Refinements */
        @media screen and (max-width: 768px) {
            .choose-boxes-header {
                padding: 1.5rem 0.8rem;
            }

            .choose-boxes-header h3 {
                font-size: 1.3rem;
                line-height: 1.3;
                margin-bottom: 0.8rem;
            }

            .choose-boxes-header p {
                font-size: 0.85rem;
                line-height: 1.4;
                padding: 0 10px;
            }

            .item-details {
                flex-direction: row;
                align-items: flex-start;
                padding: 1rem;
            }

            .details {
                padding: 0 10px;
            }

            .thumbnail {
                width: 50px;  /* Slightly smaller on tablets */
                height: 50px;
            }

            .complete-order-button-on-basket {
                width: clamp(200px, 60%, 300px);
            }
        }

        /* Previous styles remain the same until @media queries */

        @media screen and (max-width: 576px) {
            .choose-boxes-header {
                padding: 1rem 0.5rem;
            }

            .item-details {
                flex-direction: column;
            }

            .item-details img,
            .main-item-image,
            .selected-card img{
                width: 100%;
                height: 200px;
                margin-bottom: 1rem;
            }

            .details {
                width: 100%;
                padding: 0 8px;
            }

            .thumbnail {
                width: 40px;
                height: 40px;
            }

            .image-thumbnails {
                gap: 0.5rem;
                justify-content: flex-start;
            }

            .complete-order-button-on-basket {
                width: 90%;
                font-size: 0.9rem;
                padding: 0.8rem !important;
            }
        }

        /* New styles for extra small devices */
        @media screen and (max-width: 390px) {
            .item-details {
                padding: 0.8rem;
            }

            .item-details img,
            .main-item-image,
            .selected-card img{
                width: 100%;
                height: 160px;
            }

            .details {
                padding: 0 5px;
            }

            /* Adjust uploaded images container */
            .uploaded-images {
                width: 86%;
                margin-top: 0.8rem;
            }

            .image-thumbnails {
                gap: 4px;
                justify-content: flex-start;
                padding: 0;
            }

            .thumbnail {
                width: 35px;  /* Smaller fixed size */
                height: 35px;
                flex-shrink: 0;
            }

            /* Improve text spacing */
            .details h5 {
                font-size: 0.95rem;
                margin-bottom: 0.5rem;
            }

            .details p {
                font-size: 0.8rem;
                margin-bottom: 0.4rem;
            }

            /* Adjust container padding */
            .container.my-5.p-5.choose-boxes-page {
                padding: 0.8rem !important;
                width: 95% !important;
            }

            /* Header adjustments */
            .choose-boxes-header h3 {
                font-size: 1.1rem;
                padding: 0 8px;
            }

            .choose-boxes-header p {
                font-size: 0.8rem;
                padding: 0 8px;
            }
        }

        /* Container Width Control */
        .container.my-5.p-5.choose-boxes-page {
            padding: clamp(1rem, 3vw, 3rem) !important;
            margin: 0 auto;
            width: 90% !important;
            max-width: 1000px !important;
        }
    </style>
@endsection
