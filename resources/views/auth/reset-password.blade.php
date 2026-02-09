@extends('layouts.auth')

@section('title','Masukan Password Baru')

@section('content')
<div class="card z-index-0 fadeIn3 fadeInBottom">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
      <h4 class="font-weight-bolder text-white text-center">Reset Password</h4>
    </div>
</div>
<div class="card-body">
  <form method="POST" action="{{ route('password.store') }}">
     @csrf
     <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="mb-4 text-sm text-muted">
        Masukan email yang terdaftar, Email hanya dikirimkan ke akun yang sudah terdaftar !!!
    </div>

    <div class="input-group input-group-outline mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="old('email', $request->email)" autocomplete="email">
      @error('email')
        <div class="my-2 text-primary">{{ $message }}</div>
      @enderror
    </div>
    <div class="input-group input-group-outline mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-control" autocomplete="password">
      @error('password')
        <div class="my-2 text-primary">{{ $message }}</div>
      @enderror
    </div>
    <div class="input-group input-group-outline mb-3">
      <label class="form-label">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="password_confirmation">
      @error('password_confirmation')
        <div class="my-2 text-primary">{{ $message }}</div>
      @enderror
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Reset Password</button>
    </div>
  </form>
</div>
</div>
@endsection
