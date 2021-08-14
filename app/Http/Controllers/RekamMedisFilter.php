<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekamMedisFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data_rekammedis = \App\Models\Rekammedis::orderBy('id', 'desc')->whereBetween('created_at', [$request->dari_tgl, $request->sampai_tgl])->get();
        $psn = \App\Models\Pasien::all();
        $tndkn = \App\Models\Tindakan::all();
        $fcl = \App\Models\Facial::all();
        return view('rekammedis.index', ['data_rekammedis' => $data_rekammedis, 'start_date' => $request->dari_tgl, 'end_date' => $request->sampai_tgl], compact('psn', 'tndkn', 'fcl'));
    }
}
