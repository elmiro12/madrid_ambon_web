@extends('layouts.public')

@section('title', 'Kontak Kami')

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mt-8" data-aos="fade-up">
        <div class="row">
            <!-- Kolom Kiri: Map -->
            <div class="col-md-6 col-sm-12 mt-2">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-lg mb-3">
                            <i class="fa-solid fa-at me-2"></i>Daftar Kontak
                        </h6>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-md-3 text-center d-flex flex-column align-items-center">
                        <a href="mailto:{{ getSetting('site_email') }}" target="_blank">
                            <div class="icon icon-lg icon-shape shadow bg-gradient-info border-radius-md text-center d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <i class="fas fa-envelope text-white" style="font-size: 40px;"></i>
                                </div>
                            </div>
                        </a>
                        <p class="text-muted mt-2">{{ getSetting('site_email') }}</p>
                    </div>

                    @php
                        $socials = getSocialMedias();
                    @endphp

                    @foreach ($socials as $social)
                        <div class="col-md-3 text-center d-flex flex-column align-items-center">
                            <a class="text-dark" href="{{ $social->url }}" target="_blank">
                                <div class="icon icon-lg icon-shape shadow bg-gradient-info border-radius-md text-center d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <i class="{{ $social->icon }} text-white" style="font-size: 40px;"></i>
                                    </div>
                                </div>
                            </a>
                            <p class="text-muted mt-2">{{ $social->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Kolom Kanan: Email & Social Media -->
            <div class="col-md-6 col-sm-12">
                <h6 class="text-lg mb-3">
                    <i class="fa-solid fa-map me-2"></i>Find us on Map -
                    <span class="text-muted">
                        {{ getSetting('site_address') }}
                    </span>
                </h6>
                <!-- Wrapper untuk iframe -->
                <div class="map-responsive" style="height: 300px;">
                    {!! getSetting('google_map_embed') !!}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
