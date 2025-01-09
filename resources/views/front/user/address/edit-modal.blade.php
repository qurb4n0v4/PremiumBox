<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAddressForm" action="{{ route('addresses.update', $address->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="receiverName" class="form-label address-label">Receiver Name</label>
                        <input type="text" class="form-control address-input" id="receiverName" name="receiver_name" required value="{{ old('receiver_name', $address->receiver_name) }}">                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label address-label">Phone Number</label>
                        <input type="text" class="form-control address-input" id="phoneNumber" name="phone_number" required value="{{ old('phone_number', $address->phone_number) }}">
                    </div>
                    <div class="mb-3">
                        <label for="zipCode" class="form-label address-label">Zip Code</label>
                        <input type="text" class="form-control address-input" id="zipCode" name="zip_code" required value="{{ old('zip_code', $address->zip_code) }}">
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label address-label">District</label>
                        <input type="text" class="form-control address-input" id="district" name="district" required value="{{ old('district', $address->district) }}">
                    </div>
                    <button type="submit" class="btn btn-save-address w-100">Save Changes</button>
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
