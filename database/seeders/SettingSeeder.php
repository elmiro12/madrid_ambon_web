<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Setting::create([
            'key' => 'site_name',
            'value' => 'PRMI Regional Ambon'
        ]);

        Setting::create([
            'key' => 'site_brand',
            'value' => 'PRMI Ambon'
        ]);

        Setting::create([
            'key' => 'site_icon',
            'value' => 'favicon.ico'
        ]);
        Setting::create([
            'key' => 'site_logo',
            'value' => 'logo.png'
        ]);
        Setting::create([
            'key' => 'site_description',
            'value' => 'Website resmi PRMI Regional Ambon'
        ]);
        Setting::create([
            'key' => 'site_welcome_message',
            'value' => 'Selamat datang di website PRMI Regional Ambon, tempat informasi dan berita terkini seputar kegiatan dan pelayanan kami.'
        ]);
        Setting::create([
            'key' => 'google_map_embed',
            'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.5518501879287!2d128.19526287450202!3d-3.688893642971468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6ce9a91e0e7b25%3A0xaa33b80ec2362cc9!2sGOR%20Sport%20Hall%20Karang%20Panjang%20Ambon!5e0!3m2!1sid!2sid!4v1752626522007!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);

        Setting::create([
            'key' => 'site_address',
            'value' => 'Jl. Karang Panjang No. 1, Ambon, Maluku'
        ]);

        Setting::create([
            'key' => 'site_email',
            'value' => 'info@madridambon.my.id'
        ]);

        Setting::create([
            'key' => 'site_about',
            'value' => 'Website PRMI Regional Ambon adalah platform resmi yang menyediakan informasi terkini mengenai kegiatan, pelayanan, dan berita seputar PRMI di wilayah Ambon. Kami berkomitmen untuk menyebarkan nilai-nilai keagamaan dan sosial melalui berbagai program dan inisiatif yang kami jalankan.',
        ]);
    }

}
