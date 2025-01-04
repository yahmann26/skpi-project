<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Skpi;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SkpiImport implements ToModel, WithHeadingRow
{
    protected $periodeId;
    protected $prodiId;

    public function __construct($periodeId, $prodiId = null)
    {
        $this->periodeId = $periodeId;
        $this->prodiId = $prodiId;
    }

    // Menentukan baris mulai pembacaan
    public function startRow(): int
    {
        return 4;
    }

    // Validasi baris
    public function rules(): array
    {
        return [
            '1' => 'required|exists:mahasiswas,nim', // Validasi NIM
            '2' => 'required', // Validasi nomor SKPI
            '3' => 'required', // Validasi no Ijazah
        ];
    }

    // Pemrosesan data per baris
    public function model(array $row)
    {
        static $rowNumber = 1;
        $rowNumber++;

        if ($rowNumber <= 3) {
            return null;
        }

        if (!empty($row[1]) || !empty($row[2]) || !empty($row[3]) || !empty($row[4])) {
            // Cek NIM
            $mahasiswa = Mahasiswa::where('nim', $row[1])->first();

            if ($mahasiswa) {
                // Jika Kaprodi, filter berdasarkan prodi
                if ($this->prodiId && $mahasiswa->program_studi_id != $this->prodiId) {
                    return null; // Jika program studi tidak cocok, lewati baris
                }

                // Cek apakah SKPI sudah ada di DB
                $existingSkpi = Skpi::where('mahasiswa_id', $mahasiswa->id)
                    ->where('periode_id', $this->periodeId)
                    ->first();

                if ($existingSkpi) {
                    Log::warning("SKPI untuk Mahasiswa dengan NIM {$row[1]} sudah ada. Impor dibatalkan.");
                    return null;
                }

                // Convert tanggal lulus jika ada
                $tglLulus = isset($row[4]) ? $this->convertToDateFormat($row[4]) : null;

                // Simpan data SKPI
                Skpi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'periode_id' => $this->periodeId,
                    'nomor' => $row[2],
                    'no_ijazah' => $row[3],
                    'tgl_lulus' => $tglLulus,
                ]);
            } else {
                Log::warning("Mahasiswa dengan NIM {$row[1]} tidak ditemukan.");
                return null;
            }
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
