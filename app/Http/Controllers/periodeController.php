<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;

class periodeController extends Controller
{
    public function index() {
        return view('periode.index');
    }

    public function getData() {
        $data = Periode::get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function insertData(Request $request) {
        $periode = new Periode;
        $periode->nama_periode = $request->input('nama_periode');
        $periode->periode_awal = $request->input('periode_awal');
        $periode->periode_akhir = $request->input('periode_akhir');
        $periode->tahun = $request->input('tahun');
        $status = $periode->save();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataById($id) {
        $data = Periode::find($id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function updateData(Request $request) {
        $id = $request->input('id');
        $periode = Periode::find($id);
        $periode->nama_periode = $request->input('nama_periode');
        $periode->periode_awal = $request->input('periode_awal');
        $periode->periode_akhir = $request->input('periode_akhir');
        $periode->tahun = $request->input('tahun');
        $status = $periode->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id) {
        $periode = Periode::find($id);
        $status = $periode->delete();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
