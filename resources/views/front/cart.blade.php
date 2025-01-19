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
                            <h4 class="cart-item-header">Seçilmiş Qutu</h4>
                            <div class="cart-card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="{{ $userCard->card->image }}" alt="Box Image" class="cart-item-image">
                                    </div>
                                    <div class="col-9">
                                        <h5 class="cart-item-title">{{ $userCard->card->name }}</h5>
                                        <p class="cart-item-info">Kimə: {{ $userCard->recipient_name }}</p>
                                        <p class="cart-item-info">Kimdən: {{ $userCard->sender_name }}</p>
                                        <p class="cart-item-info">Mesaj: {{ $userCard->card_message }}</p>
                                        <p class="cart-item-price">Qiymət: ₼{{ $userCard->card->price }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cart-card mb-4">
                            <h4 class="cart-item-header">Seçilmiş Əşyalar</h4>
                            <div class="cart-card-body">
                                @foreach($userCard->items as $item)
                                    <div class="row align-items-center mb-3">
                                        <div class="col-3">
                                            <img src="{{ asset('storage/' . $item->choose_item_id) }}" alt="Item Image" class="cart-item-image">
                                        </div>
                                        <div class="col-9">
                                            <h5 class="cart-item-title">Variant: {{ $item->selected_variants }}</h5>
                                            <p class="cart-item-info">Mətn: {{ $item->user_text }}</p>
                                        </div>
                                    </div>
                                @endforeach
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
        border: 1px solid #898989;
        /*box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);*/
    }

    .cart-header-title {
        font-size: 2rem;
        /*font-weight: bold;*/
        color: #a3907a;
        text-align: center;
    }

    .cart-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-card-body {
        padding: 15px;
    }

    .cart-item-header {
        font-size: 1.25rem;
        font-weight: bold;
        color: #6c757d;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .cart-item-title {
        font-weight: bold;
        color: #495057;
        font-size: 1rem;
    }

    .cart-item-info {
        font-size: 0.9rem;
        color: #6c757d;
        margin: 5px 0;
    }

    .cart-item-price {
        font-size: 1.25rem;
        font-weight: bold;
        color: #007bff;
        margin-top: 10px;
    }

    .cart-item-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .cart-empty-text {
        font-size: 1.25rem;
        /*font-weight: bold;*/
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

        .cart-item-price {
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
