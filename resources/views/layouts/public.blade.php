<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.public.head')

<body class="index-page">
  @include('layouts.partials.public.navbar')

  <div class="main-content mt-0" style="background-image: url('{{ asset("assets/img/bg-web.jpg") }}');background-size: cover; background-position: center;">
        @yield('page-header')
        @yield('content')
        @include('layouts.partials.public.footer')
  </div>
  @include('layouts.partials.public.scripts')
</body>
</html>
