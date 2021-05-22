<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amira Aesthetic Clinic Pandeglang</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('style/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('style/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('style/plugins/toastr/toastr.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('style/plugins/dropzone/min/dropzone.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('style/dist/css/adminlte.min.css') }}">

</head>
<body class="accent-olive sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('layout.includes.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layout.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    
    <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('style/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('style/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('style/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('style/plugins/toastr/toastr.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('style/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('style/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('style/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('style/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('style/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('style/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('style/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('style/dist/js/demo.js') }}"></script>
<!-- Page specific script -->

<script>

    @if (auth()->user()->level=="manajer")
    $(function () {
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["csv", "excel", "pdf", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    @endif

    @if (auth()->user()->level=="kasir" || auth()->user()->level=="dokter")
    $(function () {
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    @endif

    $(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
        Toast.fire({
            icon: 'success',
            title: 'Data Berhasil Ditambahkan.'
        })
    });
    $('.swalDefaultInfo').click(function() {
        Toast.fire({
            icon: 'info',
            title: 'Data Berhasil Diubah.'
        })
    });
    $('.swalDefaultError').click(function() {
        Toast.fire({
            icon: 'error',
            title: 'Data Berhasil Dihapus.'
        })
    });
    });

    
</script>

@stack('scripts')

</body>
</html>
