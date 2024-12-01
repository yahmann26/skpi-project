<?php

namespace App\Imports;

use App\Models\Skpi;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SkpiImport implements ToModel, WithHeadingRow
{
    protected $periodeId;

    public function __construct($periodeId)
    {
        $this->periodeId = $periodeId;
    }

    public function model(array $row)
    {
        static $rowNumber = 1;
        $rowNumber++;

        if ($rowNumber <= 3) {
            return null;
        }
        
        if (!empty($row[1]) || !empty($row[2])) {
            //cek nim
            $mahasiswa = Mahasiswa::where('nim', $row[1])->first();

            if ($mahasiswa) {
                // Cek apakah SKPI sudah ada di db SKPI
                $existingSkpi = Skpi::where('mahasiswa_id', $mahasiswa->id)->first();

                if ($existingSkpi) {
                    Log::warning("SKPI untuk Mahasiswa dengan NIM {$row[1]} sudah ada. Impor dibatalkan.");
                    return null;
                }

                Skpi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'periode_id' => $this->periodeId,
                    'nomor' => $row[2],
                ]);
            } else {
                Log::warning("Mahasiswa dengan NIM {$row[1]} tidak ditemukan.");
                return null;
            }
        }
    }
}
