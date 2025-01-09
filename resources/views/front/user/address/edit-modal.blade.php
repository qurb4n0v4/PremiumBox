@foreach ($addresses as $address)
    <div class="modal fade" id="editAddressModal-{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel-{{ $address->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAddressModalLabel-{{ $address->id }}">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAddressForm-{{ $address->id }}" action="{{ route('addresses.update', $address->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="receiverName-{{ $address->id }}" class="form-label">Receiver Name</label>
                            <input type="text" class="form-control" id="receiverName-{{ $address->id }}" name="receiver_name" value="{{ $address->receiver_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber-{{ $address->id }}" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber-{{ $address->id }}" name="phone_number" value="{{ $address->phone_number }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="zipCode-{{ $address->id }}" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zipCode-{{ $address->id }}" name="zip_code" value="{{ $address->zip_code }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="district-{{ $address->id }}" class="form-label">District</label>
                            <input type="text" class="form-control" id="district-{{ $address->id }}" name="district" value="{{ $address->district }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
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
