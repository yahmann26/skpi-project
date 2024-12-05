<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Skpi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {

        $dataPengaturan = [
            'nama_aplikasi' => Skpi::getSettingByName('nama_aplikasi'),
            'logo_aplikasi' => Skpi::getSettingByName('logo_aplikasi'),
            'logo_aplikasi_url' => '',

            'logo_universitas' => Skpi::getSettingByName('logo_universitas'),
            'logo_universitas_url' => '',
            'nama_universitas' => Skpi::getSettingByName('nama_universitas'),
            'nama_universitas_en' => Skpi::getSettingByName('nama_universitas_en'),
            'nama_universitas_singkat' => Skpi::getSettingByName('nama_universitas_singkat'),
            'fax' => Skpi::getSettingByName('fax'),
            'website' => Skpi::getSettingByName('website'),
            'alamat_universitas' => Skpi::getSettingByName('alamat_universitas'),
            'email_universitas' => Skpi::getSettingByName('email_universitas'),
            'telepon_universitas' => Skpi::getSettingByName('telepon_universitas'),
            'jenis_pendidikan' => Skpi::getSettingByName('jenis_pendidikan'),
            'jenis_pendidikan_en' => Skpi::getSettingByName('jenis_pendidikan_en'),

            'tahun_kurikulum' => Skpi::getSettingByName('tahun_kurikulum'),

            'nama_penandatangan' => Skpi::getSettingByName('nama_penandatangan'),
            'nip_penandatangan' => Skpi::getSettingByName('nip_penandatangan'),
            'jabatan_penandatangan' => Skpi::getSettingByName('jabatan_penandatangan'),
            'gambar_tandatangan_cap' => Skpi::getSettingByName('gambar_tandatangan_cap'),
        ];

        $dataPengaturan['logo_aplikasi_url'] = '';
        if (isset($dataPengaturan['logo_aplikasi']) && $dataPengaturan['logo_aplikasi'] != '') {
            // $dataPengaturan['logo_aplikasi_url'] = asset('storage/' . $dataPengaturan['logo_aplikasi']);
            $dataPengaturan['logo_aplikasi_url'] = Skpi::getAssetUrl($dataPengaturan['logo_aplikasi']);
        }

        $dataPengaturan['logo_universitas_url'] = '';
        if (isset($dataPengaturan['logo_universitas']) && $dataPengaturan['logo_universitas'] != '') {
            // $dataPengaturan['logo_universitas_url'] = asset('storage/' . $dataPengaturan['logo_universitas']);
            $dataPengaturan['logo_universitas_url'] = Skpi::getAssetUrl($dataPengaturan['logo_universitas']);
        }

        $dataPengaturan['gambar_tandatangan_cap_url'] = '';
        if (isset($dataPengaturan['gambar_tandatangan_cap']) && $dataPengaturan['gambar_tandatangan_cap'] != '') {
            $dataPengaturan['gambar_tandatangan_cap_url'] = Skpi::getAssetUrl($dataPengaturan['gambar_tandatangan_cap']);
        }


        // dd($dataPengaturan);

        return view('admin.pages.pengaturan.index', [
            'pengaturan' => $dataPengaturan
        ]);
    }

    public function update(Request $request)
    {

        $category = $request->input('category');

        if ($category == 'dasar') {
            return $this->__updateDasar($request);
        } else if ($category == 'universitas') {
            return $this->__updateuniversitas($request);
        } else if ($category == 'kurikulum') {
            return $this->__updateKurikulum($request);
        } else if ($category == 'tandatangan') {
            return $this->__updateTandatangan($request);
        }

        return redirect()->route('admin.pengaturan.index')->with('error', 'Kategori pengaturan tidak ditemukan');
    }

    private function __updateDasar(Request $request)
    {
        $request->validate([
            'nama_aplikasi' => 'required',
            'logo_aplikasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'logo_aplikasi_url' => [
                'nullable',
                // 'url'
                // must valid url if logo_aplikasi is null
                function ($attribute, $value, $fail) use ($request) {
                    $logoAplikasi = $request->file('logo_aplikasi');
                    if (!isset($logoAplikasi) && !filter_var($value, FILTER_VALIDATE_URL)) {
                        $fail('Logo aplikasi harus berupa url yang valid');
                    }
                }
            ]
        ]);

        // dd($request->all());

        $namaAplikasi = $request->input('nama_aplikasi');
        $logoAplikasi = $request->file('logo_aplikasi');

        $dataPengaturan = [
            'nama_aplikasi' => $namaAplikasi,
            'logo_aplikasi' => Skpi::getSettingByName('logo_aplikasi'),
        ];

        if (isset($logoAplikasi)) {
            // delete old logo
            if (isset($dataPengaturan['logo_aplikasi']) && $dataPengaturan['logo_aplikasi'] != '') {
                if (Storage::exists('public/'.$dataPengaturan['logo_aplikasi'])) {
                    Storage::delete('public/'.$dataPengaturan['logo_aplikasi']);
                }
            }

            $namaFile = time() . '.' . $logoAplikasi->getClientOriginalExtension();
            $filePath = $logoAplikasi->storeAs('settings', $namaFile, 'public');
            $dataPengaturan['logo_aplikasi'] = $filePath;
        }

        foreach ($dataPengaturan as $key => $value) {
            Skpi::updateSettingByName($key, $value);
        }

        return redirect()->route('admin.pengaturan.index', ['tab' => 'dasar'])->with('success', 'Pengaturan Dasar berhasil diperbarui');
    }

    private function __updateuniversitas(Request $request)
    {
        $request->validate([
            'nama_universitas' => 'required',
            'nama_universitas_en' => 'required',
            'nama_universitas_singkat' => 'required',
            'alamat_universitas' => 'required',
            'email_universitas' => 'required',
            'telepon_universitas' => 'required',
            'fax' => 'required',
            'website' => 'required',
            'jenis_pendidikan' => 'required',
            'jenis_pendidikan_en' => 'required',
            'logo_universitas' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'logo_universitas_url' => [
                'nullable',
                // 'url'
                // must valid url if logo_aplikasi is null
                function ($attribute, $value, $fail) use ($request) {
                    $logouniversitas = $request->file('logo_universitas');
                    if (!isset($logouniversitas) && !filter_var($value, FILTER_VALIDATE_URL)) {
                        $fail('Logo universitas harus berupa url yang valid');
                    }
                }
            ]
        ]);

        // dd($request->all());

        $namauniversitas = $request->input('nama_universitas');
        $namauniversitasEn = $request->input('nama_universitas_en');
        $namauniversitasSingkat = $request->input('nama_universitas_singkat');
        $alamatuniversitas = $request->input('alamat_universitas');
        $emailuniversitas = $request->input('email_universitas');
        $teleponuniversitas = $request->input('telepon_universitas');
        $fax = $request->input('fax');
        $website = $request->input('website');
        $jenisPendidikan = $request->input('jenis_pendidikan');
        $jenisPendidikanEn = $request->input('jenis_pendidikan_en');
        $logouniversitas = $request->file('logo_universitas');

        $dataPengaturan = [
            'nama_universitas' => $namauniversitas,
            'nama_universitas_en' => $namauniversitasEn,
            'nama_universitas_singkat' => $namauniversitasSingkat,
            'alamat_universitas' => $alamatuniversitas,
            'email_universitas' => $emailuniversitas,
            'telepon_universitas' => $teleponuniversitas,
            'fax' => $fax,
            'website' => $website,
            'jenis_pendidikan' => $jenisPendidikan,
            'jenis_pendidikan_en' => $jenisPendidikanEn,
            'logo_universitas' => Skpi::getSettingByName('logo_universitas'),
        ];

        if (isset($logouniversitas)) {
            // delete old logo
            if (isset($dataPengaturan['logo_universitas']) && $dataPengaturan['logo_universitas'] != '') {
                if (Storage::exists('public/'.$dataPengaturan['logo_universitas'])) {
                    Storage::delete('public/'.$dataPengaturan['logo_universitas']);
                }
            }

            $namaFile = time() . '.' . $logouniversitas->getClientOriginalExtension();
            $filePath = $logouniversitas->storeAs('settings', $namaFile, 'public');
            $dataPengaturan['logo_universitas'] = $filePath;
        }

        foreach ($dataPengaturan as $key => $value) {
            Skpi::updateSettingByName($key, $value);
        }

        return redirect()->route('admin.pengaturan.index', ['tab' => 'universitas'])->with('success', 'Pengaturan Universitas berhasil diperbarui');
    }

    private function __updateKurikulum(Request $request)
    {
        $request->validate([
            'tahun_kurikulum' => 'required|numeric|min:2010|max:' . (date('Y') + 1),
        ]);

        $tahunKurikulum = $request->input('tahun_kurikulum');

        $dataPengaturan = [
            'tahun_kurikulum' => $tahunKurikulum,
        ];

        foreach ($dataPengaturan as $key => $value) {
            Skpi::updateSettingByName($key, $value);
        }

        return redirect()->route('admin.pengaturan.index', ['tab' => 'kurikulum'])->with('success', 'Pengaturan kurikulum berhasil diperbarui');
    }

    private function __updateTandatangan(Request $request)
    {
        $request->validate([
            'nama_penandatangan' => 'required',
            'nip_penandatangan' => 'required|numeric',
            'jabatan_penandatangan' => 'required',
            'gambar_tandatangan_cap' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'gambar_tandatangan_cap_url' => [
                'nullable',
                // 'url'
                // must valid url if logo_aplikasi is null
                function ($attribute, $value, $fail) use ($request) {
                    $logouniversitas = $request->file('gambar_tandatangan_cap');
                    if (!isset($logouniversitas) && !filter_var($value, FILTER_VALIDATE_URL)) {
                        $fail('Gambar tandatangan bercap harus berupa url yang valid');
                    }
                }
            ]
        ]);

        $namaPenandatangan = $request->input('nama_penandatangan');
        $nipPenandatangan = $request->input('nip_penandatangan');
        $jabatanPenandatangan = $request->input('jabatan_penandatangan');
        $gambarTandatanganCap = $request->file('gambar_tandatangan_cap');

        $dataPengaturan = [
            'nama_penandatangan' => $namaPenandatangan,
            'nip_penandatangan' => $nipPenandatangan,
            'jabatan_penandatangan' => $jabatanPenandatangan,
            'gambar_tandatangan_cap' => Skpi::getSettingByName('gambar_tandatangan_cap'),
        ];

        if (isset($gambarTandatanganCap)) {
            // delete old logo
            if (isset($dataPengaturan['gambar_tandatangan_cap']) && $dataPengaturan['gambar_tandatangan_cap'] != '') {
                if (Storage::exists('public/'.$dataPengaturan['gambar_tandatangan_cap'])) {
                    Storage::delete('public/'.$dataPengaturan['gambar_tandatangan_cap']);
                }
            }

            $namaFile = time() . '.' . $gambarTandatanganCap->getClientOriginalExtension();
            $filePath = $gambarTandatanganCap->storeAs('settings', $namaFile, 'public');
            $dataPengaturan['gambar_tandatangan_cap'] = $filePath;
        }

        foreach ($dataPengaturan as $key => $value) {
            Skpi::updateSettingByName($key, $value);
        }

        return redirect()->route('admin.pengaturan.index', ['tab' => 'tandatangan'])->with('success', 'Pengaturan Tandatangan berhasil diperbarui');
    }
}
