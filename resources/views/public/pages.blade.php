@extends('layouts.public')

@section('title', $page->title)

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto mt-8" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-4 my-auto mx-auto text-center">
                @php
                    $image = $page->image ? $page->image : 'no-image.jpg';
                @endphp
                <img src="{{ asset('assets/img/berita/'.$image) }}" class="img-fluid img-thumbnail rounded-xl mb-3" alt="{{ $page->title }}" width="300px">
                <p class="text-muted">{{ $page->title }}</p>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-5 ps-lg-0 ps-0">
                <h1>{{ $page->title }}</h1>
                <small>Diposting pada {{ \Carbon\Carbon::parse($page->created_at)->translatedFormat('d F Y - H:i') }} WIT</small>
                <hr class="shadow border-2" width="50%">
                <div class="content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
