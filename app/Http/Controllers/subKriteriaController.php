<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteria;

class subKriteriaController extends Controller
{
    public function index() {
        return view('sub-kriteria.index');
    }

    public function indexKriteriaId($kriteria_id) {
        return view('sub-kriteria.index-kriteria', ['kriteria_id' => $kriteria_id]);
    }

    public function getData($kriteria_id) {
        $data = SubKriteria::where('kriteria_id', $kriteria_id)->orderBy('id')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function insertData(Request $request) {
        $sub_kriteria = new SubKriteria;
        $sub_kriteria->nama_sub_kriteria = $request->input('nama_sub_kriteria');
        $sub_kriteria->kriteria_id = $request->input('kriteria_id');
        $sub_kriteria->kode = $request->input('kode');
        $status = $sub_kriteria->save();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataById($id) {
        $data = SubKriteria::find($id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function updateData(Request $request) {
        $id = $request->input('id');
        $sub_kriteria = SubKriteria::find($id);
        $sub_kriteria->nama_sub_kriteria = $request->input('nama_sub_kriteria');
        $sub_kriteria->kode = $request->input('kode');

        $status = $sub_kriteria->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id) {
        $sub_kriteria = SubKriteria::find($id);
        $status = $sub_kriteria->delete();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}