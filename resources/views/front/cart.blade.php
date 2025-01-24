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
                                            <img src="{{ asset('storage/' . $userCard->card->image) }}" alt="Box Image"
                                                 class="cart-item-image">
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
                                                    {{ $item->chooseItem->name ?? 'Ad mövcud deyil' }} -
                                                    Variant:
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
                                            @empty
                                                <li>Seçilmiş əşyalar mövcud deyil.</li>
                                            @endforelse
                                        </ul>

                                        <!-- Sipariş durumu -->
                                        <p class="cart-item-status">
                                            <strong style="color: #a3907a;">Status:</strong>
                                            <span class="badge
                            @if ($userCard->status == 'pending')
                                badge-warning
                            @elseif ($userCard->status == 'completed')
                                badge-success
                            @else
                                badge-secondary
                            @endif">
                            {{ ucfirst($userCard->status) }}
                            </span>
                                        </p>

                                        <!-- Silme Butonu -->
                                        <form action="{{ route('cart.destroy', $userCard->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-cart-delete btn-sm">Sifarişi Sil</button>
                                        </form>

                                        <!-- Siparişi Tamamla Butonu -->

                                        @if ($userCard->status == 'pending')
                                            <button type="submit" class="btn btn-cart-done btn-sm">
                                                <i class="fa-brands fa-whatsapp"></i> Siparişi Tamamla
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="cart-empty-text">Səbət boşdur.</p>
                    @endforelse
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
        background-color: #898989; /* Default status color */
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
