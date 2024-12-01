<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'logo' => 'required|image|mimes:png|dimensions:min_width=100,min_height=100|max:2048',
            'website' => 'required|url|max:255',
        ];
    }

    /**
     * Pesan validasi khusus (opsional).
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama perusahaan wajib diisi.',
            'email.required' => 'Email perusahaan wajib diisi.',
            'logo.required' => 'Logo perusahaan wajib diupload.',
            'logo.dimensions' => 'Logo harus memiliki ukuran minimal 100x100 piksel.',
            'logo.max' => 'Ukuran logo maksimal 2 MB.',
            'website.required' => 'Website perusahaan wajib diisi.',
        ];
    }
}
