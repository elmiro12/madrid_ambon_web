<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.admin.head')
<body>
    <div id="db-wrapper">
        @include('layouts.partials.admin.sidebar') <!-- Sidebar Admin -->
        <div id="page-content">
            @include('layouts.partials.admin.navbar') <!-- Navbar Admin -->
            <div class="bg-primary pt-10 pb-21"></div>
            <div class="container-fluid mt-n22 px-6">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mb-2 mb-lg-0">
                                <h3 class="mb-0  text-white">@yield('title')</h3>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('card-content') <!-- Card Content -->
                <div class="row mt-6">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.partials.admin.footer') <!-- Footer -->
            </div>
        </div>
    </div>
    @include('layouts.partials.admin.scripts') <!-- Scripts -->
</body>
</html>
