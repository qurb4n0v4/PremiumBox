@extends('front.layouts.app')
@section('content')
        <div class="container my-5">
            <div class="profile-card card border-0">
                <div class="card-body">
                    <div class="profile-header d-flex align-items-center gap-2">

                        <div
                            class="profile-avatar bg-light rounded-circle d-flex justify-content-center align-items-center">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="d-flex flex-column justify-content-center ms-3">
                            <h4 class="profile-name mb-0 text-uppercase">{{ Auth::user()->name }}</h4>
                            <p class="profile-email text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mt-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('front/user/profile-details') ? 'active' : '' }}"
                               href="{{ route('profile-details') }}">Profilim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('front/user/orders') ? 'active' : '' }}"
                               href="{{ route('orders.index') }}">Sifarişlərim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('front/user/addresses') ? 'active' : '' }}"
                               href="{{ route('addresses.index') }}">Ünvanlarım</a>
                        </li>
                    </ul>

                    <div class="profile-content mt-4 d-flex justify-content-center">
                        @yield('profile-content')
                    </div>
                </div>
            </div>
        </div>
@endsection
<style>
    .container {
        max-width: 1200px !important;
        margin: 0 auto;
        padding: 20px;
    }

    /* Profil Kartı */
    .profile-card {
        background-color: #fff;
        padding: 20px;
    }

    /* Profil Başlıq */
    .profile-header {
        display: flex;
        align-items: center;
        gap: 15px;
    }

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

    .profile-name {
        font-size: 18px;
        color: #a3907a;
    }

    .profile-email {
        font-size: 13px;
        color: #a3907a;
    }

    .nav-tabs {
        border-bottom: 2px solid #f1f1f1;
        margin-top: 20px;
    }

    .nav-tabs .nav-link {
        color: #898989;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        background-color: transparent;
        padding: 10px 15px;
    }

    .nav-tabs .nav-link.active {
        color: #a3907a !important;
        border-bottom: none;
    }

    .nav-tabs .nav-link:hover {
        color: #a58b71;
    }
</style>
