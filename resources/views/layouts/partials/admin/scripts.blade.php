<!-- jQuery Core -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.29.2/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="@cachebust('vendor/tinymce/tinymce.min.js')"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Theme JS -->
<script src="@cachebust('assets/dashui/js/main.js')"></script>
<script src="@cachebust('assets/dashui/js/feather.js')"></script>
<script src="@cachebust('assets/dashui/js/sidebarMenu.js')"></script>
<script src="@cachebust('assets/js/tinymce-config.js')"></script>
<script>
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

<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            responsive: true
        });
    });
</script>
@yield('custom-js')
