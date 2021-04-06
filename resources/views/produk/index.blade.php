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
                <li class="breadcrumb-item active">Data Produk</li>
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
                    <h3 class="card-title">Data Produk</h3>
                </div>
                <div class="card-body">
                    @if (auth()->user()->level=="manajer")
                    <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#tambahproduk">
                        <i class="fas fa-plus"></i>
                        Tambah Produk
                    </button>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 4%">#</th>
                        <th style="width: 20%">Nama Produk</th>
                        <th>Manfaat Produk</th>
                        <th style="width: 15%">Jenis Produk</th>
                        <th style="width: 15%">Harga Produk</th>
                        @if (auth()->user()->level=="manajer")
                        <th style="width: 16%" class="text-center">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data_produk as $produk)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$produk->namaproduk}}</td>
                        <td>{{$produk->manfaatproduk}}</td>
                        <td>{{$produk->jenisproduk}}</td>
                        <td>{{$produk->hargaproduk}}</td>
                        @if (auth()->user()->level=="manajer")
                        <td class="project-actions text-center">
                            <button type="button" class="btn btn-info btn-sm" data-prdk_id="{{$produk->id}}" data-namaprdk="{{$produk->namaproduk}}"
                                data-manfaatprdk="{{$produk->manfaatproduk}}" data-jenisprdk="{{$produk->jenisproduk}}" data-hargaprdk="{{$produk->hargaproduk}}" data-toggle="modal" data-target="#editproduk">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </button>
                            :
                            <button type="button" class="btn btn-danger btn-sm" data-prdk_id="{{$produk->id}}" data-toggle="modal" data-target="#hapusproduk">
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
<div class="modal fade" id="tambahproduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('produk.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                @include('produk.form')
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
<div class="modal fade" id="editproduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('produk.update','test')}}" method="POST">
            {{ method_field('patch') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="produk_id" id="prdk_id" value="">
                @include('produk.form')
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
<div class="modal fade" id="hapusproduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('produk.destroy','test')}}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="produk_id" id="prdk_id" value="">
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
    $('#editproduk').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var namaproduk = button.data('namaprdk')
        var manfaatproduk = button.data('manfaatprdk')
        var jenisproduk = button.data('jenisprdk')
        var hargaproduk = button.data('hargaprdk')
        var prdk_id = button.data('prdk_id')

        var modal=$(this)
        modal.find('.modal-body #namaproduk').val(namaproduk);
        modal.find('.modal-body #manfaatproduk').val(manfaatproduk);
        modal.find('.modal-body #jenisproduk').val(jenisproduk);
        modal.find('.modal-body #hargaproduk').val(hargaproduk);
        modal.find('.modal-body #prdk_id').val(prdk_id);
    })

    $('#hapusproduk').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var prdk_id = button.data('prdk_id')

        var modal=$(this)
        modal.find('.modal-body #prdk_id').val(prdk_id);
    })
</script>
@endpush