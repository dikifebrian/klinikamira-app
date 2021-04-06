<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['namaproduk', 'manfaatproduk', 'jenisproduk', 'hargaproduk'];

    public function rekammedis()
    {
        return $this->hasMany(Rekammedis::class);
    }
}
