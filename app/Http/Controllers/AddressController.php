<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('front.user.addresses', compact('addresses'));
    }

    public function edit(Address $address)
    {
        // Sadece kendi adreslerini düzenleyebilir
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }
        return view('front.user.address', compact('address'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'receiver_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'zip_code' => 'required|string|max:10',
                'district' => 'required|string|max:255',
            ]);

            Auth::user()->addresses()->create(array_merge(
                $request->all(),
                ['user_name' => Auth::user()->name] // Kullanıcı adını ekler
            ));

            return redirect()->back()->with('success', 'Address added successfully.');
        } catch (\Exception $e) {
            Log::error('Address creation failed: ' . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while adding the address.');
        }
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            $request->validate([
                'receiver_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'zip_code' => 'required|string|max:10',
                'district' => 'required|string|max:255',
            ]);

            // Adresi güncelle
            $updated = $address->update([
                'receiver_name' => $request->input('receiver_name'),
                'phone_number' => $request->input('phone_number'),
                'zip_code' => $request->input('zip_code'),
                'district' => $request->input('district'),
                'user_name' => Auth::user()->name, // Kullanıcı adını ekle
            ]);

            if ($updated) {
                return redirect()->back()->with('success', 'Address updated successfully.');
            } else {
                Log::error('Address update failed: No changes detected.', [
                    'address_id' => $address->id,
                    'user_id' => Auth::id(),
                    'input' => $request->all(),
                ]);
                return redirect()->back()->with('error', 'Address update failed.');
            }
        } catch (\Exception $e) {
            Log::error('Address update error: ' . $e->getMessage(), [
                'address_id' => $address->id,
                'user_id' => Auth::id(),
                'input' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while updating the address.');
        }
    }

    public function destroy(Address $address)
    {
        if (!$address) {
            return redirect()->back()->with('error', 'Address not found.');
        }

        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();
        return redirect()->back()->with('success', 'Address deleted successfully.');
    }
}
