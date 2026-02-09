@php
    $menus = getMenus();
    $post_categories = getPostCategories();
    $socials = getSocialMedias();
@endphp
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 shadow my-3 py-0 navbar-light mx-7 start-0 end-0 rounded">
  <div class="container">
    <a class="navbar-brand font-weight-bolder ms-sm-3 d-flex" href="{{ url('/') }}" data-bs-toggle="tooltip" data-bs-title="PRMI Regional Ambon Official Website" data-bs-placement="bottom">
        <img src="{{ asset('assets/img/logo/'.getSetting('site_logo')) }}" class="img-fluid" alt="logo" width="50px">
        <span class="text-dark d-none d-md-block my-auto">{{ getSetting('site_brand') }}</span>
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </span>
    </button>
    <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
      <ul class="navbar-nav ms-auto">
        @foreach ($menus as $menu )
            @if($menu->slug == 'berita')
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="/berita" class="nav-link ps-2 d-flex justify-content-start cursor-pointer align-items-center font-weight-semibold text-dark" id="dropdownMenuPages5" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas {{ $menu->icon }} me-2 text-md"></i>{{ $menu->name }}
                    </a>
                    <div class="dropdown-menu ms-n3 dropdown-menu-animation dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages5">
                            <a class="nav-link text-dark me-2" href="{{ route('berita.index') }}">
                            <i class="fas fa-list me-2 text-md"></i>Daftar Berita</a>
                        @if($menu->children->count() > 0)
                            @foreach ($menu->children as $submenu)
                                <a class="nav-link text-dark me-2" href="{{ route('pages', $submenu->slug) }}">
                                <i class="fas {{ $submenu->icon }} me-2 text-md"></i>{{ $submenu->name }}</a>
                            @endforeach
                        @endif
                        
                        @foreach ($post_categories as $pc)
                            <a class="nav-link text-dark me-2" href="{{ route('berita.category', $pc->slug) }}">
                            <i class="fas {{ $pc->icon }} me-2 text-md"></i>{{ $pc->name }}</a>
                        @endforeach
                    </div>
                </li>
            @elseif($menu->slug == 'social-media')
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-start cursor-pointer align-items-center font-weight-semibold text-dark" id="dropdownMenuPages6" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas {{ $menu->icon }} me-2 text-md"></i>{{ $menu->name }}
                    </a>
                    <div class="dropdown-menu ms-n3 dropdown-menu-animation dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages6">
                        @if($menu->children->count() > 0)
                             @foreach ($menu->children as $submenu)
                                <a class="nav-link text-dark me-2" href="{{ route('pages', $submenu->slug) }}">
                                <i class="fas {{ $submenu->icon }} me-2 text-md"></i>{{ $submenu->name }}</a>
                            @endforeach
                        @endif
                        @foreach ($socials as $social)
                            <a class="nav-link text-dark me-2" href="{{ $social->url }}" target="_blank">
                            <i class="{{ $social->icon }} me-2 text-md"></i>{{ $social->name }}</a>
                        @endforeach
                    </div>
                </li>
            @elseif($menu->page->count() > 0)
                {{-- For submenus --}}
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-start cursor-pointer align-items-center font-weight-semibold text-dark" id="dropdownMenuPages{{ $menu->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas {{ $menu->icon }} me-2 text-md"></i>{{ $menu->name }}
                    </a>
                    <div class="dropdown-menu ms-n3 dropdown-menu-animation dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages{{ $menu->id }}">
                        {{-- Loop through submenus --}}
                        @php $menuCount = 0; @endphp
                        @forelse ($menu->page as $submenu)
                            @if($submenu->is_active)
                                @php $menuCount++; @endphp
                                <a class="nav-link text-dark me-2" href="{{ route('pages', $submenu->slug) }}">
                                <i class="fas {{ $submenu->icon }} me-2 text-md"></i>{{ $submenu->title }}</a>
                            @endif
                        @endforeach
                        @if($menuCount == 0)
                            <span class="badge bg-secondary text-white">halaman tidak aktif</span>
                        @endif
                    </div>
                </li>
            @elseif($menu->children->count() > 0)
                {{-- For submenus --}}
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-start cursor-pointer align-items-center font-weight-semibold text-dark" id="dropdownMenuPages{{ $menu->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas {{ $menu->icon }} me-2 text-md"></i>{{ $menu->name }}
                    </a>
                    <div class="dropdown-menu ms-n3 dropdown-menu-animation dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages{{ $menu->id }}">
                        {{-- Loop through submenus --}}
                        @foreach ($menu->children as $submenu)
                            <a class="nav-link text-dark me-2" href="{{ route('pages', $submenu->slug) }}">
                            <i class="fas {{ $submenu->icon }} me-2 text-md"></i>{{ $submenu->name }}</a>
                        @endforeach
                    </div>
                </li>
            @elseif(!$menu->parent_id)
                {{-- For top-level menu items without submenus --}}
                <li class="nav-item mx-2">
                    <a class="nav-link text-dark me-2" href="{{ route("pages", $menu->slug) }}">
                        <i class="fas {{ $menu->icon }} me-2 text-md"></i>{{ $menu->name }}</a>
                </li>
            @endif
        @endforeach
      </ul>
    </div>
  </div>
</nav>
