@extends('front.user.profile')

@section('profile-content')
    <div class="container my-5 orders-container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mb-4 orders-header-title">Sifarişlərim</h2>

                @if($orders->isEmpty())
                    <p class="cart-empty-text">Sifariş yoxdur.</p>
                @else
                    @foreach($orders as $order)
                        <div class="cart-card mb-4">
                            <h4 class="cart-item-header">Sifariş Məlumatı</h4>
                            <div class="cart-card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="{{ asset('storage/' . $order->giftBox->image) }}" alt="Gift Box Image" class="cart-item-image">
                                    </div>
                                    <div class="col-9">
                                        <h5 class="cart-item-title">{{ $order->giftBox->name }}</h5>
                                        <p class="cart-item-info">Card: {{ $order->card->name }}</p>
                                        <p class="cart-item-info">Message: To: {{ $order->recipient_name }}, From: {{ $order->sender_name }}</p>
                                        <p class="cart-item-info">Box Contents: {{ $order->box_contents }}</p>
                                        <p class="cart-item-price">Qiymət: ₼{{ number_format($order->giftBox->price, 2) }}</p>
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
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
    }

    .orders-header-title {
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
        font-size: 1.25rem;
        font-weight: bold;
        color: #495057;
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

    .cart-empty-text {
        font-size: 1rem;
        font-weight: bold;
        color: #6c757d;
        text-align: center;
    }

    @media (max-width: 768px) {
        .orders-header-title {
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
