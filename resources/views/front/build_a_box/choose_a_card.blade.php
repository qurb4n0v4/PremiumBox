@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-a-cart.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                <a href="{{ route('choose.step', $stepNumber) }}" style="text-decoration: none" class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </a>
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Əşyaları əlavə edin', 'Təbrik kartını seçin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>

        @endforeach
    </div>


    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Uyğun Kartı Seçin</h3>
            <p style="font-size: 14px; color: #898989">Komandamız bir sıra xüsusi tədbirlər üçün eksklüziv kart dizaynlarını hazırlayıb.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Seçdiyiniz kartın dizaynını seçin və özəlləşdirin!</p>
        </div>
        <div class="row gy-4 mt-4">
            @foreach ($cards as $card)
                <div class="col-md-3 text-center">
                    <div class="card"
                         style="border: none; overflow: hidden; width: 210px; height: 220px; margin: auto; cursor: pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#modal-{{ $card->id }}">
                        <div style="width: 100%; height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 16px; color: #a3907a;">{{ $card->name }}</h5>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-{{ $card->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $card->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px;">
                        <div class="modal-content rounded-4">
                            <div class="modal-body p-4">
                                <div class="d-flex align-items-start gap-4">
                                    <!-- Image Section -->
                                    <div class="position-relative" style="width: 360px; flex-shrink: 0;">
                                        <div style="height: 320px; width: 360px; overflow: hidden;">
                                            <img src="{{ asset('storage/' . $card->image) }}"
                                                 class="d-block w-100 h-100 object-fit-cover rounded-4"
                                                 alt="{{ $card->name }}">
                                        </div>
                                    </div>
                                    <!-- Details Section -->
                                    <div class="flex-grow-1">
                                        <h5 id="card-name" style="color: #a3907a; font-size: 21px; font-weight: 600; margin-bottom: 40px">
                                            {{ $card->name }}
                                        </h5>
                                        <div style="margin-bottom: 15px; width: 100%;">
                                            <label for="recipient-name" style="color: #212529; font-size: 14px; display: flex; margin-bottom: 8px">Recipient Name</label>
                                            <input type="text" id="recipient-name" class="form-control" style="width: 100% !important; height: 36px; padding: 10px; min-width: 100%;">
                                        </div>
                                        <div style="margin-bottom: 15px; width: 100%;">
                                            <label for="sender-name" style="color: #212529; font-size: 14px; display: flex; margin-bottom: 8px">Sender Name</label>
                                            <input type="text" id="sender-name" class="form-control" style="width: 100% !important; height: 36px; padding: 10px; min-width: 100%;">
                                        </div>
                                        <div style="margin-bottom: 15px; width: 100%;">
                                            <label for="card-content" style="color: #212529; font-size: 14px; display: flex; margin-bottom: 8px">Mesaj:</label>
                                            <textarea id="card-content" class="form-control" rows="3" placeholder="Burada istədiyiniz mesajı yazın və ya boş buraxın" style="width: 100% !important; min-width: 100%; font-size: 12px; padding: 10px; resize: none;"></textarea>
                                        </div>
                                        <div style="margin-bottom: 20px; display: flex; align-items: center; justify-content: flex-start; padding-left: 0;">
                                            <input type="checkbox" id="leave-empty" style="outline: none; accent-color: #a3907a; margin: 0;">
                                            <label for="leave-empty" style="color: #212529; font-size: 14px; outline: none; margin-left: 5px; margin-bottom: 0;">Mesaj hissəni boş burax</label>
                                        </div>
                                        <button id="save-card" class="btn btn-primary mt-3" style="font-size: 14px; width: 100%; height: 35px; line-height: 15px; padding: 10px; background-color: #a3907a; border: none; border-radius: 15px">Qutuya əlavə et</button>
                                        <p style="color: #a3907a; font-size: 14px; margin-top: 10px; display: inline; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Baxış</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach
        </div>
    </div>
@endsection

<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.4) !important;
    }

    input,
    textarea {
        border-radius: 20px!important;
    }
    input:focus, textarea:focus {
        outline: none!important;
        box-shadow: none!important;
        border-color: #a3907a!important;
    }

    .form-control {
        width: 100%;
        margin-bottom: 10px;
    }

    .form-control,
    .btn {
        border-radius: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const recipientInput = document.getElementById('recipient-name');
        const senderInput = document.getElementById('sender-name');
        const contentInput = document.getElementById('card-content');
        const leaveEmptyCheckbox = document.getElementById('leave-empty');
        const saveButton = document.getElementById('save-card');

        const userRecipient = document.getElementById('user-recipient');
        const userSender = document.getElementById('user-sender');
        const userContent = document.getElementById('user-content');

        // Leave the card content empty logic
        leaveEmptyCheckbox.addEventListener('change', () => {
            if (leaveEmptyCheckbox.checked) {
                contentInput.value = '';
                contentInput.disabled = true;
            } else {
                contentInput.disabled = false;
            }
        });

        // Save button logic
        saveButton.addEventListener('click', () => {
            const recipient = recipientInput.value.trim();
            const sender = senderInput.value.trim();
            const content = leaveEmptyCheckbox.checked ? 'Empty' : contentInput.value.trim();

            if (!recipient || !sender || (!content && !leaveEmptyCheckbox.checked)) {
                alert('Please fill all required fields!');
                return;
            }

            // Update the user card
            userRecipient.textContent = recipient;
            userSender.textContent = sender;
            userContent.textContent = content;

            alert('Card saved successfully!');
        });
    });

</script>


