@extends('layouts.public')

@section('title', 'Home')

@section('custom-css')
<style>
/* Styling untuk logo */
.home-logo {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 150px;
    height: auto; /* Menjaga rasio tinggi gambar */
    object-fit: contain; /* Menjaga proporsi gambar tetap terjaga */
}
</style>
@endsection

@section('page-header')
  <header class="header-2">
    <div id="carouselExample" class="carousel slide my-auto" data-bs-ride="carousel" data-aos="zoom-in">
        <div class="carousel-inner">
            <!-- Carousel pertama dengan welcome message -->
            <div class="carousel-item active">
                <div class="page-header min-vh-75 relative">
                    <span class="mask bg-gradient-info opacity-7"></span>
                    <div class="carousel-caption mt-8">
                        <img src="{{ asset('assets/img/logo/'.getSetting('site_logo')) }}" class="img-fluid home-logo" alt="logo">
                        <h1 class="text-dark">Welcome to</h1>
                        <h3 class="text-dark">{{ getSetting('site_name') }}</h3>
                        <small class="lead text-dark text-md d-none d-md-block">{{ getSetting('site_welcome_message') }}</small>
                        <p class="mt-2 p-0">
                            <a href="https://membership.madridambon.my.id" class="btn bg-warning text-white">Gabunglah bersama kami !!</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Carousel berikutnya menggunakan data dari $carousels -->
            @foreach($carousels as $carousel)
                @php
                    $image = $carousel->image ? $carousel->image : 'no-image.jpg';
                @endphp
                <div class="carousel-item">
                    <div class="page-header min-vh-75 relative" style="background-image:url('{{ asset('assets/img/berita/'.$image) }}')">
                        <span class="mask bg-gradient-dark opacity-6"></span>
                        <div class="carousel-caption">
                            <h1 class="text-white">{{ $carousel->title }}</h1>
                            <p class="lead text-white">{!! \Illuminate\Support\Str::limit($carousel->content, 50) !!}...</p>
                            <a href="{{ route('pages', $carousel->slug) }}" class="btn bg-warning text-white">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Tombol navigasi carousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
  </header>
@endsection

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur">
    <section class="pt-3 pb-5" id="komunitas" data-aos="fade-up">
        <div class="container bg-transparent">
            <div class="row">
                <div class="col-12 py-4 align-middle">
                    <h1 class="text-gradient text-dark text-center">Join Komunitas Kami !!!</h1>
                    <hr class="shadow border-2 border-blue-700 mx-auto" width="50%">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 mx-auto py-3">
                    <div class="row">
                    <div class="col-md-4 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-dark"><i class="fa-solid fa-futbol"></i></h1>
                            <h5 class="mt-3">Fun Futsal</h5>
                            <p class="text-sm font-weight-normal">Kegiatan Futsal PRMI Ambon dilaksanakan setiap hari minggu,</p>
                            </div>
                        <hr class="vertical dark">
                    </div>
                    <div class="col-md-4 position-relative">
                        <div class="p-3 text-center">
                        <h1 class="text-gradient text-dark"><i class="fa-solid fa-mug-hot"></i></h1>
                        <h5 class="mt-3">Kopi Darat (Kopdar)</h5>
                        <p class="text-sm font-weight-normal">Komunitas untuk sharing, berbagi dan cerita bersama</p>
                        </div>
                        <hr class="vertical dark">
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 text-center">
                        <h1 class="text-gradient text-dark"><i class="fa-solid fa-film"></i></h1>
                        <h5 class="mt-3">Nonton Bareng (Nobar)</h5>
                        <p class="text-sm font-weight-normal">Ayo nonton pertandingan Real Madrid bersama, Jangan nonton sendiri, rame-rame bersama kami</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------- START Features w/ icons and text on left & gradient title and text on right -------- -->
    <section class="py-5" id="tentang-kami" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 my-auto mx-auto text-center">
                @php
                    $image = $page->image ? $page->image : 'no-image.jpg';
                @endphp
                <img src="{{ asset('assets/img/logo/'.getSetting('site_logo')) }}" class="img-fluid mb-3" alt="{{ $page->title }}" width="300px">
            </div>
            <div class="col-lg-8 mt-lg-0 mt-5 ps-lg-0 ps-0">
                <h1>{{ $page->title }}</h1>
                <div class="content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- -------- END Features w/ icons and text on left & gradient title and text on right -------- -->
    <section class="py-5" id="berita-terbaru" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-gradient text-dark">Berita Terbaru</h2>
                    <hr class="shadow border-2 border-blue-700 mx-auto" width="50%">
                </div>
            </div>
            <div class="row mt-4 d-flex justify-content-center align-items-center">
                @foreach($beritas as $berita)
                    <div class="col-md-4 col-sm-2 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('assets/img/berita/'.$berita->image) }}" class="card-img-top img-thumbnail mx-auto pt-2" alt="{{ $berita->title }}">
                            <div class="card-body">
                                <h5 class="card-title   ">{{ $berita->title }}</h5>
                                <p class="card-text">{!! Str::limit($berita->content, 100) !!}</p>
                                <a href="{{ url('berita/'.$berita->slug) }}" class="btn bg-gradient-info">Baca Selengkapnya</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Diposting pada {{ $berita->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-center mt-2">
                    <a href="{{ url('berita') }}" class="btn bg-gradient-warning">Lihat Semua Berita</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
