<!-- Sidebar -->
<nav class="navbar-vertical navbar bg-white" style="z-index: 3 !important;">
    <div class="nav-scroller mx-4">
        <div class="d-flex justify-content-between">
            <!-- Brand logo -->
            <a class="navbar-brand border-bottom mb-3" href="/">
                <img src="{{ asset('assets/img/logo/'.getSetting('site_logo')) }}" alt="logo"/>
                <span class="text-primary text-sm ms-2 p-0">{{ getSetting('site_brand') }}</span>
            </a>
        </div>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link text-primary {{ Request::is('admin/dashboard') ? 'active rounded' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-dashboard me-2"></i>Dashboard
                </a>
            </li>
            @if(Auth::user()->role === 'admin')
                <!-- Nav item -->
                <li class="nav-item">
                    <div class="navbar-heading">Manajemen Menu</div>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-primary {{ Request::is('admin/menus*') ? 'active rounded' : '' }}" href="{{ route('admin.menus.index') }}">
                        <i class="fas fa-hashtag me-2"></i>Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary {{ Request::is('admin/categories*') ? 'active rounded' : '' }}" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-list me-2"></i>Kategori Berita
                    </a>
                </li>
            @endif

            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Manajemen Konten</div>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link text-primary {{ Request::is('admin/pages*') ? 'active rounded' : '' }}" href="{{ route('admin.pages.index') }}">
                    <i class="fas fa-file me-2"></i>Halaman
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary {{ Request::is('admin/post*') ? 'active rounded' : '' }}" href="{{ route('admin.posts.index') }}">
                    <i class="fas fa-newspaper me-2"></i>Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary {{ Request::is('admin/event*') ? 'active rounded' : '' }}" href="{{ route('admin.event.index') }}">
                    <i class="fas fa-calendar me-2"></i>Event
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link has-arrow text-primary {{ ( Request::is('admin/gallery*') || Request::is('admin/gambar*') || Request::is('admin/video*') ) ? 'active rounded' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
                    <i class="fas fa-photo-film me-2"></i>Galeri Web
                </a>
                <div id="navPages" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-primary {{ Request::is('admin/gambar*') ? 'active rounded' : '' }} "  href="{{ route('admin.gallery.gambar') }}">
                                <i class="fas fa-images me-2"></i>Gambar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary {{ Request::is('admin/video*') ? 'active rounded' : '' }} "  href="{{ route('admin.gallery.video') }}">
                                <i class="fas fa-film me-2"></i>Video
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Pengaturan Web</div>
            </li>
                 @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Request::is('admin/socials*') ? 'active rounded' : '' }}" href="{{ route('admin.socials.index') }}">
                            <i class="fas fa-share-alt me-2"></i>Media Sosial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Request::is('admin/users*') ? 'active rounded' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users me-2"></i>Pengguna
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-primary {{ Request::is('admin/settings*') ? 'active rounded' : '' }}" href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-cog me-2"></i>Pengaturan
                    </a>
                </li>

            <li class="nav-item mt-5 ms-4">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link text-white bg-warning rounded border-0 p-2">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
