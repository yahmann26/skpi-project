<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);

        //cek mahasiswa atau user sudah ada by nim dan uid
        $existingMahasiswa = Mahasiswa::where('nim', $row['nim'])->first();
        $existingUser = User::where('uid', $row['uid'])->first();

        if ($existingMahasiswa || $existingUser) {
            Log::info("Data sudah ada, skip import: ", $row);
            return null;
        }

        // Cari program studi berdasarkan nama
        $prodi = ProgramStudi::where('nama', $row['prodi'])->first();
        if (!$prodi) {
            Log::error('Prodi tidak ditemukan: ', $row);
            return null;
        }

        $password = isset($row['password']) ? $row['password'] : 'default_password';

        // tambah user baru
        $user = User::create([
            'uid' => $row['uid'],
            'email' => $row['email'],
            'password' => Hash::make($password),
            'role' => $row['role'],
        ]);

        // Konversi tanggal
        $tglLahir = $this->convertToDateFormat($row['tgl_lahir']);
        $tglMasuk = isset($row['tgl_masuk']) ? $this->convertToDateFormat($row['tgl_masuk']) : null;
        $tglLulus = isset($row['tgl_lulus']) ? $this->convertToDateFormat($row['tgl_lulus']) : null;

        // tambah data ke tabel mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tgl_lahir' => $tglLahir,
            'jenis_kelamin' => $row['jenis_kelamin'],
            'program_studi_id' => $prodi->id,
            'tgl_masuk' => $tglMasuk,
            'tgl_lulus' => $tglLulus,
            'no_ijazah' => $row['no_ijazah'] ?? null,
            'jenis_pendaftaran' => $row['jenis_pendaftaran'] ?? null,
            'jenis_pendaftaran_en' => $row['jenis_pendaftaran_en'],
        ]);

        return $user;
    }

    private function convertToDateFormat($date)
    {
        // Jika tanggal kosong, kembalikan nilai default
        if (!$date) {
            return null;
        }

        // Jika tanggal dalam bentuk angka serial Excel
        if (is_numeric($date)) {
            try {
                // Mengonversi angka serial Excel ke tanggal
                return Carbon::createFromTimestamp(($date - 25569) * 86400)->format('Y-m-d');
            } catch (\Exception $e) {
                Log::error("Error converting Excel serial date: $date. Error: " . $e->getMessage());
                return null;
            }
        }

        // Jika tanggal dalam format string biasa (misalnya 'd/m/Y')
        try {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::error("Error converting date: $date. Error: " . $e->getMessage());
            return null;
        }
    }
}
