@extends('layouts.admin')

@section('title', 'Manajemen Kategori Post')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Daftar Kategori Post</h3>
</div>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <strong>Tambah Kategori</strong>
        <button class="btn btn-sm btn-outline text-white" type="button" data-bs-toggle="collapse" data-bs-target="#formTambah" aria-expanded="true">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="collapse" id="formTambah">
        <div class="card-body">
            <form action="{{ route('admin.category.save') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Kategory</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="slug" class="form-label">icon</label>
                        <input type="text" name="icon" class="form-control" required>
                        <a href="https://fontawesome.com/icons" target="_blank" class="text-decoration-none">Lihat Daftar Icon</a>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table datatable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Icon</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    <i class="fas {{ $category->icon }} me-2"></i>{{ $category->icon }}
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.category.save') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">icon</label>
                                    <input type="text" name="icon" class="form-control" value="{{ $category->icon }}">
                                    <a href="https://fontawesome.com/icons" target="_blank" class="text-decoration-none">Lihat Daftar Icon</a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
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
