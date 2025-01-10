@extends('front.user.profile')

@section('profile-content')
    <div class="container address-container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-8 col-md-10">
                <h5 class="mb-0">Ünvanlarım</h5>
            </div>
            <div class="col-4 col-md-2 text-end">
                <button class="btn-add-address" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="row address-body">
            <div class="col-12">
                @forelse($addresses as $address)
                    <div class="card mb-3 p-3">
                        <h6 class="mb-1" style="color: #a3907a;">{{ $address->receiver_name }}</h6>
                        <p class="mb-1" style="color: #898989;"><strong style="color: #a3907a;">Phone:</strong> {{ $address->phone_number }}</p>
                        <p class="mb-1" style="color: #898989;"><strong style="color: #a3907a;">Zip Code:</strong> {{ $address->zip_code }}</p>
                        <p class="mb-1" style="color: #898989;"><strong style="color: #a3907a;">District:</strong> {{ $address->district }}</p>
                        <div class="text-end">
                            <button class="btn btn-sm btn-edit-address me-2" data-bs-toggle="modal" data-bs-target="#editAddressModal-{{ $address->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('addresses.destroy', $address->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete-address">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="color: #898989;">No addresses found. Please add a new address.</p>
                @endforelse
            </div>
        </div>
    </div>
    @include('front.user.address.add-modal')
    @include('front.user.address.edit-modal')
@endsection
<style>
    .address-container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
    }

    h5 {
        font-size: 20px;
        color: #a3907a !important;
    }

    .btn-add-address {
        background-color: #ffffff;
        color: #a3907a;
        border: none;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-add-address:hover {
        background-color: #a3907a;
        color: #ffffff;
    }
    .btn-edit-address, .btn-delete-address {
        color: #a3907a !important;
    }
</style>
