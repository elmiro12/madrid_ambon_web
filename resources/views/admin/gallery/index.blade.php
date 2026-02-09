@extends('layouts.admin')

@section('title', 'Gallery '.ucwords($slug))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Gallery {{ ucwords($slug) }}</h3>
    <a href="{{ route('admin.gallery.create', $slug) }}" class="btn bg-primary text-white">Tambah Gallery {{ ucwords($slug) }} Baru</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Judul/Deskripsi</th>
            <th class="text-center">Preview {{ ucwords($slug) }}</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($albums as $album)
        <tr>
            <td>
                <strong>{{ $album->title ?? 'No Title' }}</strong>
                <p class="text-muted">{{ $album->deskripsi ?? 'No Description' }}</p>
            </td>
            <td class="align-middle text-center">
                <div class="row">
                    @foreach ($album->galleries as $gallery)
                        @if($album->is_image)
                        <div class="col-md-4 col-sm-6 col-12">
                            <img src="{{ Storage::url('gallery/'.$album->name.'/'.$gallery->images) }}" class="img-thumbnail me-2" style="width: 100px;">
                        </div>
                        @else
                            <div class="col-12">
                                {!! $gallery->video_embed !!}
                            </div>
                        @endif
                    @endforeach
                </div>
                <span class="text-muted">Jumlah {{ ucwords($slug) }}: {{ $album->galleries_count }}</span>
            </td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.gallery.show', $album->id) }}" class="btn btn-sm bg-success text-white me-2">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('admin.gallery.edit', $album->id) }}" class="btn btn-sm bg-info text-white me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.gallery.destroy', $album->id) }}" method="POST" class="delete-form me-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm bg-danger text-white">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
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
