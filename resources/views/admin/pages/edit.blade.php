@extends('layouts.admin')

@section('title', 'Edit Halaman')

@section('content')
@php
    $menus = getMenus();
@endphp
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Edit Halaman</h3>
</div>
<form action="{{ route('admin.pages.save') }}" enctype="multipart/form-data" method="POST" >
    @csrf
    @include('admin.pages.form')
</form>
@endsection
