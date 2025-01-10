@extends('front.user.profile')

@section('profile-content')
    <div class="container coupons-container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-8 col-md-10">
                <h5 class="mb-0">Kuponlarım</h5>
            </div>
        </div>

        <div class="row coupons-body">
            <div class="col-12">
                {{--                kuponlar bura gelecek--}}
            </div>
        </div>
    </div>
@endsection
<style>
    .coupons-container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
    }

    h5 {
        font-size: 20px;
        color: #a3907a !important;
    }
</style>
