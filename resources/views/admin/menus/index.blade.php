@extends('layouts.admin')

@section('title', 'Manajemen Menus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Daftar Menu Website</h3>
</div>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <strong>Tambah Menu</strong>
        <button class="btn btn-sm btn-outline text-white" type="button" data-bs-toggle="collapse" data-bs-target="#formTambah" aria-expanded="true">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="collapse" id="formTambah">
        <div class="card-body">
            <form action="{{ route('admin.menu.save') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Menu</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="slug" class="form-label">Icon</label>
                        <input type="text" name="icon" class="form-control" required>
                        <a href="https://fontawesome.com/icons" target="_blank" class="text-decoration-none">Lihat Daftar Icon</a>
                    </div>
                    <div class="col-md-6">
                        <label for="parent_id" class="form-label">Parent Menu</label>
                        <select name="parent_id" class="form-select">
                            <option value="">Tidak ada</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="order" class="form-label">order</label>
                        <input type="number" name="order" class="form-control" min="0" value="{{ $maxOrder + 1 }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="is_active" class="form-label">Aktif</label>
                        <select name="is_active" class="form-select">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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
            <th>Parent Menu</th>
            <th>Order</th>
            <th>Is Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->slug }}</td>
                <td>
                    <i class="fas {{ $menu->icon }} me-2"></i>{{ $menu->icon }}
                </td>
                <td>
                    {{ $menu->parent_id ? $menu->parent->name : 'Menu Utama' }}
                </td>
                <td>{{ $menu->order }}</td>
                <td>
                    @php
                        $isActive = $menu->is_active;
                        $class = $isActive ? 'bg-success' : 'bg-danger';
                        $icon = $isActive ? 'fa-check-circle' : 'fa-times-circle';
                        $label = $isActive ? 'Aktif' : 'Tidak Aktif';
                    @endphp
                    <span class="badge {{ $class }} text-white">
                        <i class="fas {{ $icon }} me-2"></i>{{ $label }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $menu->id }}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $menu->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $menu->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.menu.save') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $menu->id }}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon</label>
                                    <input type="text" name="icon" class="form-control" value="{{ $menu->icon }}" required>
                                    <a href="https://fontawesome.com/icons" target="_blank" class="text-decoration-none">Lihat Daftar Icon</a>
                                </div>
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent Menu</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="">Tidak ada</option>
                                        @foreach($menus as $parentMenu)
                                            <option value="{{ $parentMenu->id }}" {{ $menu->parent_id == $parentMenu->id ? 'selected' : '' }}>{{ $parentMenu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" name="order" class="form-control" min="0" value="{{ $menu->order }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Aktif</label>
                                    <select name="is_active" class="form-select">
                                        <option value="1" {{ $menu->is_active ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ !$menu->is_active ? 'selected' : '' }}>Tidak</option>
                                    </select>
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
