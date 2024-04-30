<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'prodi_id' => 'required',
            'tgl_masuk' => 'required|date',
            'tgl_lulus' => 'required|date',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM Hanya Angka',
            'nim.unique' => 'NIM sudah ada ',
            'nama_mahasiswa.required' => 'Nama Mahasiswa wajib diisi',
            'tempat_lahir.required' => 'Tempat_lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Dipilih',
            'prodi_id.required' => 'Prodi Wajib Dipilih',
            'tgl_masuk.required' => 'Tanggal Masuk wajib diisi',
            'tgl_lulus.required' => 'Tanggal Lulus wajib diisi',
        ];
        return $messages;
    }
}
