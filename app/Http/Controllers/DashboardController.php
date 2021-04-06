<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Rekammedis;
use App\Models\User;
use App\Models\Tindakan;
use App\Models\Facial;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jumlah_pasien = Pasien::all()->count();
        $jumlah_rekammedis = Rekammedis::all()->count();
        $jumlah_user = User::all()->count();
        $jumlah_produk = Produk::all()->count();
        $jumlah_tindakan = Tindakan::all()->count();
        $jumlah_facial = Facial::all()->count();

        return view('dashboard.index')->with('jumlah_pasien', $jumlah_pasien)->with('jumlah_rekammedis', $jumlah_rekammedis)->with('jumlah_user', $jumlah_user)->with('jumlah_produk', $jumlah_produk)->with('jumlah_tindakan', $jumlah_tindakan)->with('jumlah_facial', $jumlah_facial);
    }
}
