<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = ['namapasien', 'ttlpasien', 'jkpasien', 'ktppasien', 'telppasien', 'alamatpasien'];

    public function rekammedis()
    {
        return $this->hasMany(Rekammedis::class);
    }
}
