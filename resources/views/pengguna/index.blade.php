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
                    <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#tambahpengguna">
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
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editpengguna">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </button>
                            :
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapuspengguna">
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

{{-- Modah  Tambah --}}
<div class="modal fade" id="tambahpengguna">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pengguna.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                @include('pengguna.form')
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary swalDefaultSuccess">Tambahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Modah  Tambah --}}

{{-- Modah  Edit --}}
{{-- <div class="modal fade" id="editpengguna">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pasien.update','test')}}" method="POST">
            {{ method_field('patch') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="pasien_id" id="psn_id" value="">
                @include('pasien.form')
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-info swalDefaultInfo">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
{{-- Modah  Edit --}}

{{-- Modah  Hapus --}}
{{-- <div class="modal fade" id="hapuspengguna">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus Data Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pasien.destroy','test')}}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="pasien_id" id="psn_id" value="">
                <h6>Apakah anda yakin, ingin menghapus data ini?</h6>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-danger swalDefaultError">Ya, Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
{{-- Modah  Hapus --}}
@endsection

{{-- @push('scripts')
<script>
    $('#editpasien').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var namapasien = button.data('namapsn')
        var ttlpasien = button.data('ttlpsn')
        var jkpasien = button.data('jkpsn')
        var ktppasien = button.data('ktppsn')
        var telppasien = button.data('telppsn')
        var alamatpasien = button.data('alamatpsn')
        var psn_id = button.data('psn_id')

        var modal=$(this)
        modal.find('.modal-body #namapasien').val(namapasien);
        modal.find('.modal-body #ttlpasien').val(ttlpasien);
        modal.find('.modal-body #jkpasien').val(jkpasien);
        modal.find('.modal-body #ktppasien').val(ktppasien);
        modal.find('.modal-body #telppasien').val(telppasien);
        modal.find('.modal-body #alamatpasien').val(alamatpasien);
        modal.find('.modal-body #psn_id').val(psn_id);
    })

    $('#hapuspasien').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var psn_id = button.data('psn_id')

        var modal=$(this)
        modal.find('.modal-body #psn_id').val(psn_id);
    })
</script>
@endpush --}}