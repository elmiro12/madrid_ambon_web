@extends('layouts.admin')

@section('title', 'Manajemen Event')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Daftar Event</h3>
</div>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <strong>Tambah Event Baru</strong>
        <button class="btn btn-sm btn-outline text-white" type="button" data-bs-toggle="collapse" data-bs-target="#formTambah" aria-expanded="true">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="collapse" id="formTambah">
        <div class="card-body">
            <form action="{{ route('admin.event.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Event</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ketentuan" class="form-label">Ketentuan</label>
                        <textarea name="ketentuan" class="form-control" rows="3">{{ old('ketentuan') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_event" class="form-label">Tanggal/Jam Event (WIT)</label>
                        <input type="datetime-local" name="tanggal_event" class="form-control" value="{{ old('tanggal_event') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
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
<table class="table">
    <thead>
        <tr>
            <th>Nama Event/Deskripsi</th>
            <th>Tanggal/Jam</th>
            <th>Lokasi</th>
            <th>Ketentuan</th>
            <th>Aktif</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
            <tr>
                <td>
                    <strong>{{ $event->nama }}</strong>
                    <p class="text-muted">{{ $event->deskripsi }}</p>
                </td>
                <td>{{ \Carbon\Carbon::parse($event->tanggal_event)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($event->tanggal_event)->translatedFormat('H:i') }} WIT</td>
                <td>
                    {{ $event->lokasi }}
                </td>
                 <td>
                    {!! nl2br(e($event->ketentuan)) !!}
                </td>
                <td>
                    <span class="badge {{ $event->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $event->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $event->id }}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $event->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.event.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $event->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" value="{{ $event->deskripsi }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_event" class="form-label">Tanggal/Jam Event</label>
                                    <input type="datetime-local" name="tanggal_event" class="form-control" value="{{ $event->tanggal_event }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ketentuan" class="form-label">Ketentuan</label>
                                    <textarea name="ketentuan" class="form-control" rows="3">{{ $event->ketentuan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" value="{{ $event->lokasi }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Aktif</label>
                                    <select name="is_active" class="form-select">
                                        <option value="1" {{ $event->is_active ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ !$event->is_active ? 'selected' : '' }}>Tidak</option>
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
