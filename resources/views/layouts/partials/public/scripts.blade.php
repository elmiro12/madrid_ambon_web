<!-- jQuery Core -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!--   Core JS Files   -->
<script src="@cachebust('assets/material-kit/js/core/popper.min.js')" type="text/javascript"></script>
<script src="@cachebust('assets/material-kit/js/core/bootstrap.min.js')" type="text/javascript"></script>
<script src="@cachebust('assets/material-kit/js/plugins/perfect-scrollbar.min.js')"></script>
<script src="@cachebust('assets/material-kit/js/plugins/parallax.min.js')"></script>
<script src="@cachebust('assets/material-kit/js/material-kit.min.js')" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="@cachebust('assets/js/custom.js')"></script>

<script>
    $(document).ready(function() {
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 1200, // Animation duration in milliseconds
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(event) {
            event.preventDefault();
            var target = this.hash;
            if (target) {
                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 800);
            }
        });
    });

    @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000 // Auto-close after 3 seconds
            });
    @endif
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal!',
            html: {!! implode('<br>', $errors->all()) !!},
            confirmButtonText: 'OK'
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            html: {!! session('error') !!},
            confirmButtonText: 'OK'
        });
    @endif
</script>
@yield('custom-js')
