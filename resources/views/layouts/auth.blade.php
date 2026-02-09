<!DOCTYPE html>
<html lang="id">
    @include('layouts.partials.public.head')
<body class="g-sidenav-show bg-gradient-warning" style="background-image: url('{{ asset("assets/img/bg-web.jpg") }}');background-size: cover; background-position: center;">
    @include('layouts.partials.public.navbar')
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto my-auto">
                    @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.partials.public.footer')
    <!--   Core JS Files   -->
    @include('layouts.partials.public.scripts')
    @include('layouts.partials.public.form-scripts')
</body>
</html>
