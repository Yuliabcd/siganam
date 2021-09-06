<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function profile()
    {
        return view('accounts.profile')->with(['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $this->validate($request, [
            'name' => ['string', 'required', 'max:50'],
            'username' => ['string', 'alpha_dash', 'required', 'max:20', 'unique:users,username,' . $user->id],
            'email' => ['email', 'required', 'max:50', 'unique:users,email,' . $user->id],
            'foto' => ['file', 'mimes:jpg,jpeg,png', 'nullable', 'max:1000'],
            'no_hp' => ['string', 'nullable', 'max:15', 'starts_with:08,62,+62'],
            'alamat' => ['string', 'nullable', 'max:500'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images', 'public');
            Storage::disk('public')->delete($user->foto);
        }

        $user->update($validated);

        return back()->with('success', 'Profil Anda berhasil diubah');
    }

    public  function password()
    {
        return view('accounts.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['string', 'required', 'min:3', 'max:12', 'confirmed'],
        ]);

        $user = auth()->user();
        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password Anda berhasil diubah');
    }
}
