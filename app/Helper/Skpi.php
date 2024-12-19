<?php

namespace App\Helper;

use Carbon\Carbon;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Storage;

class Skpi
{

    static function getSettingByName($name)
    {
        $setting = Pengaturan::where('nama', $name)->first();
        if (!$setting) {
            return null;
        }

        $settingType = $setting->tipe;
        $settingValue = $setting->nilai ?? '';

        if ($settingType == 'json') {
            $settingValue = json_decode($settingValue);
        }

        return $settingValue;
    }

    static function updateSettingByName($name, $value)
    {
        $setting = Pengaturan::where('nama', $name)->first();
        if (!$setting) {
            return null;
        }

        $settingType = $setting->tipe;

        if ($settingType == 'json') {
            $value = json_encode($value);
        }

        $setting->update([
            'nilai' => $value
        ]);

        return $setting;
    }

    static function getAssetUrl($path)
    {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        if (Storage::exists('public/' . $path)) {
            return url('storage/' . $path);
        }

        return asset($path);
    }



    /**
     * @param $date
     * @return false|string
     * @example 2021-10-29 -> 29 Oktober 2021
     */
    static function dateIndo($date)
    {

        // $date = '2021-10-29';
        $date = strtotime($date);
        $date = date('d F Y', $date);

        // convert month to indonesia
        $date = str_replace('January', 'Januari', $date);
        $date = str_replace('February', 'Februari', $date);
        $date = str_replace('March', 'Maret', $date);
        $date = str_replace('April', 'April', $date);
        $date = str_replace('May', 'Mei', $date);
        $date = str_replace('June', 'Juni', $date);
        $date = str_replace('July', 'Juli', $date);
        $date = str_replace('August', 'Agustus', $date);
        $date = str_replace('September', 'September', $date);
        $date = str_replace('October', 'Oktober', $date);
        $date = str_replace('November', 'November', $date);
        $date = str_replace('December', 'Desember', $date);

        return $date;
    }

    static  function dateEN($date)
    {
        return Carbon::parse($date)->format('F j, Y');
    }
}
