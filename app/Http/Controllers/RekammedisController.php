<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Facial;
use App\Models\Tindakan;
use App\Models\Pasien;
use App\Models\Rekammedis;
use Illuminate\Http\Request;

class RekammedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_rekammedis = \App\Models\Rekammedis::orderBy('id', 'desc')->get();
        $psn = \App\Models\Pasien::all();
        $tndkn = \App\Models\Tindakan::all();
        $fcl = \App\Models\Facial::all();
        $prdk = \App\Models\Produk::all();
        return view('rekammedis.index', ['data_rekammedis' => $data_rekammedis], compact('psn', 'tndkn', 'fcl', 'prdk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->tindakan_id === 'kosong' && $request->facial_id === 'kosong') {
            Rekammedis::create($request->except('tindakan_id', 'facial_id'));
        } elseif ($request->tindakan_id !== 'kosong' && $request->facial_id === 'kosong') {
            Rekammedis::create($request->except('facial_id'));
        } elseif ($request->tindakan_id === 'kosong' && $request->facial_id !== 'kosong') {
            Rekammedis::create($request->except('tindakan_id'));
        } else {
            Rekammedis::create($request->all());
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $remed = Rekammedis::findOrFail($request->rekammedis_id);
        if ($request->tindakan_id === 'kosong' && $request->facial_id === 'kosong') {
            $input = $request->all();
            $input['tindakan_id'] = null;
            $input['facial_id'] = null;
            $remed->update($input);
        } elseif ($request->tindakan_id !== 'kosong' && $request->facial_id === 'kosong') {
            $input = $request->all();
            $input['facial_id'] = null;
            $remed->update($input);
        } elseif ($request->tindakan_id === 'kosong' && $request->facial_id !== 'kosong') {
            $input = $request->all();
            $input['tindakan_id'] = null;
            $remed->update($input);
        } else {
            $remed->update($request->all());
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $remed = Rekammedis::findOrFail($request->rekammedis_id);
        $remed->delete();

        return back();
    }
}
