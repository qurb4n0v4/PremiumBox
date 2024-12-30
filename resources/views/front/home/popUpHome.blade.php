{{--<div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header flex-column align-items-center">--}}
{{--                <h5 class="modal-title text-center" id="popupModalLabel">The Easiest Way to Custom a Gift</h5>--}}
{{--                <h3 class="modal-title text-center">Get Free Shipping for Your First Order!</h3>--}}
{{--            </div>--}}
{{--            <div class="modal-body text-center">--}}
{{--                <div class="images-wrapper">--}}
{{--                    <div class="image-container">--}}
{{--                        <h6>{{ $popUpHome->title1 }}</h6>--}}
{{--                        <div class="image-box">--}}
{{--                            <img src="{{ asset('storage/' . $popUpHome->image1) }}" alt="Image 1">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="image-container">--}}
{{--                        <h6>{{ $popUpHome->title2 }}</h6>--}}
{{--                        <div class="image-box">--}}
{{--                            <img src="{{ asset('storage/' . $popUpHome->image2) }}" alt="Image 2">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<style>--}}
{{--    .modal {--}}
{{--        display: none;--}}
{{--        position: fixed;--}}
{{--        top: 0;--}}
{{--        left: 0;--}}
{{--        width: 100%;--}}
{{--        height: 100%;--}}
{{--        align-items: center;--}}
{{--        justify-content: center;--}}
{{--        padding: 0 !important;--}}
{{--    }--}}

{{--    .modal.fade.show {--}}
{{--        display: flex !important;--}}
{{--    }--}}

{{--    .modal-dialog.modal-lg {--}}
{{--        max-width: 700px;--}}
{{--        width: calc(100% - 2rem);--}}
{{--        margin: 1rem auto;--}}
{{--        position: absolute;--}}
{{--        left: 50%;--}}
{{--        top: 50%;--}}
{{--        transform: translate(-50%, -50%) !important;--}}
{{--    }--}}

{{--    .modal-content {--}}
{{--        padding: 10px;--}}
{{--        border-radius: 10px;--}}
{{--        width: 100%;--}}
{{--        position: relative;--}}
{{--        margin: 0 auto;--}}
{{--    }--}}

{{--    /* Rest of your existing styles remain the same */--}}
{{--    .modal-header {--}}
{{--        border-bottom: none;--}}
{{--        padding-bottom: 0;--}}
{{--    }--}}

{{--    .modal-header h5 {--}}
{{--        font-size: 1.25rem;--}}
{{--        color: #898989;--}}
{{--    }--}}

{{--    .modal-header h3 {--}}
{{--        font-size: 1.75rem;--}}
{{--        margin-bottom: 1rem;--}}
{{--        color: #a3907a;--}}
{{--    }--}}

{{--    .modal-body {--}}
{{--        padding: 20px 0;--}}
{{--    }--}}

{{--    .images-wrapper {--}}
{{--        display: flex;--}}
{{--        justify-content: center;--}}
{{--        gap: 20px;--}}
{{--        width: 100%;--}}
{{--    }--}}

{{--    .image-container {--}}
{{--        flex: 0 1 300px;--}}
{{--        display: flex;--}}
{{--        flex-direction: column;--}}
{{--        position: relative;--}}
{{--    }--}}

{{--    .image-container h6 {--}}
{{--        position: absolute;--}}
{{--        bottom: 10px;--}}
{{--        left: 50%;--}}
{{--        transform: translateX(-50%);--}}
{{--        margin: 0;--}}
{{--        z-index: 10;--}}
{{--        font-size: 1.1rem;--}}
{{--        color: white;--}}
{{--        padding: 8px 16px;--}}
{{--        width: 100%;--}}
{{--        text-align: center;--}}
{{--    }--}}

{{--    .image-box {--}}
{{--        width: 100%;--}}
{{--        height: 400px;--}}
{{--        overflow: hidden;--}}
{{--    }--}}

{{--    .image-box img {--}}
{{--        width: 100%;--}}
{{--        height: 100%;--}}
{{--        object-fit: cover;--}}
{{--    }--}}

{{--    @media (max-width: 768px) {--}}
{{--        .modal-dialog.modal-lg {--}}
{{--            margin: 0.5rem auto;--}}
{{--            max-width: calc(100% - 1rem);--}}
{{--            width: calc(100% - 1rem);--}}
{{--        }--}}

{{--        .images-wrapper {--}}
{{--            flex-direction: row;--}}
{{--            justify-content: center;--}}
{{--            gap: 10px;--}}
{{--            padding: 0 5px;--}}
{{--        }--}}

{{--        .image-container {--}}
{{--            flex: 0 1 calc(50% - 5px);--}}
{{--            max-width: none;--}}
{{--        }--}}

{{--        .image-box {--}}
{{--            width: 100%;--}}
{{--            height: 0;--}}
{{--            padding-bottom: 120%;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .image-box img {--}}
{{--            position: absolute;--}}
{{--            top: 0;--}}
{{--            left: 0;--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            object-fit: cover;--}}
{{--        }--}}

{{--        .image-container h6 {--}}
{{--            font-size: 0.9rem;--}}
{{--            padding: 6px 12px;--}}
{{--            width: 90%;--}}
{{--        }--}}

{{--        .modal-header h5 {--}}
{{--            font-size: 1rem;--}}
{{--        }--}}

{{--        .modal-header h3 {--}}
{{--            font-size: 1.4rem;--}}
{{--        }--}}
{{--    }--}}

{{--    @media (max-width: 320px) {--}}
{{--        .images-wrapper {--}}
{{--            gap: 5px;--}}
{{--        }--}}

{{--        .image-container h6 {--}}
{{--            font-size: 0.8rem;--}}
{{--            padding: 5px 10px;--}}
{{--            width: 85%;--}}
{{--        }--}}

{{--        .image-box {--}}
{{--            padding-bottom: 130%;--}}
{{--        }--}}
{{--    }--}}
{{--</style>--}}

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        const modalElement = document.getElementById('popupModal');--}}

{{--        if (modalElement) {--}}
{{--            const popupModal = new bootstrap.Modal(modalElement, {--}}
{{--                backdrop: true,--}}
{{--                keyboard: true--}}
{{--            });--}}

{{--            setTimeout(() => {--}}
{{--                popupModal.show();--}}
{{--            }, 300);--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
