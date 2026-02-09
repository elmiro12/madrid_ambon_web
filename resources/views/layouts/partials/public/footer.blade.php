@php
    $post_categories = getPostCategories();
    $socials = getSocialMedias();
@endphp

<footer class="footer pt-5 bg-gradient-info">
    <div class="container">
        <div class=" row">
            <div class="col-md-3 mb-4 ms-auto">
                <div>
                <a href="/">
                    <img src="{{ asset('assets/img/logo/'.getSetting('site_logo')) }}" class="mb-3" alt="main_logo" width="100px">
                </a>
                <h4 class="font-weight-bolder mb-4 text-white">{{ getSetting('site_name') }}</h4>
                </div>
                <div>
                <p class="text-white">Find Us on Social Media :</p>
                <ul class="d-flex flex-row ms-n3 nav">
                    @foreach ($socials as $social)
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ $social->url }}" target="_blank">
                            <div class="icon icon-lg icon-shape shadow bg-gradient-warning border-radius-md text-center d-flex align-items-center justify-content-center">
                                <div class="align-middle text-center">
                                    <i class="{{ $social->icon }} text-dark" style="font-size: 40px"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div>
                    <h6 class="text-lg text-white">Kategori Berita</h6>
                    <ul class="nav flex-column">
                        @foreach ($post_categories as $pc)
                            <li class="nav-item my-2">
                                <a class="nav-link text-dark text-white" href="/categories/{{ $pc->slug }}">
                                    <i class="fas {{ $pc->icon }} me-2 text-md"></i>{{ $pc->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <h6 class="text-lg text-white">Find us on Map</h6>
                <!-- Wrapper untuk iframe -->
                <div class="map-responsive">
                    {!! getSetting('google_map_embed') !!}
                </div>
            </div>
            <div class="col-12 text-center text-white p-2">
                <small>&copy; {{ date('Y') }} PRMI Regional Ambon Web by :
                <a href="https://instagram.com/el_miro23" target="_blank" class="fw-bold text-white">
                    <i class="fa-brands fa-instagram"></i> <small>Hendrik Samkay</small>
                </a>
                </small>
            </div>
        </div>
    </div>
</footer>
