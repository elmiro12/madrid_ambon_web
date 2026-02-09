@extends('layouts.admin')

@section('title', 'Detil Halaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    {{-- Title and Back Button --}}
    <h3 class="mb-0">Detil Halaman</h3>
</div>
<div class="row g-2 mt-3">
    <div class="col-12">
        <h4 class="fw-bold">{{ $page->title }}</h4>
    </div>
    <div class="col-md-4">
        @php
            $image = $page->image ? $page->image : 'no-image.jpg';
        @endphp
        <img src="{{ asset('assets/img/berita/' . $image) }}" alt="{{ $page->title }}" class="img-thumbnail me-2" style="width: 100px;"/>
    </div>
    <div class="col-md-8">
        {!! $page->content !!}
    </div>
    <div class="col-12 mt-5">
        <a href="{{ url()->previous() }}" class="btn bg-secondary text-white">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
        <a href="{{ route('admin.pages.edit',$page->id) }}" class="btn bg-primary text-white">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
    </div>
</div>
@endsection
