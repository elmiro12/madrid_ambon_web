@extends('layouts.admin')

@section('title', 'Gallery '.$album->title)

@section('custom-css')
<style>
.img-container img {
  height: 100%;    /* Make the image fill the container's height */
  width: auto;     /* Allow the width to adjust automatically */
  object-fit: contain; /* Or 'cover' or 'fill' depending on desired behavior */
}
</style>
@endsection

@section('content')
<div class="container mb-auto mx-auto mt-8">
    <div class="d-flex justify-content-between mb-3">
        <div class="header">
            <h3 class="fw-bold text-md mb-0">{{ $album->title }}</h3>
            <span class="text-muted text-sm mb-3">{{ $album->deskripsi }}</span>
        </div>
        <div class="btn-group p-1">
            <a href="{{ route('admin.gallery.'.$slug) }}" class="btn bg-secondary text-white me-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row mb-3">
        @forelse($album->galleries as $gallery)
            <div class="{{ $album->is_image ? 'col-md-4 col-sm-6' : 'col-md-6 col-sm-12' }} img-container mb-5">
                @if($album->is_image)
                    <img src="{{ Storage::url('gallery/'.$album->name.'/'.$gallery->images) }}" class="img-fluid img-thumbnail rounded-xl me-3 mb-3">
                @else
                    <div class="w-100 rounded-lg">
                        {!! $gallery->video_embed !!}
                    </div>
                @endif
                <form action="{{ route('admin.gallery.item.destroy', $gallery->id) }}" method="POST" class="delete-form me-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm bg-danger text-white">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </form>
            </div>
        @empty
            <div class="col-12 text-center p-5">
                <span class="badge bg-danger text-white text-xl">Belum ada Gambar/Video</span>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('custom-js')
<script>
    $(document).ready(function () {
        $('.delete-form').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
