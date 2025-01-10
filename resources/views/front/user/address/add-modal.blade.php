<!-- resources/views/components/add-address-modal.blade.php -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAddressForm" action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="receiverName" class="form-label address-label">Receiver Name</label>
                        <input type="text" class="form-control address-input" id="receiverName" name="receiver_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label address-label">Phone Number</label>
                        <input type="text" class="form-control address-input" id="phoneNumber" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="zipCode" class="form-label address-label">Zip Code</label>
                        <input type="text" class="form-control address-input" id="zipCode" name="zip_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label address-label">District</label>
                        <input type="text" class="form-control address-input" id="district" name="district" required>
                    </div>
                    <button type="submit" class="btn btn-save-address w-100">Save Address</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-header {
        border-bottom: none;
        margin-top: 20px;
    }

    .modal-content {
        border-radius: 15px;
    }

    .modal-title {
        font-size: 20px;
        color: #a3907a;
    }
    .address-label {
        color: #a3907a;
    }
    .address-input {
        border-radius: 20px;
    }
    .btn-save-address {
        background-color: #ffffff;
        border: 1px solid #a3907a;
        color: #a3907a;
        width: 180px !important;
    }
</style>

