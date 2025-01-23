@extends('front.layouts.app')

@section('title', 'Səbət')

@section('content')
    <div class="container my-5 cart-container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mb-4 text-center cart-header-title">Səbət</h2>

                @auth
                    @forelse($userCards as $userCard)
                        <!-- Seçilmiş Kart -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="cart-item-header">Seçilmiş Qutu</h4>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4 col-sm-3">
                                        @if ($userCard->card && $userCard->card->image)
                                            <img src="{{ asset('storage/' . $userCard->card->image) }}" alt="Box Image" class="img-fluid rounded">
                                        @else
                                            <p>Şəkil mövcud deyil</p>
                                        @endif
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        <h5 class="cart-item-title">{{ $userCard->card->name ?? 'Kart adı mövcud deyil' }}</h5>
                                        <p class="cart-item-info">Kimə: {{ $userCard->recipient_name }}</p>
                                        <p class="cart-item-info">Kimdən: {{ $userCard->sender_name }}</p>
                                        <p class="cart-item-info">Mesaj: {{ $userCard->card_message }}</p>
                                        <p class="cart-item-price">Qiymət: ₼{{ $userCard->card->price ?? '0.00' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Seçilmiş Əşyalar -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="cart-item-header">Seçilmiş Əşyalar</h4>
                            </div>
                            <div class="card-body">
                                @forelse($userCard->userBuildABoxCardItems as $item)
                                    <div class="row align-items-center mb-3">
                                        <div class="col-4 col-sm-3">
                                            @if ($item->chooseItem && $item->chooseItem->normal_image)
                                                <img src="{{ asset('storage/' . $item->chooseItem->normal_image) }}" alt="Item Image" class="img-fluid rounded">
                                            @else
                                                <p>Şəkil mövcud deyil</p>
                                            @endif
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            <h5 class="cart-item-title">{{ $item->chooseItem->name ?? 'Ad mövcud deyil' }}</h5>
                                            <p class="cart-item-info">Variant: {{ $item->selected_variants }}</p>
                                            <p class="cart-item-info">Mətn: {{ $item->user_text }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p>Seçilmiş əşyalar mövcud deyil.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-center cart-empty-text">Səbət boşdur.</p>
                    @endforelse
                @else
                    <p class="text-center cart-empty-text">Səbət boşdur. Xahiş edirik, giriş edin.</p>
                @endauth
            </div>
        </div>
    </div>
@endsection

<style>
    .cart-container {
        padding: 20px;
    }

    .cart-header-title {
        font-size: 2rem;
        color: #a3907a;
    }

    .cart-item-header {
        font-size: 1.25rem;
        font-weight: bold;
        color: #a3907a;
    }

    .cart-item-title {
        font-weight: bold;
        font-size: 1rem;
        color: #898989;
    }

    .cart-item-info {
        font-size: 0.9rem;
        margin: 5px 0;
        color: #898989;
    }

    .cart-item-price {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 10px;
        color: #a3907a;
    }

    .cart-empty-text {
        font-size: 1.25rem;
        margin-top: 20px;
        color: #898989;
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
    }
</style>
