@extends('layouts.public')
@section('title', 'Halaman Tidak Ditemukan (404)')

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto mt-8">
        <div class="row">
            <div class="col-lg-12 my-auto text-center">
                <h1 class="text-gradient text-danger">404 - Halaman Tidak Ditemukan</h1>
                <hr class="shadow border-2 border-red-700 mx-auto" width="50%">
                <p class="text-muted">Maaf, halaman yang Anda cari tidak ditemukan.</p>
                <a href="{{ url('/') }}" class="btn bg-gradient-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection
