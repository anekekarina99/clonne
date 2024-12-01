<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk melakukan request ini.
     */
    public function authorize()
    {
        return true; // Set ke true agar semua pengguna diizinkan
    }

    /**
     * Aturan validasi untuk request ini.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    /**
     * Pesan validasi khusus (opsional).
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama karyawan wajib diisi.',
            'email.required' => 'Email karyawan wajib diisi.',
            'company_id.required' => 'Perusahaan harus dipilih.',
            'company_id.exists' => 'Perusahaan yang dipilih tidak valid.',
        ];
    }
}
