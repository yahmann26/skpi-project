<?php

namespace App\Imports;

use App\Models\JenisPendaftaran;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MahasiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip baris pertama (header)
        static $rowNumber = 1;
        $rowNumber++;

        if ($rowNumber <= 4) {
            return null; // Jangan proses header
        }

        // dd($row[6]);
        if (
            !empty($row[1])
            or !empty($row[2])
            or !empty($row[3])
            or !empty($row[4])
            or !empty($row[5])
            or !empty($row[6])
            or !empty($row[7])
            or !empty($row[8])
            or !empty($row[9])

        ) {
            //cek mahasiswa atau user sudah ada by nim dan uid
            $existingMahasiswa = Mahasiswa::where('nim', $row[1])->first();
            $existingUser = User::where('uid', $row[1])->first();

            if ($existingMahasiswa || $existingUser) {
                Log::info("Data sudah ada, skip import: ", $row);
                return null;
            }

            // Cari program studi berdasarkan nama
            $prodi = ProgramStudi::where('nama', $row[7])->first();
            if (!$prodi) {
                Log::error('Prodi tidak ditemukan: ', $row);
                return null;
            }

            $jenisPendaftaran = JenisPendaftaran::where('nama', $row[9])->first();
            if (!$jenisPendaftaran) {
                Log::error('Jenis Pendaftaran tidak ditemukan: ', $row);
                return null;
            }
            // dd($prodi);

            $password = isset($row[1]) ? $row[1] : 'default_password';

            // tambah user baru
            $user = User::create([
                'uid' => $row[1],
                'email' => $row[2],
                'password' => Hash::make($password),
                'role' => 'mahasiswa',
            ]);

            // Konversi tanggal
            $tglLahir = $this->convertToDateFormat($row[5]);
            $tglMasuk = isset($row[8]) ? $this->convertToDateFormat($row[8]) : null;

            // tambah data ke tabel mahasiswa
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $row[1],
                'nama' => $row[3],
                'tempat_lahir' => $row[4],
                'tgl_lahir' => $tglLahir,
                'jenis_kelamin' => $row[6],
                'program_studi_id' => $prodi->id,
                'tgl_masuk' => $tglMasuk,
                'jenis_pendaftaran_id' => $jenisPendaftaran->id,
            ]);

            return $user;
        }
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
