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
                    @if($userCards->isEmpty())
                        <p class="text-muted">Sepet boş</p>
                    @else
                        @foreach($userCards as $userCard)
                            @if($userCard->status == 'pending')
                                <!-- Cart Item -->
                                <div class="cart-card cart-item mb-4 shadow-sm">
                                    <div class="cart-card-body">
                                        <div class="d-flex justify-content-between align-items-center cart-item-header">
                                            <h5 class="cart-item-title mb-0" style="color: #a3907a;">
                                                {{ $userCard->giftBox->name }}
                                            </h5>
                                            <span class="fw-bold cart-item-price" style="color: #a3907a;">
                                                Rp {{ number_format($userCard->giftBox->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <hr>
                                        <div class="row cart-item-details">
                                            <div class="col-12 col-md-4">
                                                <img src="{{ asset('storage/' . $userCard->giftBox->image) }}" class="img-fluid rounded cart-item-image" alt="{{ $userCard->giftBox->name }}">
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Bag:</strong> {{ $userCard->box_customization_text }}</p>
                                                <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Card:</strong> {{ $userCard->card->name }}</p>
                                                <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Message:</strong> To: {{ $userCard->recipient_name }}, From: {{ $userCard->sender_name }}</p>
                                                <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Box Contents:</strong> {{ $userCard->box_customization_text }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3 cart-item-actions">
                                            <button class="btn btn-sm cart-delete-btn">Delete Box</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @else
                    <p class="text-muted">Sepet boş</p>
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
