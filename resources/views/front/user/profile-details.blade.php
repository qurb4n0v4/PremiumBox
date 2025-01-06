@extends('front.user.profile')

@section('profile-content')
    <div class="card">
        <div class="card-body">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <h5 class="card-title text-muted">My Profile</h5>
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="{{ $user->first_name }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="{{ $user->last_name }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dob" class="form-label">DOB</label>
                        <input type="text" class="form-control" id="dob" value="{{ $user->dob }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" value="{{ $user->gender }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" disabled>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary" style="background-color: #a58b71; border: none;">Edit</button>
            </form>
        </div>
    </div>
@endsection
<style>
    .card {
        background-color: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 14px;
        font-weight: bold;
        color: #555;
    }

    .form-control {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
        color: #555;
    }

    .form-control:disabled {
        background-color: #f1f1f1;
        color: #999;
    }

    .btn {
        background-color: #a58b71;
        color: #fff;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 20px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn:hover {
        background-color: #8d7159;
    }
</style>
