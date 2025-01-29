@extends('front.layouts.app')

@section('title', 'Səbət')

@section('content')
    <div class="container my-5 cart-container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mb-4 cart-header-title">Səbət</h2>

                @auth
                    @if($userCards->isEmpty() && $premadeBoxOrders->isEmpty())
                        <p class="cart-empty-text">Səbət boşdur.</p>
                    @else
                        @foreach($userCards as $userCard)
                            <div class="cart-card mb-4">
                                <div class="cart-card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            @if ($userCard->card && $userCard->card->image)
                                                <img src="{{ asset('storage/' . $userCard->card->image) }}"
                                                     alt="Qutu Şəkli" class="cart-item-image">
                                            @else
                                                <p>Şəkil mövcud deyil</p>
                                            @endif
                                        </div>
                                        <div class="col-9">
                                            <h5 class="cart-item-title">{{ $userCard->card->name ?? 'Kart adı mövcud deyil' }}</h5>
                                            <p class="cart-item-info">Kimdən: {{ $userCard->sender_name }}</p>
                                            <p class="cart-item-info">Kimə: {{ $userCard->recipient_name }}</p>
                                            <p class="cart-item-info">Mesaj: {{ $userCard->card_message }}</p>
                                            <p class="cart-item-info"><strong>Qiymət:</strong>
                                                ₼{{ number_format($userCard->total_price, 2) }}</p>
                                            <p class="cart-item-info"><strong>Məhsullar:</strong></p>
                                            <ul class="cart-item-contents">
                                                @foreach($userCard->userBuildABoxCardItems as $item)
                                                    <li>
                                                        {{ $item->chooseItem->name ?? 'Ad mövcud deyil' }} - Variant:
                                                        @php
                                                            $variants = json_decode($item->selected_variants, true);
                                                        @endphp
                                                        @if($variants && is_array($variants))
                                                            @foreach($variants as $key => $value)
                                                                {{ ucfirst($key) }}: {{ $value }}@if(!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            Variant məlumatı mövcud deyil.
                                                        @endif
                                                        - Mətn: {{ $item->user_text }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="cart-item-status">
                                                <strong style="color: #a3907a;">Status:</strong>
                                                <span
                                                        class="badge badge-{{ $userCard->status == 'pending' ? 'warning' : ($userCard->status == 'completed' ? 'success' : 'secondary') }}">
                                                    {{ ucfirst($userCard->status) }}
                                                </span>
                                            </p>
                                            <form action="{{ route('cart.destroy', [$userCard->id, 'build-a-box']) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-cart-delete btn-sm">Sifarişi Sil
                                                </button>
                                            </form>
                                            @if ($userCard->status == 'pending')
                                                <a href="{{ generateWhatsAppLink('994515032303', 'Qutu Yarat Sifarişi: Kart Adı: ' . ($userCard->card->name ?? 'Bilinmir') . ' Göndərən: ' . $userCard->sender_name . ' Alan: ' . $userCard->recipient_name . ' Mesaj: ' . $userCard->card_message . ' Qiymət: ₼' . number_format($userCard->total_price, 2), auth()->user()) }}"
                                                   target="_blank" class="btn btn-cart-done btn-sm">
                                                    <i class="fa-brands fa-whatsapp"></i> Sifarişi Tamamla
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($premadeBoxOrders as $premadeBoxOrder)
                            <div class="cart-card mb-4">
                                <div class="cart-card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            @if (file_exists(storage_path('app/public/' . $premadeBoxOrder->premadeBox->image)))
                                                <img src="{{ asset('storage/' . $premadeBoxOrder->premadeBox->image) }}"
                                                     alt="Hazır Qutu Şəkli" class="order-item-image">
                                            @else
                                                <p>Şəkil mövcud deyil</p>
                                            @endif
                                        </div>
                                        <div class="col-9">
                                            <h5 class="cart-item-title">{{ $premadeBoxOrder->premadeBox->name ?? 'Premade Box adı mövcud deyil' }}</h5>
                                            @foreach ($premadeBoxOrder->userCardDetails as $userCardDetail)
                                                <p class="cart-item-info">
                                                    <strong>Kimdən:</strong> {{ $userCardDetail->from_name ?? 'Kimdən bilgisi yoxdur' }}
                                                </p>

                                                <p class="cart-item-info">
                                                    <strong>Kimə:</strong> {{ $userCardDetail->to_name ?? 'Kimə bilgisi yoxdur' }}
                                                </p>
                                            @endforeach
                                            <p class="cart-item-info">Qiymət:
                                                ₼{{ number_format($premadeBoxOrder->premadeBox->price ?? 0, 2) }}</p>
                                            <p class="cart-item-info"><strong>Məhsullar:</strong></p>
                                            <ul class="cart-item-contents">
                                                @foreach($premadeBoxOrder->premadeBox->insidings as $insiding)
                                                    <li>{{ $insiding->name ?? 'İçerik adı mevcut değil' }}</li>
                                                @endforeach
                                            </ul>
                                            <p class="cart-item-status">
                                                <strong style="color: #a3907a;">Status:</strong>
                                                <span
                                                        class="badge badge-{{ $premadeBoxOrder->status == 'pending' ? 'warning' : ($premadeBoxOrder->status == 'completed' ? 'success' : 'secondary') }}">
                                                    {{ ucfirst($premadeBoxOrder->status) }}
                                                </span>
                                            </p>
                                            <form
                                                    action="{{ route('cart.destroy', [$premadeBoxOrder->id, 'premade-box']) }}"
                                                    method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-cart-delete btn-sm">Sifarişi Sil
                                                </button>
                                            </form>
                                            @if ($premadeBoxOrder->status == 'pending')
                                                <a href="{{ generateWhatsAppLink('994515032303', 'Hazır Qutu Sifarişi: Qutu Adı: ' . ($premadeBoxOrder->premadeBox->name ?? 'Bilinmir') . ' Göndərən: ' . ($premadeBoxOrder->userCardDetails->first()->from_name ?? 'Bilinmir') . ' Alan: ' . ($premadeBoxOrder->userCardDetails->first()->to_name ?? 'Bilinmir') . ' Qiymət: ₼' . number_format($premadeBoxOrder->premadeBox->price ?? 0, 2), auth()->user()) }}"
                                                   target="_blank" class="btn btn-cart-done btn-sm">
                                                    <i class="fa-brands fa-whatsapp"></i> Sifarişi Tamamla
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection

<style>
    .cart-container {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
    }

    .cart-header-title {
        font-size: 2rem;
        color: #a3907a;
        text-align: center;
    }

    .cart-card {
        background-color: #ffffff;
        border: 1px solid #a3907a;
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-card-body {
        padding: 15px;
    }

    .cart-item-title {
        font-weight: bold;
        color: #a3907a;
        font-size: 1rem;
    }

    .cart-item-info {
        font-size: 0.9rem;
        color: #a3907a;
        margin: 5px 0;
    }

    .cart-item-contents {
        list-style-type: disc;
        padding-left: 20px;
        font-size: 0.9rem;
        color: #898989;
    }

    .cart-item-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .cart-empty-text {
        font-size: 1.25rem;
        color: #898989;
        text-align: center;
        margin-top: 20px;
    }

    .cart-item-status {
        margin-top: 10px;
        font-size: 1rem;
    }

    .cart-item-status .badge {
        color: #ffffff;
        background-color: #a3907a !important; /* Default status color */
    }

    .cart-item-status .badge-success {
        background-color: #a3907a; /* Completed status color */
    }

    .cart-item-status .badge-warning {
        background-color: #898989; /* Pending status color */
    }

    .cart-item-status .badge-secondary {
        background-color: #898989; /* Default/Other status color */
    }

    .btn-cart-done {
        color: #a3907a !important;
        background-color: #ffffff !important;
        border: 1px solid #a3907a !important;
    }

    .btn-cart-delete {
        color: #ffffff !important;
        background-color: #a3907a !important;
    }

    @media (max-width: 768px) {
        .cart-header-title {
            font-size: 1.5rem;
        }

        .cart-item-title {
            font-size: 1rem;
        }

        .cart-item-info {
            font-size: 0.85rem;
        }

        .cart-item-image {
            max-width: 80px;
            height: auto;
        }
    }
</style>
