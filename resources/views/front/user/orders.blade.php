@extends('front.user.profile')

@section('profile-content')
    <div class="container my-5 orders-container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mb-4 orders-header-title">Sifarişlərim</h2>

                @if($orders->isEmpty())
                    <p class="orders-empty-text">Sifariş yoxdur.</p>
                @else
                    @foreach($orders as $order)
                        <div class="order-card mb-4">
                            <h4 class="order-item-header">Sifariş Məlumatı</h4>
                            <div class="order-card-body">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        @if ($order->giftBox && $order->giftBox->image)
                                            <img src="{{ asset('storage/' . $order->giftBox->image) }}" alt="Gift Box Image" class="order-item-image">
                                        @else
                                            <p>Şəkil mövcud deyil</p>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <h5 class="order-item-title">{{ $order->giftBox->name ?? 'Qutu adı mövcud deyil' }}</h5>
                                        <p class="order-item-info">Card: {{ $order->card->name ?? 'Kart adı mövcud deyil' }}</p>
                                        <p class="order-item-info">Message: To: {{ $order->recipient_name }}, From: {{ $order->sender_name }}</p>
                                        <p class="order-item-info">Box Contents: {{ $order->box_contents ?? 'Box içeriği mövcud deyil' }}</p>
                                        <p class="order-item-price">Qiymət: ₼{{ number_format($order->giftBox->price ?? 0, 2) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3 order-item-actions">
                                    <span class="text-muted">Order Status: <strong class="order-status">{{ ucfirst($order->status) }}</strong></span>
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
        color: #a3907a;
    }

    .order-card {
        background-color: #ffffff;
        border: 1px solid #a3907a;
        border-radius: 8px;
        overflow: hidden;
        /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
    }

    .order-card-body {
        padding: 20px;
    }

    .order-item-header {
        font-size: 1.25rem;
        font-weight: bold;
        color: #898989; /* Rengi değiştirdim */
    }

    .order-item-title {
        font-weight: bold;
        color: #495057;
    }

    .order-item-price {
        font-size: 1.25rem;
        font-weight: bold;
        color: #007bff;
    }

    .order-item-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .order-item-info {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .order-item-actions {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .orders-empty-text {
        font-size: 1rem;
        font-weight: bold;
        color: #898989; /* #898989 rengini kullandım */
        text-align: center;
    }

    .order-status {
        color: #a3907a !important; /* #a3907a rengini kullandım */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .orders-header-title {
            font-size: 1.5rem;
        }

        .order-item-title {
            font-size: 1.1rem;
        }

        .order-item-price {
            font-size: 1rem;
        }

        .order-item-info {
            font-size: 0.85rem;
        }

        .order-card-body {
            padding: 15px;
        }

        .order-item-header {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .order-card-body {
            padding: 10px;
        }

        .order-item-title {
            font-size: 1rem;
        }

        .order-item-price {
            font-size: 1rem;
        }

        .order-item-info {
            font-size: 0.8rem;
        }
    }
</style>
