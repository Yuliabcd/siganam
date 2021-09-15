<?php

namespace App\Http\Requests\Pengurus;

use Illuminate\Foundation\Http\FormRequest;

class PengurusStoreRequest extends FormRequest
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
            'posisi_id' => 'required|numeric|exists:posisi,id',
            'nama' => 'required|string|max:100',
            'nama_panggilan' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:l,p',
            'email' => 'nullable|email|max:100',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'no_hp' => 'nullable|string|min:10|max:15|starts_with:08,62,+62',
            'alamat' => 'string|nullable|max:300',
        ];
    }

    public function attributes()
    {
        return [
            'posisi_id' => 'posisi',
            'no_hp' => 'No. Hp/WhatsApp'
        ];
    }
}
