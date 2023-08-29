<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

use Hash;

class pegawaiController extends Controller
{
    public function index() {
        return view('pegawai.index');
    }

    public function getData() {
        $data = User::select('users.*', 'jabatan.nama_jabatan', 'lokasi.nama_lokasi')
                ->leftJoin('jabatan', 'users.jabatan', '=', 'jabatan.id')
                ->leftJoin('lokasi', 'users.lokasi_id', '=', 'lokasi.id')
                ->orderBy('users.id')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function insertData(Request $request) {
        $user = new User;
        $user->nik = $request->input('nik');
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->jabatan = $request->input('jabatan');
        $user->status = $request->input('status');
        $user->lokasi_id = $request->input('lokasi');
        $status = $user->save();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataById($id) {
        $data = User::find($id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataByLokasi() {
        $data = User::where('lokasi_id', Auth::user()->lokasi_id)->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function updateData(Request $request) {
        $id = $request->input('id');
        $user = User::find($id);
        $user->nik = $request->input('nik');
        $user->name = $request->input('name');
        $user->username = $request->input('username');

        if ($request->input('password') != '') {
            $user->password = Hash::make($request->input('password'));
        }

        $user->jabatan = $request->input('jabatan');
        $user->status = $request->input('status');
        $user->lokasi_id = $request->input('lokasi');
        $status = $user->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id) {
        $user = User::find($id);
        $status = $user->delete();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
