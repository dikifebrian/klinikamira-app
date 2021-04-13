@extends('layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengguna</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pengguna</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm mb-1 btnTambah">
                                <i class="fas fa-plus"></i>
                                Tambah Pengguna
                            </button>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 4%">#</th>
                                        <th style="width: 30%">Nama</th>
                                        <th style="width: 15%">Level</th>
                                        <th>Email</th>
                                        <th style="width: 18%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_user as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->level}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="project-actions text-center">
                                            <button type="button" class="btn btn-info btn-sm btnEdit" data-id="{{$user->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </button>
                                            :
                                            <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="{{$user->id}}">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modah  Tambah Edit -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pengguna.store')}}" method="POST" id="myForm">
                <div class="modal-body">
                    @include('pengguna.form')
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary swalDefaultSuccess">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modah  Tambah Edit -->

@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.btnTambah', function () {
        $('#id').val(null); // value menjadi kosong
        $('#myForm').trigger("reset"); // mereset semua input yang ada di form
        $('#myModal').modal('show'); // menampilkan modal
        $('#modalTitle').html('Tambah Pengguna');
    });

    $('body').on('click', '.btnEdit', function () {
        let userId = $(this).data('id');
        $.get('/pengguna/' + userId, function (data) {
            $('#modalTitle').html('Edit Pengguna');
            $('#myModal').modal('show');
            //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#level').val(data.level);
            $('#password').removeAttr('required');
            $('#password_confirmation').removeAttr('required');
        })
    });

    $('body').on('click', '.btnDelete', function () {
        let userId = $(this).data('id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menghapus pengguna ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/pengguna/' + userId,
                    type: 'POST',
                    data: {
                        '_method': 'DELETE'
                    }
                });
                Swal.fire(
                    'Berhasil!',
                    'Data telah terhapus.',
                    'success'
                )
                setTimeout(function () {
                    location.href = '/pengguna';
                }, 1000)
            }
        })
    });

</script>
@endpush
