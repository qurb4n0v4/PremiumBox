@extends('front.layouts.app')

@section('title', 'Komandamızla Əlaqə')

@section('content')
    <div class="container my-5">
        <div class="row g-4 py-3">
            <div class="col-md-6">
                <img src="{{ asset('assets/front/img/whatsapp-form.webp') }}" alt="Komandamızla Əlaqə" class="img-fluid rounded shadow form-image" />
            </div>

            <div class="col-md-6">
                <h1 class="fw-bold chat-title mb-4">Komandamızla Danışın</h1>
                <p class="text-muted mb-4">
                    Xüsusi gününüzü necə qeyd etməkdə sizə kömək edə biləcəyimizi bizə bildirin.
                </p>

                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label chat-label">Ad</label>
                        <input type="text" name="name" id="name" class="form-control chat-input" placeholder="Adınız" required>
                    </div>

                    <div class="mb-3">
                        <label for="gift_type" class="form-label chat-label">Hansı növ hədiyyə axtarırsınız?</label>
                        <select id="gift_type" name="gift_type" class="form-select chat-select" required>
                            <option value="Birthday">Doğum Günü</option>
                            <option value="Anniversary">Yubiley</option>
                            <option value="Corporate">Korporativ</option>
                            <option value="Custom">Xüsusi</option>
                            <option value="Custom">Yeni Il</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label chat-label">Mesaj</label>
                        <textarea id="message" name="message" rows="10" class="form-control chat-input" placeholder="Mesajınızı buraya yazın..." required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-whatsapp-send btn-lg">
                            Göndər
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .chat-title {
        color: #a3907a;
        font-size: 35px;
        font-weight: normal;
    }

    .form-control, .form-select {
        background-color: #f8f9fa;
        border-color: #a3907a;
    }

    .chat-label {
        color: #a3907a;
    }

    .chat-input {
        color: #898989 !important;
    }

    .chat-select {
        color: #a3907a !important;
    }

    .btn-whatsapp-send {
        background-color: #a3907a;
        border: none;
        border-radius: 20px;
        color: #ffffff;
        max-width: 200px;
        padding: 5px !important;
    }

    .btn-whatsapp-send:hover {
        background-color: #ffffff;
        border: 1px solid #a3907a;
        color: #a3907a;
    }
    .container, .row, .col-md-6 {
        margin: 0;
        padding: 0;
    }

    h1, h2, p, label {
        margin-bottom: 10px;
    }
    @media (max-width: 1167px) {
        .row > .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .row {
            display: flex;
            flex-direction: column;
        }

        .form-control, .form-select {
            font-size: 1rem;
        }

        .btn-whatsapp-send {
            padding: 1rem;
        }
    }


    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }

        .col-md-6 {
            flex: 0 0 100%;
        }

        h1 {
            font-size: 1.8rem;
        }

        .form-control, .form-select {
            font-size: 1rem;
        }

        .form-label {
            font-size: 1rem;
        }

        .btn-whatsapp-send {
            padding: 1rem;
        }
    }
</style>
