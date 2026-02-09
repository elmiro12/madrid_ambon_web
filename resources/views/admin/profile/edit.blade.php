@extends('layouts.admin')

@section('title', 'Edit Profil')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
        <div class="border-bottom pb-4 mb-4">
            <h3 class="mb-0 fw-bold">Edit Profil</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-5">
        <!-- Card -->
        <div class="card h-100">
            <!-- Card header -->
            <div class="card-header">
                <h4 class="mb-0">Informasi Profil</h4>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <!-- Foto Profil -->
                    <div class="mb-3">
                        <label class="form-label" for="photo">Foto Profil</label>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <img src="{{ asset('assets/img/user/' . $user->photo) }}" alt="foto profil" class="rounded-circle avatar-xl" width="100px" height="100px" style="object-fit:cover;">
                            </div>
                            <div class="file-upload btn btn-outline-secondary btn-sm">
                                <input type="file" name="photo" id="photo" class="input-file">
                            </div>
                        </div>
                         @error('photo')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>

                        @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 mb-0"
                            >{{ __('Tersimpan.') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-5">
        <!-- Card -->
        <div class="card h-100">
             <!-- Card header -->
             <div class="card-header">
                <h4 class="mb-0">Ubah Password</h4>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <!-- Password Saat Ini -->
                    <div class="mb-3">
                        <label class="form-label" for="current_password">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-3">
                        <label class="form-label" for="password">Password Baru</label>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
                        @error('password', 'updatePassword')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>

                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 mb-0"
                            >{{ __('Tersimpan.') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
