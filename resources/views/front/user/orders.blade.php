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
                            <div class="order-card-body">
                                <div class="row align-items-center">
                                    <!-- Gift Box Image -->
                                    <div class="col-4">
                                        @if ($order->giftBox && $order->giftBox->image)
                                            <img src="{{ asset('storage/' . $order->giftBox->image) }}"
                                                 alt="Gift Box Image"
                                                 class="order-item-image">
                                        @else
                                            <p>Şəkil mövcud deyil</p>
                                        @endif
                                    </div>

                                    <!-- Gift Box Details -->
                                    <div class="col-8">
                                        <h5 class="order-item-title">
                                            {{ $order->giftBox->title ?? 'Qutu adı mövcud deyil' }}
                                        </h5>
                                        <p class="order-item-info">
                                            Card: {{ $order->card->name ?? 'Kart adı mövcud deyil' }}
                                        </p>
                                        <p class="order-item-info">
                                            Message: To: {{ $order->recipient_name }}, From: {{ $order->sender_name }}
                                        </p>

                                        <!-- Box Contents -->
                                        <p class="order-item-info">Box Contents:</p>
                                        @if($order->userBuildABoxCardItems && $order->userBuildABoxCardItems->isNotEmpty())
                                            <ul class="order-item-box-contents">
                                                @foreach($order->userBuildABoxCardItems as $item)
                                                    <li class="order-item-box-content">
                                                        <div class="d-flex align-items-center">
                                                            <!-- Item Image -->
                                                            @if ($item->chooseItem && $item->chooseItem->normal_image)
                                                                <img
                                                                    src="{{ asset('storage/' . $item->chooseItem->normal_image) }}"
                                                                    alt="Item Image"
                                                                    class="box-content-image me-3">
                                                            @else
                                                                <p>Şəkil mövcud deyil</p>
                                                            @endif
                                                            <!-- Item Name -->
                                                            <span>{{ $item->chooseItem->name ?? 'Item adı mövcud deyil' }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Box içeriği mövcud deyil</p>
                                        @endif

                                        <p class="order-item-price">
                                            Qiymət: ₼{{ number_format($order->giftBox->price ?? 0, 2) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Order Status -->
                                <div class="d-flex justify-content-end mt-3 order-item-actions">
                                    <span class="text-muted">Order Status:
                                        <strong class="order-status">{{ ucfirst($order->status) }}</strong>
                                    </span>
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
        text-align: center;
        margin-bottom: 20px;
    }

    .order-card {
        background-color: #ffffff;
        border: 1px solid #a3907a;
        border-radius: 8px;
        overflow: hidden;
        /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
        margin-bottom: 20px;
    }

    .order-card-body {
        padding: 20px;
    }

    .order-item-header {
        font-size: 1.25rem;
        color: #a3907a;
        margin-bottom: 15px;
    }

    .order-item-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #a3907a;
    }

    .order-item-info {
        font-size: 0.95rem;
        color: #898989;
        margin: 5px 0;
    }

    .order-item-price {
        font-size: 1rem;
        color: #898989;
        margin-top: 10px;
    }

    .order-item-actions {
        font-size: 0.9rem;
        color: #898989;
    }

    .order-status {
        font-weight: bold;
        color: #a3907a;
    }

    .order-item-box-contents {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .order-item-box-content {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .box-content-image {
        width: 40px;
        height: 40px;
        margin-right: 10px;
        border-radius: 4px;
        object-fit: cover;
    }

    .orders-empty-text {
        font-size: 1.25rem;
        color: #898989;
        text-align: center;
        margin-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .orders-header-title {
            font-size: 1.5rem;
        }

        .order-item-title {
            font-size: 1rem;
        }

        .order-item-info {
            font-size: 0.9rem;
        }

        .order-item-price {
            font-size: 0.95rem;
        }

        .order-item-box-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .box-content-image {
            margin-bottom: 5px;
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
    }
</style>
