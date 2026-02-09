@extends('layouts.auth')

@section('title','Reset Password')

@section('content')
<div class="card z-index-0 fadeIn3 fadeInBottom">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-info shadow-dark border-radius-lg py-3 pe-1">
      <h4 class="font-weight-bolder text-white text-center">Lupa Password</h4>
    </div>
</div>
<div class="card-body">
  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-4 text-sm text-muted">
        @if(session('status'))
            <span class="text-info">{{ session('status') }}</span>
        @else
            <span>Masukan email yang terdaftar, Email hanya dikirimkan ke akun yang sudah terdaftar !!!</span>
        @endif
    </div>

    <div class="input-group input-group-outline mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" autocomplete="email">
    </div>
    @error('email')
        <div class="my-2 text-danger text-sm">{{ $message }}</div>
    @enderror
    <div class="text-center">
      <button type="submit" class="btn btn-lg bg-gradient-info btn-lg w-100 mt-4 mb-0">Kirim Email Reset</button>
    </div>
  </form>
</div>
<div class="card-footer text-center pt-0 px-lg-2 px-1">
  <p class="mb-2 text-sm mx-auto">
    Sudah Punya akun?
    <a href="{{ route('login') }}" class="text-info text-gradient font-weight-bold">Sign in</a>
  </p>
</div>
</div>
@endsection
