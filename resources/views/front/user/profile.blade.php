@extends('front.layouts.app')
@section('content')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="profile-avatar bg-light rounded-circle d-flex justify-content-center align-items-center"
                         style="width: 80px; height: 80px; font-size: 32px; font-weight: bold; color: #aaa;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-0 text-uppercase">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <ul class="nav nav-tabs mt-4" style="border-bottom: 2px solid #f1f1f1;">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('front/user/profile-details') ? 'active' : '' }}"
                           href="{{ route('profile-details') }}">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('front/user/orders') ? 'active' : '' }}"
                           href="{{ route('orders') }}">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('front/user/addresses') ? 'active' : '' }}"
                           href="{{ route('address-list') }}">Address List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('front/user/coupons') ? 'active' : '' }}"
                           href="{{ route('coupons') }}">My Coupons</a>
                    </li>
                </ul>

                <div class="mt-4">
                    @yield('profile-content')
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    /* Genel Yapı */
    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Profil Avatarı */
    .profile-avatar {
        width: 70px;
        height: 70px;
        background-color: #eaeaea;
        font-size: 28px;
        font-weight: bold;
        color: #bbb;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Kullanıcı Bilgileri */
    .profile-info h4 {
        font-size: 18px;
        font-weight: bold;
        margin: 0;
        color: #333;
    }

    .profile-info p {
        margin: 0;
        font-size: 14px;
        color: #666;
    }

    /* Sekme Yapısı */
    .nav-tabs {
        border-bottom: 2px solid #ddd;
        margin-top: 20px;
    }

    .nav-tabs .nav-item {
        margin-bottom: -1px;
    }

    .nav-tabs .nav-link {
        color: #555;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        border: none;
        background-color: transparent;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        color: #333;
        font-weight: bold;
        border-bottom: 3px solid #a58b71;
    }

    .nav-tabs .nav-link:hover {
        color: #a58b71;
    }
</style>
