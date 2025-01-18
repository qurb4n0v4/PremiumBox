@extends('front.user.profile')

@section('profile-content')
    <div class="container orders-container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-8 col-md-10">
                <h5 class="mb-0">Sifarişlərim</h5>
            </div>
        </div>

        <div class="row orders-body">
            <div class="col-12">
                <div class="cart-card cart-item mb-4 shadow-sm">
                    <div class="cart-card-body">
                        <div class="d-flex justify-content-between align-items-center cart-item-header">
                            <h5 class="cart-item-title mb-0" style="color: #a3907a;">BOX &amp; TALE CNY 2025 - BLOSSOM GIFT SET</h5>
                            <span class="fw-bold cart-item-price" style="color: #a3907a;">Rp 348.000</span>
                        </div>
                        <hr>
                        <div class="row cart-item-details">
                            <div class="col-12 col-md-4">
                                <img src="path-to-image.jpg" class="img-fluid rounded cart-item-image" alt="Gift Set">
                            </div>
                            <div class="col-12 col-md-8">
                                <p class="mb-2 cart-item-info"><strong>Bag:</strong> BOX &amp; TALE CNY 2025 - CNY TOTE BAG</p>
                                <p class="mb-2 cart-item-info"><strong>Card:</strong> Year of The Snake</p>
                                <p class="mb-2 cart-item-info"><strong>Message:</strong> To: JH, From: UH</p>
                                <p class="mb-2 cart-item-info"><strong>Box Contents:</strong> BOX &amp; TALE CNY 2025 - Blossom Gift Set, Year of The Snake</p>
                            </div>
                        </div>
{{--                        <div class="d-flex justify-content-end mt-3 cart-item-actions">--}}
{{--                            <button class="btn btn-sm cart-delete-btn">Cancel Order</button>--}}
{{--                        </div>--}}
                    </div>
                </div>
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
