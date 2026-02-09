@extends('layouts.public')

@section('title', 'Berita')

@section('page-header')
<header class="header-2 bg-transparent">
    <div class="page-header min-vh-25 relative">
        <span class="mask bg-gradient-secondary opacity-4 p-1"></span>
        <h1 class="text-gradient text-dark mx-auto mt-8 mb-4">Berita {{ ($categoryName && $categoryName != 'none') ? $categoryName : '' }} Terbaru</h1>
    </div>
</header>
@endsection

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto">
        <div class="row mt-4 d-flex justify-content-start align-items-center" data-aos="zoom-in">
            @forelse ($beritas as $berita)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('assets/img/berita/'.$berita->image) }}" class="card-img-top img-thumbnail" alt="{{ $berita->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $berita->title }}</h5>
                            <p class="card-text">{!! Str::limit($berita->content, 100) !!}</p>
                            <a href="{{ route('berita.show', $berita->slug) }}" class="btn bg-gradient-info">Baca Selengkapnya</a>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Diposting pada {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y - H:i') }} WIT</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center text-white">
                        <strong>Belum ada berita terbaru.</strong>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            {{ $beritas->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>
@endsection
