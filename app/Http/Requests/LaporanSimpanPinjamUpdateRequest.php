<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanSimpanPinjamUpdateRequest extends FormRequest
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
            'saldo_awal' => 'nullable|numeric',
            'tabungan' => 'nullable|numeric',
            'jasa' => 'nullable|numeric',
            'angsuran' => 'nullable|numeric',
            'denda' => 'nullable|numeric',
            'piutang' => 'nullable|numeric',
            'saldo_akhir' => 'nullable|numeric'
        ];
    }
}
