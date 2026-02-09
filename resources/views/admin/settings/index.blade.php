@extends('layouts.admin')

@section('title', 'Manajemen Pengaturan Website')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Daftar Pengaturan Web</h3>
</div>
<table class="table">
    <tbody>
        @if(Auth::user()->role === 'admin')
        <tr>
            <th><strong>Nama Website</strong></th>
            <td>{{ getSetting('site_name') }}</td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="site_name" data-value="{{ getSetting('site_name') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        <tr>
            <th><strong>Branding Web</strong></th>
            <td>{{ getSetting('site_brand') }}</td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="site_brand" data-value="{{ getSetting('site_brand') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        <tr>
            <th><strong>Logo Web</strong></th>
            <td>
                <img src="{{ asset('assets/img/logo/'.getSetting('site_logo')) }}" class="img-thumbnail" width="100px"/>
                <p class="text-muted">{{ getSetting('site_logo') }}</p>
            </td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="site_logo" data-value="{{ getSetting('site_logo') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        <tr>
            <th><strong>Deskripsi Web</strong></th>
            <td>{{ getSetting('site_description') }}</td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="site_description" data-value="{{ getSetting('site_description') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        <tr>
            <th><strong>Alamat</strong></th>
            <td>{{ getSetting('site_address') }}</td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="site_address" data-value="{{ getSetting('site_address') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        <tr>
            <th><strong>Email</strong></th>
            <td>{{ getSetting('site_email') }}</td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="site_email" data-value="{{ getSetting('site_email') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        <tr>
            <th><strong>Welcome Message</strong></th>
            <td>
                {{ getSetting('site_welcome_message') }}
            </td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="site_welcome_message" data-value="{{ getSetting('site_welcome_message') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        <tr>
            <th><strong>Google Map</strong></th>
            <td>
                <div class="map-responsive">
                    {{!! getSetting('google_map_embed') !!}}
                </div>
            </td>
            <td>
                <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-key="google_map_embed" data-value="{{ getSetting('google_map_embed') }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </td>
        </tr>
        @endif
    </tbody>
</table>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.setting.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengaturan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="key" id="modal-key">
                    <div class="mb-3">
                        <label for="type" class="form-label" id="value_label">Value</label>
                        <div id="modal-input-container">
                            <input type="text" name="value" id="modal-value" class="form-control" required>
                        </div>
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
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
        // Ketika tombol edit diklik
        $('.edit-button').click(function() {
            // Ambil data key dan value dari tombol yang diklik
            var key = $(this).data('key');
            var value = $(this).data('value');

            // Isi modal dengan key dan value yang sesuai
            $('#modal-key').val(key);
            $('#modal-value').val(value);
            $('#value_label').text(key);

            // Tentukan tipe input berdasarkan key
            var inputContainer = $('#modal-input-container');
            if (key === 'site_email') {
                inputContainer.html('<input type="email" name="value" id="modal-value" class="form-control" value="' + value + '" required>');
            } else if (key === 'site_logo' || key.startsWith('user_img')) {
                inputContainer.html('<input type="file" name="value" id="modal-value" class="form-control" required>');
            } else if (key === 'site_welcome_message' || key === 'google_map_embed') {
                inputContainer.html('<textarea name="value" id="modal-value" class="form-control" rows="10" required>' + value + '</textarea>');
            } else {
                inputContainer.html('<input type="text" name="value" id="modal-value" class="form-control" value="' + value + '" required>');
            }
        });
    });
</script>
@endsection

