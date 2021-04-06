<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facial extends Model
{
    protected $table = 'facial';
    protected $fillable = ['namafacial', 'manfaatfacial', 'hargafacial'];

    public function rekammedis()
    {
        return $this->hasMany(Rekammedis::class);
    }
}
