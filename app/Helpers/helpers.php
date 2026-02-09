<?php

use App\Models\Menu;
use App\Models\Setting;
use App\Models\SocialMedia;
use App\Models\PostCategory;

if (!function_exists('getSetting')) {
    /**
     * Helper untuk mendapatkan nilai setting berdasarkan key
     *
     * @param string $key
     * @return string|null
     */
    function getSetting($key)
    {
        return Setting::getValue($key);
    }
}

if (!function_exists('updateOrCreateSetting')) {
    /**
     * Helper untuk mengupdate atau membuat setting baru
     *
     * @param string $key
     * @param string $value
     * @return \App\Models\Setting
     */
    function updateOrCreateSetting($key, $value)
    {
        return Setting::updateOrCreateSetting($key, $value);
    }
}

if (!function_exists('getMenus')) {
    /**
     * Helper untuk mendapatkan nilai setting berdasarkan key
     */
    function getMenus()
    {
        return Menu::where('is_active', true)
            ->orderBy('order', 'asc')
            ->with('children') // Eager load children menus
            ->get();
    }
}

if (!function_exists('getSocialMedias')) {
    /**
     * Helper untuk mendapatkan nilai setting berdasarkan key
     */
    function getSocialMedias()
    {
        return SocialMedia::where('is_active', true)
            ->latest()
            ->get();;
    }
}

if (!function_exists('getPostCategories')) {
    /**
     * Helper untuk mendapatkan kategori postingan
     */
    function getPostCategories()
    {
        return PostCategory::latest()->get();
    }
}
