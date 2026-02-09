@extends('layouts.admin')

@section('title', 'Dashboard')

@section('card-content')
    {{-- Informasi Kartu --}}
    @php
        $cards = [
            ['label' => 'Total Menu', 'value' => $menuCount, 'icon' => 'bars', 'bg' => 'white text-dark','route' => route('admin.menus.index')],
            ['label' => 'Total Halaman', 'value' => $pageCount, 'icon' => 'file', 'bg' => 'success', 'route' => route('admin.pages.index')],
            ['label' => 'Total Kategori', 'value' => $categoryCount, 'icon' => 'tags', 'bg' => 'danger', 'route' => route('admin.categories.index')],
            ['label' => 'Total Post', 'value' => $postCount, 'icon' => 'newspaper', 'bg' => 'warning', 'route' => route('admin.posts.index')],
            ['label' => 'Total Pengguna', 'value' => $userCount, 'icon' => 'user', 'bg' => 'info', 'route' => route('admin.users.index')],
            ['label' => 'Total Sosial Media', 'value' => $socialCount, 'icon' => 'share-alt', 'bg' => 'primary', 'route' => route('admin.socials.index')],
        ];
    @endphp
    <div class="row mt-6 mb-3">
        @foreach ($cards as $card)
        <div class="col-md-4 col-6 mt-6">
            {{-- Kartu Informasi --}}
            <div class="card bg-{{ $card['bg'] }} shadow-sm">
                <div class="card-body shadow-sm border-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-1 {{ Str::contains($card['bg'], 'text-dark') ? '' : 'text-white' }}">{{ $card['label'] }}</h4>
                        <i class="fas fa-{{ $card['icon'] }} fs-1 me-3 {{ Str::contains($card['bg'], 'text-dark') ? '' : 'text-white' }}"></i>
                    </div>
                    <div>
                        <h1 class="mb-0 fw-bold {{ Str::contains($card['bg'], 'text-dark') ? '' : 'text-white' }}">{{ $card['value'] }}</h1>
                        <a href="{{ $card['route'] }}" class="text-decoration-none text-{{ Str::contains($card['bg'], 'text-dark') ? 'dark' : 'white' }}">
                        <i class="fas fa-arrow-right"></i> Lihat Detail
                    </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
