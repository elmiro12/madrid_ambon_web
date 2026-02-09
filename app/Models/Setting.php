<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    // Fungsi untuk mendapatkan value berdasarkan key
    public static function getValue($key)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : null;
    }
    // Fungsi untuk mengupdate atau membuat setting
    public static function updateOrCreateSetting($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}

