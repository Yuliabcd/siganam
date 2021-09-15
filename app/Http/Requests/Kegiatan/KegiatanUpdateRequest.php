<?php

namespace App\Http\Requests\Kegiatan;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole(['admin', 'user']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'tempat' => 'required|string|max:300',
            'tanggal' => 'required|date_format:Y-m-d|before_or_equal:' . date('Y-m-d'),
            'jam' => 'nullable|date_format:H:i',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'keterangan' => 'string|nullable|max:500'
        ];
    }
}
