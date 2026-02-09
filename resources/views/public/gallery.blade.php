@extends('layouts.public')

@section('title', 'Gallery '. ucwords($slug))

@section('page-header')
<header class="header-2 bg-transparent">
    <div class="page-header min-vh-25 relative">
        <span class="mask bg-gradient-secondary opacity-4 p-1"></span>
        <h1 class="text-gradient text-dark mx-auto mt-8 mb-4">Gallery {{ ucwords($slug) }}</h1>
    </div>
</header>
@endsection

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto table-responsive" data-aos="fade-up">
        <table class="table table-striped">
            <thead>
                <tr class="bg-gradient-secondary">
                    <th class="text-white">Judul/Deskripsi</th>
                    <th class="text-white text-center">Preview {{ ucwords($slug) }}</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($albums as $album)
                <tr>
                    <td colspan="3">
                        <strong>{{ $album->title ?? 'No Title' }}</strong>
                        <p class="text-muted">{{ $album->deskripsi ?? 'No Description' }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle text-center" colspan="2">
                            <div class="row">
                                @foreach ($album->galleries as $gallery)
                                    @if($album->is_image)
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <img src="{{ Storage::url('gallery/'.$album->name.'/'.$gallery->images) }}" class="img-thumbnail me-2" style="width: 100px;">
                                    </div>
                                    @else
                                        <div class="col-sm-6 col-12 mb-2">
                                            {!! $gallery->video_embed !!}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        <span class="text-muted">Jumlah {{ ucwords($slug) }}: {{ $album->galleries_count }}</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('gallery.show', $album->id) }}" class="btn btn-sm bg-success text-white me-2">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="badge bg-danger text-white text-center mt-4">Tidak ada gallery yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
