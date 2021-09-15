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
            'name' => 'required|string|max:100',
            'username' => 'required|string|alpha_dash|max:25|unique:users,username,' . $user->id,
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'no_hp' => 'nullable|string|min:10|max:15|starts_with:08,62,+62',
            'alamat' => 'nullable|string|max:300',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images/avatars', 'public');
            Storage::disk('public')->delete($user->foto);
        }

        $user->update($validated);

        return back()->withSuccess('Profil Anda berhasil diubah');
    }

    public  function password()
    {
        return view('accounts.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:3|max:12|confirmed',
        ]);

        $user = auth()->user();
        $user->update(['password' => Hash::make($request->password)]);

        return back()->withSuccess('Password Anda berhasil diubah');
    }
}
