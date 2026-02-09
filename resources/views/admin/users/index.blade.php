@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Daftar Pengguna Website</h3>
</div>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <strong>Tambah Pengguna</strong>
        <button class="btn btn-sm btn-outline text-white" type="button" data-bs-toggle="collapse" data-bs-target="#formTambah" aria-expanded="true">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="collapse" id="formTambah">
        <div class="card-body">
            <form action="{{ route('admin.user.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                        <label for="name" class="form-label">Nama Pengguna</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="role" class="form-label">Role User</label>
                        <select name="role" class="form-select" required>
                            <option value="">Pilih Role </option>
                            <option value="editor">Editor</option>
                            <option value="admin" >Admin</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="photo" class="form-label">Photo : </label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <img src="{{ asset('assets/img/user/'.$user->photo) }}" class="img-thumbnail img-fluid" alt="{{ $user->name }}" width="100px" />
                </td>
                <td>{{ $user->role }}</td>
                <td>
                    @if(Auth::user()->id == 1)
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="delete-form d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.user.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Pengguna</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="col-12">
                                    <label for="name" class="form-label">Nama Pengguna</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <p class="text-muted"><i>Biarkan Kosong jika tidak ingin merubah password</i></p>
                                <div class="col-12">
                                    <label for="role" class="form-label">Role User</label>
                                    <select name="role" class="form-select">
                                        <option value="editor" {{ $user->role === 'admin' ? 'selected' : '' }}>Editor</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="photo" class="form-label">Photo : </label>
                                    <input type="file" class="form-control" name="photo"/>
                                    <small class="text-muted"><i>Biarkan Kosong jika tidak ingin mengganti foto</i></small>
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
