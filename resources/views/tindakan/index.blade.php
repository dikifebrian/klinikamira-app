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
                <li class="breadcrumb-item active">Data Tindakan</li>
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
                    <h3 class="card-title">Data Tindakan</h3>
                </div>
                <div class="card-body">
                    @if (auth()->user()->level=="manajer")
                    <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#tambahtindakan">
                        <i class="fas fa-plus"></i>
                        Tambah Tindakan
                    </button>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 4%">#</th>
                        <th style="width: 30%">Nama Tindakan</th>
                        <th>Fungsi Tindakan</th>
                        <th style="width: 15%">Harga</th>
                        @if (auth()->user()->level=="manajer")
                        <th style="width: 17%" class="text-center">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data_tindakan as $tindakan)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$tindakan->namatindakan}}</td>
                        <td>{{$tindakan->fungsitindakan}}</td>
                        <td>{{$tindakan->hargatindakan}}</td>
                        @if (auth()->user()->level=="manajer")
                        <td class="project-actions text-center">
                            <button type="button" class="btn btn-info btn-sm" data-tndkn_id="{{$tindakan->id}}" data-namatndkn="{{$tindakan->namatindakan}}"
                                data-fungsitndkn="{{$tindakan->fungsitindakan}}" data-hargatndkn="{{$tindakan->hargatindakan}}" data-toggle="modal" data-target="#edittindakan">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </button>
                            :
                            <button type="button" class="btn btn-danger btn-sm" data-tndkn_id="{{$tindakan->id}}" data-toggle="modal" data-target="#hapustindakan">
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
<div class="modal fade" id="tambahtindakan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Tindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('tindakan.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                @include('tindakan.form')
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
<div class="modal fade" id="edittindakan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Tindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('tindakan.update','test')}}" method="POST">
            {{ method_field('patch') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="tindakan_id" id="tndkn_id" value="">
                @include('tindakan.form')
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
<div class="modal fade" id="hapustindakan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus Data Tindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('tindakan.destroy','test')}}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="tindakan_id" id="tndkn_id" value="">
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
    $('#edittindakan').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var namatindakan = button.data('namatndkn')
        var fungsitindakan = button.data('fungsitndkn')
        var hargatindakan = button.data('hargatndkn')
        var tndkn_id = button.data('tndkn_id')

        var modal=$(this)
        modal.find('.modal-body #namatindakan').val(namatindakan);
        modal.find('.modal-body #fungsitindakan').val(fungsitindakan);
        modal.find('.modal-body #hargatindakan').val(hargatindakan);
        modal.find('.modal-body #tndkn_id').val(tndkn_id);
    })

    $('#hapustindakan').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var tndkn_id = button.data('tndkn_id')

        var modal=$(this)
        modal.find('.modal-body #tndkn_id').val(tndkn_id);
    })
</script>
@endpush
