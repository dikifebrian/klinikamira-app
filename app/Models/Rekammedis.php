<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekammedis extends Model
{
    protected $table = 'rekammedis';
    protected $fillable = ['tglrekammedis', 'jkrekammedis', 'pprekammedis', 'rpksrekammedis', 'psrekammedis', 'pasien_id', 'tindakan_id', 'facial_id', 'produk_id'];
    protected $dates = ['tglrekammedis'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }

    public function facial()
    {
        return $this->belongsTo(Facial::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
