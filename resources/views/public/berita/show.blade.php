@extends('layouts.public')

@section('keywords', $berita->keywords)

@section('title', $berita->title)

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto mt-8">
        <div class="row">
            <div class="col-lg-4 my-auto mx-auto text-center" data-aos="zoom-in">
                @php
                    $image = $berita->image ? $berita->image : 'no-image.jpg';
                @endphp
                <img src="{{ asset('assets/img/berita/'.$image) }}" class="img-fluid img-thumbnail rounded-xl mb-3" alt="{{ $berita->title }}" width="300px">
                <p class="text-muted">{{ $berita->title }}</p>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-5 ps-lg-0 ps-0" data-aos="fade-right">
                <h1>{{ $berita->title }}</h1>
                <small>Diposting pada {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y - H:i') }} WIT</small>
                <hr class="shadow border-2" width="50%">
                <div class="content">
                    {!! $berita->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
