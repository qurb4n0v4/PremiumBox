@extends('front.layouts.app')

@section('title', 'Komandamızla Əlaqə')

@section('content')
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                <img src="{{ asset('assets/front/img/whatsapp-form.webp') }}" alt="Gift Box" class="img-fluid rounded shadow">
            </div>

            <div class="col-md-6">
                <h2 class="fw-bold text-dark mb-4">Komandamızla Danışın</h2>
                <p class="text-muted mb-4">
                    Xüsusi gününüzü necə qeyd etməkdə sizə kömək edə biləcəyimizi bizə bildirin.
                </p>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Ad</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Adınız" required>
                    </div>

                    <div class="mb-3">
                        <label for="gift_type" class="form-label">Hansı növ hədiyyə axtarırsınız?</label>
                        <select id="gift_type" name="gift_type" class="form-select" required>
                            <option value="Birthday">Ad günüdür</option>
                            <option value="Anniversary">Yubiley</option>
                            <option value="Corporate">Korporativ</option>
                            <option value="Custom">Xüsusi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Mesaj</label>
                        <textarea id="message" name="message" rows="4" class="form-control" placeholder="Mesajınızı buraya yazın..." required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            Göndər
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
