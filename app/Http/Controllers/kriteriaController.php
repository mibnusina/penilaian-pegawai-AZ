<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class kriteriaController extends Controller
{
    public function index() {
        return view('kriteria.index');
    }

    public function getData() {
        $data = Kriteria::orderBy('id')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function insertData(Request $request) {
        $kriteria = new Kriteria;
        $kriteria->nama_kriteria = $request->input('nama_kriteria');
        $status = $kriteria->save();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataById($id) {
        $data = Kriteria::find($id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function updateData(Request $request) {
        $id = $request->input('id');
        $kriteria = Kriteria::find($id);
        $kriteria->nama_kriteria = $request->input('nama_kriteria');

        $status = $kriteria->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id) {
        $kriteria = Kriteria::find($id);
        $status = $kriteria->delete();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function approveData(Request $request) {
        $kriteriaId = $request->input('kriteria_id');

        $update = Kriteria::find($kriteriaId);
        $update->is_approved = true;
        $status = $update->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function tolakData(Request $request) {
        $kriteriaId = $request->input('kriteria_id');

        $update = Kriteria::find($kriteriaId);
        $update->is_approved = false;
        $status = $update->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
