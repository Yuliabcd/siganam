<?php

namespace App\Http\Requests\LaporanPengurus;

use Illuminate\Foundation\Http\FormRequest;

class LaporanPengurusStoreRequest extends FormRequest
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
            'laporan_id' => 'required|numeric|exists:laporan,id',
            'pengurus_id' => 'required|numeric|exists:pengurus,id',
            'saldo_awal'  => 'nullable|numeric',
            'keluar'  => 'nullable|numeric',
            'masuk'  => 'nullable|numeric',
            'saldo_akhir'  => 'nullable|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'laporan_id' => 'laporan',
            'pengurus_id' => 'pengurus'
        ];
    }
}
