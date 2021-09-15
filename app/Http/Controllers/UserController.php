<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
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
            'users' => User::latest()->paginate(10)
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
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images/avatars', 'public');
        }

        $user = User::create($validated);

        if ($request->filled('role') && $role = Role::findById($request->role)) {
            $user->assignRole($role);
        }

        return  redirect()->route('users.index')->withSuccess('Berhasil menambahkan pengguna');
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
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        $validated['password'] = $request->has('password') && $request->filled('password') ?
            Hash::make($request->password) : $user->password;;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images/avatars', 'public');
            Storage::disk('public')->delete($user->foto);
        }

        $user->update($validated);

        if ($request->has('role_id') && $request->filled('role_id')) {
            $user->syncRoles($request->role_id);
        }

        return back()->withSuccess('Pengguna berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::disk('public')->delete($user->avatar);
        $user->delete();

        return back()->withSuccess('Pengguna berhasil dihapus');
    }
}
