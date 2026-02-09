@extends('layouts.admin')

@section('title', 'Daftar Berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Daftar Berita</h3>
    <a href="{{ route('admin.post.create') }}" class="btn bg-primary text-white">Tambah Berita</a>
</div>
<table class="table datatable">
    <thead>
        <tr>
            <th>Gambar/Judul</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Aktif</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr class="align-middle">
            <td>
                <div class="d-flex">
                    <div class="flex-shrink-1">
                        @php
                            $image = $post->image ? $post->image : 'no-image.jpg';
                        @endphp
                        <img src="{{ asset('assets/img/berita/' . $image) }}" alt="{{ $post->title }}" class="img-thumbnail me-2" style="width: 150px;">
                    </div>
                    <div>
                        <p class="text-md text-wrap mb-0"><strong>{{ $post->title }}</strong></p>
                        @if($post->icon)
                            <p class="text-muted mb-0"> Icon : <i class="fas {{ $post->icon }} me-2"></i>{{ $post->icon }}</p>
                        @endif
                        <p class="text-muted mb-0"> Hits : {{ $post->hits }} views </p>
                    </div>
                </div>
            </td>
            <td>
                @if ($post->category)
                    <span class="badge bg-primary">{{ $post->category->name }}</span>
                @else
                    <span class="text-muted">Belum ada Kategori</span>
                @endif
            </td>
            <td>{{ $post->summary }}
            <td>
                <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-secondary' }}">
                    {{ $post->is_published ? 'Publish' : 'Draft' }}
                </span>
            </td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-sm bg-primary text-white me-2">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                    <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-sm bg-info text-white me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST" class="delete-form me-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm bg-danger text-white">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @if ($posts->isEmpty())
        <tr>
            <td colspan="5" class="text-center">Tidak ada berita yang ditemukan.</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection

@section('custom-js')
<script>
    $(document).ready(function () {

        $('.btn-outline').on('click', function () {
            const icon = $(this).find('i');
            if (icon.hasClass('fa-minus')) {
                icon.removeClass('fa-minus').addClass('fa-plus');
            } else {
                icon.removeClass('fa-plus').addClass('fa-minus');
            }
        });
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
