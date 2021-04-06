<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $table = 'tindakan';
    protected $fillable = ['namatindakan', 'fungsitindakan', 'hargatindakan'];

    public function rekammedis()
    {
        return $this->hasMany(Rekammedis::class);
    }
}
