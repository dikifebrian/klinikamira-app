@csrf
<input type="hidden" name="id" id="id">
<div class="form-group">
    <h6 for="name">Nama</h6>
    <input name="name" type="text" class="form-control" id="name" placeholder="Masukan Nama Pengguna">
</div>
<div class="form-group">
    <h6 for="level">Level</h6>
    <select name="level" class="form-control" id="level">
        <option disabled selected>-Pilih Level-</option>
        <option value="manajer">Manajer</option>
        <option value="dokter">Dokter</option>
        <option value="kasir">Kasir</option>
        <option value="terapis">Terapis</option>
    </select>
</div>
<div class="form-group">
    <h6 for="email">Email</h6>
    <input name="email" type="email" class="form-control" id="email" placeholder="Masukan Email Pengguna">
</div>
<div class="form-group">
    <h6 for="password">Password</h6>
    <input name="password" type="password" class="form-control" id="password" placeholder="Masukan Password Pengguna">
</div>
<div class="form-group">
    <h6 for="password_confirmation">Konfirmasi Password</h6>
    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Masukan Password Pengguna">
</div>
