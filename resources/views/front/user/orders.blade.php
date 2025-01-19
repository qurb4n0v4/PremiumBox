@extends('front.user.profile')

@section('profile-content')
    <div class="container my-5 orders-container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 orders-header-title" style="color: #a3907a;">Sifarişlərim</h2>

                @if($orders->isEmpty())
                    <p class="text-muted">Sifariş yoxdur</p>
                @else
                    @foreach($orders as $order)
                        <!-- Order Item -->
                        <div class="cart-card cart-item mb-4 shadow-sm">
                            <div class="cart-card-body">
                                <div class="d-flex justify-content-between align-items-center cart-item-header">
                                    <h5 class="cart-item-title mb-0" style="color: #a3907a;">
                                        {{ $order->giftBox->name }}
                                    </h5>
                                    <span class="fw-bold cart-item-price" style="color: #a3907a;">
                                        Rp {{ number_format($order->giftBox->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <hr>
                                <div class="row cart-item-details">
                                    <div class="col-12 col-md-4">
                                        <img src="{{ asset('storage/' . $order->giftBox->image) }}" class="img-fluid rounded cart-item-image" alt="{{ $order->giftBox->name }}">
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Bag:</strong> {{ $order->bag->name }}</p>
                                        <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Card:</strong> {{ $order->card->name }}</p>
                                        <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Message:</strong> To: {{ $order->recipient_name }}, From: {{ $order->sender_name }}</p>
                                        <p class="mb-2 cart-item-info"><strong style="color: #a3907a;">Box Contents:</strong> {{ $order->box_contents }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3 cart-item-actions">
                                    <span class="text-muted">Order Status: <strong style="color: #a3907a;">{{ ucfirst($order->status) }}</strong></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .orders-container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
    }

    h5 {
        font-size: 20px;
        color: #a3907a !important;
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

    @media (max-width: 768px) {
        h5 {
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
