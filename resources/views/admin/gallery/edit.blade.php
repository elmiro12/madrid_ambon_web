@extends('layouts.admin')

@section('title', 'Edit Gallery '.ucwords($slug))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Edit Gallery {{ ucwords($slug) }}</h3>
</div>
<form action="{{ route('admin.gallery.save') }}" enctype="multipart/form-data" method="POST" >
    @csrf
    @include('admin.gallery.form')
</form>
@endsection
