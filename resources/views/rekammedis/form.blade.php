<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mb-3">
        <h6 for="pasien_id">Nama Pasien</h6>
        <select name="pasien_id" type="text" class="form-control" id="pasien_id">
            <option disabled selected>Pilih Nama Pasien</option>
            @foreach ($psn as $item)
            <option value="{{$item->id}}">{{$item->namapasien}}</option>
            @endforeach
        </select>
        </div>
        <div class="col-md-4 mb-3">
            <h6 for="jkrekammedis">Jenis Kulit</h6>
            <textarea name="jkrekammedis" rows="1" class="form-control" id="jkrekammedis"></textarea>
        </div>
        <div class="col-md-4 mb-3">
            <h6 for="pprekammedis">Pori - Pori</h6>
            <textarea name="pprekammedis" rows="1" class="form-control" id="pprekammedis"></textarea>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-5 mb-3">
            <h6 for="rpksrekammedis">Riwayat Pemakaian Krim Sebelumnya</h6>
            <select name="rpksrekammedis" class="form-control" id="rpksrekammedis">
                <option value="Tidak Ada">Tidak Ada</option>
                <option value="Dr">Dokter</option>
                <option value="Mercury">Mercury</option>
            </select>
        </div>
        <div class="col-md-7 mb-3">
            <h6 for="psrekammedis">Problem Sekarang</h6>
            <textarea name="psrekammedis" class="form-control" rows="1" id="psrekammedis"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <h6 for="tindakan_id">Tindakan</h6>
            <select name="tindakan_id" type="text" class="form-control" id="tindakan_id">
                <option disabled selected>Pilih Tindakan</option>
                <option value="kosong">-</option>
                @foreach ($tndkn as $item)
                <option value="{{$item->id}}">{{$item->namatindakan}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <h6 for="facial_id">Facial</h6>
            <select name="facial_id" type="text" class="form-control" id="facial_id">
                <option disabled selected>Pilih Facial</option>
                <option value="kosong">-</option>
                @foreach ($fcl as $item)
                <option value="{{$item->id}}">{{$item->namafacial}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <h6 for="prdkrekammedis">Produk</h6>
            <textarea name="prdkrekammedis" class="form-control" rows="1" id="prdkrekammedis"></textarea>
        </div>
    </div>
</div>
