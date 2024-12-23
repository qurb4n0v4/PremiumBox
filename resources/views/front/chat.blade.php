@extends('front.layouts.app')

@section('title', 'Chat with Our Team')

@section('content')
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                <img src="{{ asset('assets/front/img/whatsapp-form.webp') }}" alt="Gift Box" class="img-fluid rounded shadow">
            </div>

            <div class="col-md-6">
                <h2 class="fw-bold text-dark mb-4">Chat with Our Team</h2>
                <p class="text-muted mb-4">
                    Let us know how we can help you celebrate your special day.
                </p>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your name" required>
                    </div>

                    <div class="mb-3">
                        <label for="gift_type" class="form-label">What kind of gift are you looking for?</label>
                        <select id="gift_type" name="gift_type" class="form-select" required>
                            <option value="Birthday">Birthday</option>
                            <option value="Anniversary">Anniversary</option>
                            <option value="Corporate">Corporate</option>
                            <option value="Custom">Custom</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" rows="4" class="form-control" placeholder="Type your message here..." required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
