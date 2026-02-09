@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
@php
    $categories = getPostCategories();
@endphp
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Edit Berita</h3>
</div>
<form action="{{ route('admin.post.save') }}" enctype="multipart/form-data" method="POST" >
    @csrf
    @include('admin.post.form')
</form>
@endsection
