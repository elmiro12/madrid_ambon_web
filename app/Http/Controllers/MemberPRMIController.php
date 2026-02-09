<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MemberPRMIController extends Controller
{
    public function showActiveMembers()
    {
        // Ambil data dari API aplikasi lain
        $response = Http::get('https://membership.madridambon.my.id/getMemberAktif');  // Ganti dengan URL API Anda

        // Cek jika response sukses dan ambil data JSON
        if ($response->successful()) {
            $members = $response->json();  // Mengambil data JSON
        } else {
            $members = [];  // Jika gagal, kosongkan array
        }
        return view('public.member', compact('members'));
    }
}
