<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        $data_pasien = \App\Models\Pasien::orderBy('id', 'desc')->whereBetween('created_at', [$request->dari_tgl, $request->sampai_tgl])->get();
        return view('pasien.index', ['data_pasien' => $data_pasien, 'start_date' => $request->dari_tgl, 'end_date' => $request->sampai_tgl]);
    }
}
