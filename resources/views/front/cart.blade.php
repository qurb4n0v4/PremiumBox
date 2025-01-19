@extends('front.layouts.app')

@section('title', 'Səbət')
@extends('front.layouts.app')

@section('title', 'Səbət')
@section('content')
    <div class="container my-5 cart-container">
        <div class="row">
            <div class="col-md-8 d-flex flex-column justify-content-center">
                <h2 class="mb-4 cart-header-title" style="color: #a3907a;">Cart</h2>

                @auth
                    <div id="selectionsSummary" class="selected-items-summary">
                        @if(Session::has('selected_box'))
                            @php $box = Session::get('selected_box'); @endphp
                            <div class="selected-box">
                                <h4>Seçilmiş Qutu</h4>
                                <div class="item-details">
                                    <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                                    <img src="{{ $box['box_image'] }}" alt="Box Image">
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
                                    <img src="{{ asset('storage/' . $card['card_image']) }}" alt="Card Image" style="width: 50px; height: 60px">
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

                @endauth
            </div>
        </div>
    </div>
@endsection

<style>
    .cart-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
    }

    .cart-header-title {
        font-size: 1.75rem;
        font-weight: bold;
        color: #343a40;
    }

    .cart-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-card-body {
        padding: 20px;
    }

    .cart-item-header {
        font-size: 1rem;
    }

    .cart-item-title {
        font-weight: bold;
        color: #495057;
    }

    .cart-item-price {
        font-size: 1.25rem;
        font-weight: bold;
        color: #007bff;
    }

    .cart-item-details {
        margin-top: 15px;
    }

    .cart-item-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .cart-item-info {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .cart-item-actions {
        text-align: right;
    }

    .cart-delete-btn {
        background-color: #ffffff !important;
        color: #a3907a !important;
        border: 1px solid #a3907a !important;
        padding: 8px 12px;
        font-size: 0.85rem;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .cart-delete-btn:hover {
        background-color: #a3907a !important;
        color: #fff !important;
    }

    @media (max-width: 768px) {
        .cart-header-title {
            font-size: 1.5rem;
        }

        .cart-item-title {
            font-size: 1rem;
        }

        .cart-item-price {
            font-size: 1rem;
        }

        .cart-item-info {
            font-size: 0.85rem;
        }

        .cart-delete-btn {
            padding: 6px 10px;
            font-size: 0.75rem;
        }
    }
</style>
