@extends('layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekam Medis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Rekam Medis</li>
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
                                    <h3 class="card-title">Data Rekam Medis</h3>
                                </div>
                                <div class="col text-right">
                                    @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter")
                                    <button type="button" class="btn btn-primary btn-xs mb-1" data-toggle="modal" data-target="#tambahrekammedis">
                                        <i class="fas fa-plus-circle"></i>
                                        Tambah Rekam Medis
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->level=="manajer")
                            <div class="col mb-1">
                                <form action="/rekammedis-filter" method="post">
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
                            @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 3%">#</th>
                                        <th rowspan="2" style="width: 7%" class="text-center">TGL</th>
                                        <th rowspan="2">Nama Pasien</th>
                                        <th colspan="4" class="text-center">Keluhan</th>
                                        <th colspan="3" class="text-center">Keterangan</th>
                                        @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter" || auth()->user()->level=="terapis")
                                        <th rowspan="2" style="width: 7%" class="text-center">Status Perawatan</th>
                                        @endif
                                        @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter")
                                        <th rowspan="2" style="width: 10%" class="text-center">Aksi</th>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th style="width: 10%">Jenis Kulit</th>
                                        <th style="width: 9%">Pori-Pori</th>
                                        <th style="width: 8%">RPKS</th>
                                        <th>Problem Sekarang</th>
                                        <th style="width: 9%">Tindakan</th>
                                        <th style="width: 9%">Facial</th>
                                        <th style="width: 12%">Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_rekammedis as $rekammedis)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="text-center">{{$rekammedis->created_at->format('d-m-Y')}}</td>
                                        <td>{{$rekammedis->pasien->namapasien}}</td>
                                        <td>{{$rekammedis->jkrekammedis}}</td>
                                        <td>{{$rekammedis->pprekammedis}}</td>
                                        <td>{{$rekammedis->rpksrekammedis}}</td>
                                        <td>{{$rekammedis->psrekammedis}}</td>
                                        <td>{{ isset($rekammedis->tindakan->namatindakan) ? $rekammedis->tindakan->namatindakan : '-'}}</td>
                                        <td>{{ isset($rekammedis->facial->namafacial) ? $rekammedis->facial->namafacial : '-'}}</td>
                                        <td>{{$rekammedis->prdkrekammedis}}</td>
                                        @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter" || auth()->user()->level=="terapis")
                                        <td class="project-actions text-center">
                                            @if ($rekammedis->statusperawatan)
                                            <button class="btn btn-sm btn-success">
                                                Sudah
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-secondary btn-sm btn-secondary" data-toggle="modal" data-target="#status" data-id="{{$rekammedis->id}}" data-statusperawatan="{{$rekammedis->statusperawatan}}">
                                                Belum
                                            </button>
                                            @endif
                                        </td>
                                        @endif
                                        @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter")
                                        @if (!$rekammedis->statusperawatan)
                                        <td class="project-actions text-center">
                                            <button type="button" class="btn btn-info btn-sm" data-remed_id="{{$rekammedis->id}}" data-nmpasien="{{$rekammedis->pasien_id}}" data-jkremed="{{$rekammedis->jkrekammedis}}" data-ppremed="{{$rekammedis->pprekammedis}}" data-rpksremed="{{$rekammedis->rpksrekammedis}}" data-psremed="{{$rekammedis->psrekammedis}}" data-nmtindakan="{{$rekammedis->tindakan_id}}" data-nmfacial="{{$rekammedis->facial_id}}" data-prdkremed="{{$rekammedis->prdkrekammedis}}" data-toggle="modal" data-target="#editrekammedis">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            :
                                            <button type="button" class="btn btn-danger btn-sm" data-remed_id="{{$rekammedis->id}}" data-toggle="modal" data-target="#hapusrekammedis">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        @else
                                        <td class="text-center">-</td>
                                        @endif
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

{{-- Modal  Tambah --}}
<div class="modal fade" id="tambahrekammedis">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Rekam Medis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('rekammedis.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    @include('rekammedis.form')
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary swalDefaultSuccess">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal  Tambah --}}

{{-- Modal  Edit --}}
<div class="modal fade" id="editrekammedis">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Rekam Medis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('rekammedis.update','test')}}" method="POST">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="rekammedis_id" id="remed_id" value="">
                    @include('rekammedis.form')
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-info swalDefaultInfo">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal  Edit --}}

{{-- Modal  Hapus --}}
<div class="modal fade" id="hapusrekammedis">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus Data Rekam Medis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('rekammedis.destroy','test')}}" method="POST">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="rekammedis_id" id="remed_id" value="">
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
{{-- Modal Hapus --}}

{{-- Modal  Status --}}
<div class="modal fade" id="status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Status Perawatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('rekammedis.put','test')}}" method="POST">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="rekammedis_id" id="remed_id">
                    <input type="hidden" name="rekammedis_status" id="remed_status">
                    <h6>Perawatan Sudah Dilakukan?</h6>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-success">Ya, Sudah</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal  Status --}}
@endsection

@push('scripts')
<script>
    $('#editrekammedis').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var pasien_id = button.data('nmpasien')
        var jkrekammedis = button.data('jkremed')
        var pprekammedis = button.data('ppremed')
        var rpksrekammedis = button.data('rpksremed')
        var psrekammedis = button.data('psremed')
        var remed_id = button.data('remed_id')
        var tindakan_id = button.data('nmtindakan')
        var facial_id = button.data('nmfacial')
        var prdkrekammedis = button.data('prdkremed')

        var modal = $(this)
        modal.find('.modal-body #pasien_id').val(pasien_id);
        modal.find('.modal-body #jkrekammedis').val(jkrekammedis);
        modal.find('.modal-body #pprekammedis').val(pprekammedis);
        modal.find('.modal-body #rpksrekammedis').val(rpksrekammedis);
        modal.find('.modal-body #psrekammedis').val(psrekammedis);
        modal.find('.modal-body #remed_id').val(remed_id);
        modal.find('.modal-body #tindakan_id').val(tindakan_id);
        modal.find('.modal-body #facial_id').val(facial_id);
        modal.find('.modal-body #prdkrekammedis').val(prdkrekammedis);
    })

    $('#hapusrekammedis').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var remed_id = button.data('remed_id')

        var modal = $(this)
        modal.find('.modal-body #remed_id').val(remed_id);
    })

    $('#status').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var remed_id = button.data('id')
        var remed_statusperawatan = button.data('statusperawatan')

        var modal = $(this)
        modal.find('.modal-body #remed_id').val(remed_id);
        modal.find('.modal-body #remed_status').val(remed_statusperawatan);
    })

</script>
@endpush
