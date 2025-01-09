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
{{--                sifarisler bura gelecek--}}
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
</style>
