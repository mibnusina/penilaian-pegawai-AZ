<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class jabatanController extends Controller
{
    public function index() {
        return view('jabatan.index');
    }

    public function getData() {
        $data = Jabatan::orderBy('id')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function insertData(Request $request) {
        $jabatan = new Jabatan;
        $jabatan->nama_jabatan = $request->input('nama_jabatan');
        $status = $jabatan->save();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataById($id) {
        $data = Jabatan::find($id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function updateData(Request $request) {
        $id = $request->input('id');
        $jabatan = Jabatan::find($id);
        $jabatan->nama_jabatan = $request->input('nama_jabatan');

        $status = $jabatan->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id) {
        $jabatan = Jabatan::find($id);
        $status = $jabatan->delete();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
