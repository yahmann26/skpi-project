<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdiRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'kode_prodi' => 'required|unique:prodi,kode_prodi',
            'nama_prodi' => 'required|unique:prodi,nama_prodi',
            'bahasa_pengantar_kuliah' => 'required',
            'akreditasi' => 'required',
            'sk_akreditasi' => 'required',
            'sistem_penilaian' => 'required',
            'gelar' => 'required',
            'jenis_program_pendidikan' => 'required',
            'jenjang_lanjutan' => 'required',
            'kualifikasi_kkni' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'kode_prodi.required' => 'Kode Prodi wajib diisi',
            'kode_prodi.unique' => 'Kode Prodi sudah ada ',
            'nama_prodi.required' => 'Nama Prodi wajib diisi',
            'nama_prodi.unique' => 'Nama Prodi sudah ada',
            'bahasa_pengantar_kuliah.required' => 'Bahasa Pengantar Kuliah wajib diisi',
            'akreditasi.required' => 'Akreditasi wajib diisi',
            'sk_akreditasi.required' => 'SK Akreditasi wajib diisi',
            'sistem_penilaian.required' => 'Sistem Penilaian wajib diisi',
            'gelar.required' => 'Gelar wajib diisi',
            'jenis_program_pendidikan.required' => 'Jenis & Program Pendidikan wajib diisi',
            'jenjang_lanjutan.required' => 'Jenis & Jenjang Lanjutan wajib diisi',
            'kualifikasi_kkni.required' => 'Kualifikasi KKNI wajib diisi',
        ];
        return $messages;
    }
}
