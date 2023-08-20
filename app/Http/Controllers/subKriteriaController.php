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

    public function kriteriaSubKriteria() {
        $data = SubKriteria::select('sub_kriteria.*', 'kriteria.nama_kriteria')->leftJoin('kriteria', 'sub_kriteria.kriteria_id', '=', 'kriteria.id')->where('sub_kriteria.is_approved', true)->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function approveData(Request $request) {
        $subKriteriaId = $request->input('sub_kriteria_id');

        $update = SubKriteria::find($subKriteriaId);
        $update->is_approved = true;
        $status = $update->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function tolakData(Request $request) {
        $subKriteriaId = $request->input('sub_kriteria_id');

        $update = SubKriteria::find($subKriteriaId);
        $update->is_approved = false;
        $status = $update->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
