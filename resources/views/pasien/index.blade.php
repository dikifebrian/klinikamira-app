@extends('layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Data Pasien</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Pasien</li>
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
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Data Pasien</h3>
                        </div>
                        <div class="col text-right">
                            @if (auth()->user()->level=="manajer" || auth()->user()->level=="kasir")
                            <button type="button" class="btn btn-primary btn-xs mb-1" data-toggle="modal" data-target="#tambahpasien">
                                <i class="fas fa-plus-circle"></i>
                                Tambah Pasien
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col mb-1">
                        <form action="/pasien-filter" method="post">
                            @csrf
                            <tr>
                                <td> Dari</td>
                                <td><input type="date" name="dari_tgl" required="required" value="{{isset($start_date) ? $start_date : ''}}"></td>
                                <td> Sampai </td>
                                <td><input type="date" name="sampai_tgl" required="required" value="{{isset($end_date) ? $end_date : ''}}"></td>
                                <td><input type="submit" class="btn btn-success btn-sm" value="Tampilkan"></td>
                            </tr>
                        </form>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 3%">#</th>
                        <th style="width: 7%" class="text-center">TGL</th>
                        <th style="width: 19%">Nama Pasien</th>
                        <th style="width: 13%">TTL</th>
                        <th style="width: 4%">JK</th>
                        <th style="width: 15%">No KTP</th>
                        <th style="width: 11%">No HP</th>
                        <th >Alamat</th>
                        @if (auth()->user()->level=="manajer" || auth()->user()->level=="kasir")
                        <th style="width: 10%" class="text-center">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data_pasien as $pasien)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-center">{{$pasien->created_at->format('d-m-Y')}}</td>
                        <td>{{$pasien->namapasien}}</td>
                        <td>{{$pasien->ttlpasien}}</td>
                        <td>{{$pasien->jkpasien}}</td>
                        <td>{{$pasien->ktppasien}}</td>
                        <td>{{$pasien->telppasien}}</td>
                        <td>{{$pasien->alamatpasien}}</td>
                        @if (auth()->user()->level=="manajer" || auth()->user()->level=="kasir")
                        <td class="project-actions text-center">
                            <button type="button" class="btn btn-info btn-sm" data-psn_id="{{$pasien->id}}" data-namapsn="{{$pasien->namapasien}}"
                                data-ttlpsn="{{$pasien->ttlpasien}}" data-jkpsn="{{$pasien->jkpasien}}" data-ktppsn="{{$pasien->ktppasien}}" data-telppsn="{{$pasien->telppasien}}" 
                                data-alamatpsn="{{$pasien->alamatpasien}}" data-toggle="modal" data-target="#editpasien">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            :
                            <button type="button" class="btn btn-danger btn-sm" data-psn_id="{{$pasien->id}}" data-toggle="modal" data-target="#hapuspasien">
                                <i class="fas fa-trash"></i>
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
<div class="modal fade" id="tambahpasien">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pasien.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                @include('pasien.form')
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
<div class="modal fade" id="editpasien">
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
</div>
{{-- Modah  Edit --}}

{{-- Modah  Hapus --}}
<div class="modal fade" id="hapuspasien">
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
</div>
{{-- Modah  Hapus --}}
@endsection

@push('scripts')
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
@endpush