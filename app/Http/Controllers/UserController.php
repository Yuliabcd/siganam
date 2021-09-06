<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with([
            'users' => User::latest()->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create')->with([
            'roles' => Role::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => ['string', 'required', 'max:50'],
            'username' => ['string', 'alpha_dash', 'required', 'max:20', 'unique:users,username'],
            'email' => ['email', 'required', 'max:50', 'unique:users,email'],
            'password' => ['string', 'required', 'min:3', 'max:12'],
            'foto' => ['file', 'mimes:jpg,jpeg,png', 'nullable', 'max:1000'],
            'no_hp' => ['string', 'nullable', 'max:15', 'starts_with:08,62,+62'],
            'alamat' => ['string', 'nullable', 'max:500'],
            'role' => ['required']
        ]);

        $validated['password'] = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images', 'public');
        }

        $user = User::create($validated);

        if (!empty($request->role) && $role = Role::findById($request->role)) {
            $user->assignRole($role);
        }

        return  redirect()->route('users.index')->with('success', 'Berhasil menambahkan pengguna');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $this->validate($request, [
            'name' => ['string', 'required', 'max:50'],
            'username' => ['string', 'alpha_dash', 'required', 'max:20', 'unique:users,username,' . $user->id],
            'email' => ['email', 'required', 'max:50', 'unique:users,email,' . $user->id],
            'password' => ['string', 'nullable', 'max:12'],
            'foto' => ['file', 'mimes:jpg,jpeg,png', 'nullable', 'max:1000'],
            'no_hp' => ['string', 'nullable', 'max:15', 'starts_with:08,62,+62'],
            'alamat' => ['string', 'nullable', 'max:500'],
            'role_id' => ['required']
        ]);

        if ($request->has('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images', 'public');
            Storage::disk('public')->delete($user->foto);
        }

        $user->update($validated);

        if ($request->get('role_id')) {
            $user->syncRoles($request->get('role_id'));
        }

        return back()->with('success', 'Pengguna berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::disk('public');
        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus');
    }
}