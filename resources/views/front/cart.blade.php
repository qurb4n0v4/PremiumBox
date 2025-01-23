@extends('front.layouts.app')

@section('title', 'Səbət')

@section('content')
    <div class="container my-5 cart-container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mb-4 cart-header-title">Səbət</h2>

                @auth
                    @forelse($userCards as $userCard)
                        <div class="cart-card mb-4">
                            <div class="cart-card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        @if ($userCard->card && $userCard->card->image)
                                            <img src="{{ asset('storage/' . $userCard->card->image) }}" alt="Box Image" class="cart-item-image">
                                        @else
                                            <p>Şəkil mövcud deyil</p>
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <h5 class="cart-item-title">{{ $userCard->card->name ?? 'Kart adı mövcud deyil' }}</h5>
                                        <p class="cart-item-info">Kimdən: {{ $userCard->sender_name }}</p>
                                        <p class="cart-item-info">Kimə: {{ $userCard->recipient_name }}</p>
                                        <p class="cart-item-info">Mesaj: {{ $userCard->card_message }}</p>
                                        <p class="cart-item-info"><strong>Box Contents:</strong></p>
                                        <ul class="cart-item-contents">
                                            @forelse($userCard->userBuildABoxCardItems as $item)
                                                <li>
                                                    {{ $item->chooseItem->name ?? 'Ad mövcud deyil' }} - Variant: {{ $item->selected_variants }} - Mətn: {{ $item->user_text }}
                                                </li>
                                            @empty
                                                <li>Seçilmiş əşyalar mövcud deyil.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="cart-empty-text">Səbət boşdur.</p>
                    @endforelse
                @else
                    <p class="cart-empty-text">Səbət boşdur. Xahiş edirik, giriş edin.</p>
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
