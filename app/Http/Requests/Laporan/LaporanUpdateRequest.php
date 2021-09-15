<?php

namespace App\Http\Requests\Laporan;

use Illuminate\Foundation\Http\FormRequest;

class LaporanUpdateRequest extends FormRequest
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
            'tanggal' => 'required|date_format:Y-m-d|before_or_equal:' . date('Y-m-d'),
            'tempat' => 'required|string|max:300',
            'informasi' => 'nullable|string',
            'serap_info' => 'nullable|string'
        ];
    }
}
