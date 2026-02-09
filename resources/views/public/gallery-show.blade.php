@extends('layouts.public')

@php
    $cols = $album->is_image ? 'col-md-4 col-sm-6' : 'col-md-6 col-sm-12';
    $title = $album->is_image ? 'Foto' : 'Video';
@endphp

@section('title', 'Gallery '.$title)

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto mt-8" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 my-auto text-center">
                <h1 class="text-gradient text-dark">{{ $album->title }}</h1>
                <h5 class="text-muted">{{ $album->deskripsi }}</h5>
                <p class="text-muted text-sm">Tanggal Update : {{ \Carbon\Carbon::parse($album->updated_at)->translatedFormat('d F Y') }}</p>
                <hr class="shadow border-2 border-blue-700 mx-auto" width="50%">
            </div>
        </div>
        <div class="row mt-3">
            @forelse($album->galleries as $gallery)
                <div class="{{ $album->is_image ? 'col-md-4 col-sm-6' : 'col-md-6 col-sm-12' }} d-flex justify-content-start">
                    @if($album->is_image)
                        <img src="{{ Storage::url('gallery/'.$album->name.'/'.$gallery->images) }}" class="img-fluid img-thumbnail rounded-xl me-3 mb-3" width="400px">
                    @else
                        <div class="w-100 rounded-lg">
                            {!! $gallery->video_embed !!}
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-12 text-center p-5">
                    <span class="badge bg-danger text-white text-xl">Belum ada Gambar/Video</span>
                </div>
            @endforelse
        </div>
        <a href="{{ route('pages',$slug) }}" class="btn bg-secondary text-white me-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
