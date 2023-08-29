<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class lokasiController extends Controller
{
    public function index() {
        return view('lokasi.index');
    }

    public function getData() {
        $data = Lokasi::get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function insertData(Request $request) {
        $lokasi = new Lokasi;
        $lokasi->nama_lokasi = $request->input('nama_lokasi');
        $status = $lokasi->save();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataById($id) {
        $data = Lokasi::find($id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function updateData(Request $request) {
        $id = $request->input('id');
        $lokasi = Lokasi::find($id);
        $lokasi->nama_lokasi = $request->input('nama_lokasi');
        $status = $lokasi->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id) {
        $lokasi = Lokasi::find($id);
        $status = $lokasi->delete();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
