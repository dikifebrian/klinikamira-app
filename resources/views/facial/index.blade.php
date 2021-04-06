@extends('layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Jenis Perawatan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Jenis Perawatan</li>
                <li class="breadcrumb-item active">Data Facial</li>
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
                    <h3 class="card-title">Data Facial</h3>
                </div>
                <div class="card-body">
                    @if (auth()->user()->level=="manajer")
                    <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#tambahfacial">
                        <i class="fas fa-plus"></i>
                        Tambah Facial
                    </button>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 4%">#</th>
                        <th style="width: 30%">Nama Facial</th>
                        <th>Manfaat Facial</th>
                        <th style="width: 15%">Harga Facial</th>
                        @if (auth()->user()->level=="manajer")
                        <th style="width: 17%" class="text-center">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data_facial as $facial)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$facial->namafacial}}</td>
                        <td>{{$facial->manfaatfacial}}</td>
                        <td>{{$facial->hargafacial}}</td>
                        @if (auth()->user()->level=="manajer")
                        <td class="project-actions text-center">
                            <button type="button" class="btn btn-info btn-sm" data-fcl_id="{{$facial->id}}" data-namafcl="{{$facial->namafacial}}"
                                data-manfaatfcl="{{$facial->manfaatfacial}}" data-hargafcl="{{$facial->hargafacial}}" data-toggle="modal" data-target="#editfacial">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </button>
                            :
                            <button type="button" class="btn btn-danger btn-sm" data-fcl_id="{{$facial->id}}" data-toggle="modal" data-target="#hapusfacial">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </td>
                        @endif
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
<div class="modal fade" id="tambahfacial">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Facial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('facial.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                @include('facial.form')
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
<div class="modal fade" id="editfacial">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Facial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('facial.update','test')}}" method="POST">
            {{ method_field('patch') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="facial_id" id="fcl_id" value="">
                @include('facial.form')
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-info swalDefaultInfo">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Modah  Edit --}}

{{-- Modah  Hapus --}}
<div class="modal fade" id="hapusfacial">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus Data Facial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('facial.destroy','test')}}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="facial_id" id="fcl_id" value="">
                <h6>Apakah anda yakin, ingin menghapus data ini?</h6>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-danger swalDefaultError">Ya, Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Modah  Hapus --}}
@endsection

@push('scripts')
<script>
    $('#editfacial').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var namafacial = button.data('namafcl')
        var manfaatfacial = button.data('manfaatfcl')
        var hargafacial = button.data('hargafcl')
        var fcl_id = button.data('fcl_id')

        var modal=$(this)
        modal.find('.modal-body #namafacial').val(namafacial);
        modal.find('.modal-body #manfaatfacial').val(manfaatfacial);
        modal.find('.modal-body #hargafacial').val(hargafacial);
        modal.find('.modal-body #fcl_id').val(fcl_id);
    })

    $('#hapusfacial').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var fcl_id = button.data('fcl_id')

        var modal=$(this)
        modal.find('.modal-body #fcl_id').val(fcl_id);
    })
</script>
@endpush