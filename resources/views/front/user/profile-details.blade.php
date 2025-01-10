@extends('front.user.profile')

@section('profile-content')
    <div class="profile-details-card card">
        <div class="card-body">
            <div class="profile-details-header d-flex justify-content-center align-items-center gap-5">
                <!-- Profil Avatarı -->
                <div class="profile-details-avatar me-4">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <!-- Profil Məlumatları -->
                <div>
                    <h5 class="card-title">Mənim Profilim</h5>
                    <form method="POST" action="{{ route('profile-update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Name" class="form-label">Ad</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" @if(!$editMode) disabled @endif>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Doğum Tarixi</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}" @if(!$editMode) disabled @endif>
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Cinsiyyət</label>
                                <select class="form-control" id="gender" name="gender" @if(!$editMode) disabled @endif>
                                    <option value="">Cinsiyyəti Seçin</option>
                                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Kişi</option>
                                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Qadın</option>
                                    <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Digər</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-poçt</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" @if(!$editMode) disabled @endif>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" @if(!$editMode) disabled @endif>
                            </div>
                        </div>

                        <!-- Butonlar -->
                        @if($editMode)
                            <button type="submit" class="btn btn-secondary" style="background-color: #a58b71; border: none;">Yadda Saxla</button>
                        @else
                            <a href="{{ route('profile-edit') }}" class="btn btn-secondary" style="background-color: #a58b71; border: none;">Düzəlt</a>                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.getElementById('edit-btn').addEventListener('click', function() {
        let inputs = document.querySelectorAll('input');
        inputs.forEach(function(input) {
            input.disabled = false;
        });

        this.style.display = 'none';
        let saveBtn = document.querySelector('button[type="submit"]');
        saveBtn.style.display = 'inline-block';
    });
</script>

<style>
    .profile-details-card {
        background-color: #fff;
        border: 1px solid #898989;
        border-radius: 8px;
        padding: 20px;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        color: #a3907a !important;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 14px;
        font-weight: bold;
        color: #a3907a;
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
    }

    .btn:hover {
        background-color: #8d7159;
    }

    .profile-details-avatar {
        width: 250px;
        height: 250px;
        background-color: #ddd;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: bold;
    }

    .profile-details-header {
        display: flex;
        align-items: center;
    }

    .me-4 {
        margin-right: 1.5rem;
    }
</style>
