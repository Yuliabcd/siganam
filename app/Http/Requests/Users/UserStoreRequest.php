<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'username' => 'required|string|alpha_dash|max:25|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:3|max:12',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'no_hp' => 'nullable|string|starts_with:08,62,+62|min:10|max:15',
            'alamat' => 'nullable|string|max:300',
            'role' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nama',
            'no_hp' => 'No. Hp/WhatsApp'
        ];
    }
}
