@extends('layouts.admin')

@section('title', 'Manajemen Halaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Daftar Halaman Statis</h3>
    <a href="{{ route('admin.pages.create') }}" class="btn bg-primary text-white">Tambah Halaman</a>
</div>
<table class="table datatable">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Menu</th>
            <th>Halaman Utama</th>
            <th>Aktif</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
        <tr class="align-middle">
            <td>
                <div class="d-flex">
                    <div class="flex-shrink-1">
                        @php
                            $image = $page->image ? $page->image : 'no-image.jpg';
                        @endphp
                        <img src="{{ asset('assets/img/berita/' . $image) }}" alt="{{ $page->title }}" class="img-thumbnail me-2" style="width: 100px;">
                    </div>
                    <div>
                        <p class="mb-0"><strong>{{ $page->title }}</strong></p>
                        <p class="text-muted mb-0"> Icon : <i class="fas {{ $page->icon }} me-2"></i>{{ $page->icon }}</p>
                        <p class="text-muted mb-0"> Hits : {{ $page->hits }} views </p>
                    </div>
                </div>
            </td>
            <td>
                @if ($page->parentMenu)
                <span class="badge bg-primary">{{ $page->parentMenu->name }}</span>
                @else
                <span class="text-muted">Tidak ada menu</span>
                @endif
            </td>
            <td>
                <span class="badge {{ $page->is_carousel ? 'bg-success' : 'bg-secondary' }}">
                    {{ $page->is_carousel ? 'Aktif' : 'Tidak Aktif' }}
                </span>
            </td>
            <td>
                <span class="badge {{ $page->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $page->is_active ? 'Aktif' : 'Tidak Aktif' }}
                </span>
            </td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.pages.show', $page->id) }}" class="btn btn-sm bg-primary text-white me-2">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm bg-info text-white me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="delete-form me-2">
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
        @if ($pages->isEmpty())
        <tr>
            <td colspan="5" class="text-center">Tidak ada halaman statis yang ditemukan.</td>
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
