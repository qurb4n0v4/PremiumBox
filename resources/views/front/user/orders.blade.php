@extends('front.user.profile')

@section('profile-content')
    <div class="orders-card card">
        <div class="orders-card-body">
            <div class="orders-header">
                <h5 class="orders-title">Sifarişlərim</h5>
            </div>
        </div>
    </div>
@endsection

<style>
    .orders-card {
        background-color: #fff;
        border: none !important;
    }

    .orders-title {
        font-size: 20px;
        /*font-weight: bold;*/
        color: #a3907a !important;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .orders-header {
        display: flex;
        /*align-items: center;*/
    }
</style>
