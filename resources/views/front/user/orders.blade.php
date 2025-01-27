@extends('front.user.profile')

@section('profile-content')
    <div class="container my-5 orders-container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mb-4 orders-header-title">Sifarişlərim</h2>

                @if($orders->isEmpty() && $premadeBoxOrders->isEmpty())
                    <p class="orders-empty-text">Sifariş yoxdur.</p>
                @else
                    @foreach($orders as $order)
                        <div class="order-card mb-4">
                            <div class="order-card-body">
                                <div class="row align-items-center">
                                    <!-- Hədiyyə Qutusu Şəkli -->
                                    <div class="col-4">
                                        @if ($order->giftBox && $order->giftBox->image)
                                            <img src="{{ asset('storage/' . $order->giftBox->image) }}"
                                                 alt="Hədiyyə Qutusu Şəkli"
                                                 class="order-item-image">
                                        @else
                                            <p>Şəkil mövcud deyil</p>
                                        @endif
                                    </div>

                                    <!-- Hədiyyə Qutusu Təfərrüatları -->
                                    <div class="col-8">
                                        <h5 class="order-item-title">
                                            {{ $order->giftBox->title ?? 'Qutu adı mövcud deyil' }}
                                        </h5>
                                        <p class="order-item-info">
                                            Kart: {{ $order->card->name ?? 'Kart adı mövcud deyil' }}
                                        </p>
                                        <p class="order-item-info">
                                            Kimə: {{ $order->recipient_name }},
                                            Kimdən: {{ $order->sender_name }}
                                        </p>
                                        <!-- Qutudakı Məhsullar -->
                                        <p class="order-item-info" style="color: #a3907a;">Məhsullar:</p>
                                        @if($order->userBuildABoxCardItems && $order->userBuildABoxCardItems->isNotEmpty())
                                            <ul class="order-item-box-contents">
                                                @foreach($order->userBuildABoxCardItems as $item)
                                                    <li class="order-item-box-content">
                                                        <div class="d-flex align-items-center">
                                                            <!-- Məhsul Şəkli -->
                                                            @if ($item->chooseItem && $item->chooseItem->normal_image)
                                                                <img
                                                                    src="{{ asset('storage/' . $item->chooseItem->normal_image) }}"
                                                                    alt="Məhsul Şəkli"
                                                                    class="box-content-image me-3">
                                                            @else
                                                                <p>Şəkil mövcud deyil</p>
                                                            @endif
                                                            <!-- Məhsul Adı -->
                                                            <span>{{ $item->chooseItem->name ?? 'Məhsul adı mövcud deyil' }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Qutu içeriği mövcud deyil</p>
                                        @endif

                                        <p class="order-item-price">
                                            <strong style="color: #a3907a;">Qiymət:</strong>
                                            ₼{{ number_format($order->total_price, 2) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Sifariş Statusu -->
                                <div class="d-flex justify-content-end mt-3 order-item-actions">
                                    <span class="text-muted">Sifariş Statusu:
                                        <strong class="order-status">{{ ucfirst($order->status) }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @forelse($premadeBoxOrders as $premadeBoxOrder)
                        @if(in_array($premadeBoxOrder->status, ['accepted', 'completed', 'rejected']))
                            <div class="order-card mb-4">
                                <div class="order-card-body">
                                    <div class="row align-items-center">
                                        <!-- Hazır Qutu Şəkli -->
                                        <div class="col-4">
                                            @if (file_exists(storage_path('app/public/' . $premadeBoxOrder->premadeBox->image)))
                                                <img src="{{ asset('storage/' . $premadeBoxOrder->premadeBox->image) }}" alt="Hazır Qutu Şəkli" class="order-item-image">
                                            @else
                                                <p>Şəkil mövcud deyil</p>
                                            @endif
                                        </div>

                                        <!-- Hazır Qutu Təfərrüatları -->
                                        <div class="col-8">
                                            <h5 class="order-item-title">
                                                {{ $premadeBoxOrder->premadeBox->name ?? 'Hazır Qutu adı mövcud deyil' }}
                                            </h5>
                                            @foreach ($premadeBoxOrder->userCardDetails as $userCardDetail)
                                                <p class="order-item-info" style="color: #898989;">
                                                    Kimə: {{ $userCardDetail->to_name ?? 'Kime bilgisi yox' }},
                                                    Kimdən: {{ $userCardDetail->from_name ?? 'Kim tarafından bilgisi yox' }}
                                                </p>
                                            @endforeach
                                            <p class="order-item-info" style="color: #a3907a;">Məhsullar:</p>
                                            <ul class="cart-item-contents" style="color: #898989;">
                                                @forelse($premadeBoxOrder->premadeBox->insidings as $insiding)
                                                    <li>{{ $insiding->name ?? 'İçerik adı mevcut değil' }}</li>
                                                @empty
                                                    <li>İçerik bilgisi mevcut değil.</li>
                                                @endforelse
                                            </ul>
                                            <p class="order-item-price">
                                                <strong style="color: #a3907a;">Qiymət:</strong>
                                                ₼{{ number_format($premadeBoxOrder->premadeBox->price ?? 0, 2) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Sifariş Statusu -->
                                    <div class="d-flex justify-content-end mt-3 order-item-actions">
                                        <span class="text-muted">Sifariş Statusu:
                                            <strong class="order-status">{{ ucfirst($premadeBoxOrder->status) }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
{{--                        <p class="orders-empty-text">Hazır qutu sifarişləriniz yoxdur.</p>--}}
                    @endforelse
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
        margin-bottom: 20px;
    }

    .order-card-body {
        padding: 20px;
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

    @media (max-width: 768px) {
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
