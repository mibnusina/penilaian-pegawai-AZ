<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\SubKriteria;

class penilaianController extends Controller
{
    public function index() {
        return view('penilaian.index');
    }

    public function indexPeriodeId($periodeId) {
        return view('penilaian.index-periode', ['periode_id' => $periodeId]);
    }

    public function dataPenilaianByPeriodeId($periodeId) {
        $data = Penilaian::select('penilaian_pegawai.*', 'users.name')
                            ->leftJoin('users', 'penilaian_pegawai.user_id', '=', 'users.id')
                            ->where('penilaian_pegawai.periode_id', $periodeId)->get();

        $dataResult = [];
        foreach ($data as $value) {
            $penilaianId = $value->id;

            $nilaiAkhir = $this->hitungNilaiAkhir($penilaianId);

            $dataResult[] = [
                'id' => $value->id,
                'name' => $value->name,
                'periode_id' => $periodeId,
                'nilai_akhir' => $nilaiAkhir,
                'status' => $value->status
            ];
        }

        // dd($dataResult);
        return response()->json(['message' => 'success', 'data' => $dataResult]);
    }

    public function indexSubmitPenilaian($periodeId) {
        return view('penilaian.form', ['periode_id' => $periodeId]);
    }
    
    public function insertData(Request $request) {
        $pegawai_id = $request->input('pegawai_id');
        $periode_id = $request->input('periode_id');
        $entries = $request->input('entries');

        $penilaian = new Penilaian;
        $penilaian->periode_id = $periode_id;
        $penilaian->user_id = $pegawai_id;
        $penilaian->save();

        $penilaian_id = $penilaian->id;

        $entriesArr = [];

        for ($i=0; $i < count($entries); $i++) {
            $explodeData = explode('-', $entries[$i]);
            $subKriteriaId = (int)$explodeData[0];
            $nilai = (int)$explodeData[1];
            
            $entriesArr[] = [
                'penilaian_pegawai_id' => $penilaian_id,
                'sub_kriteria_id' => $subKriteriaId,
                'nilai' => $nilai
            ];
        }

        $insert = PenilaianDetail::insert($entriesArr);

        if ($insert) {
            return true;
        } else {
            return false;
        }
    }

    private function hitungNilaiAkhir($penilaian_id) {
        $data = PenilaianDetail::where('penilaian_pegawai_id', $penilaian_id)->get();
        $jumlahSubKriteria = SubKriteria::count();

        $dataNilai = [];
        $jumlah = 0;
        foreach ($data as $value) {
            $bobotSubKriteria = SubKriteria::find($value->sub_kriteria_id);
            $nilaiBobotPerSubKriteria = $value->nilai * $bobotSubKriteria->bobot;
            $jumlah = ($value->nilai * $bobotSubKriteria->bobot) + $jumlah;
            $dataNilai[] = [
                'nilai' => $nilaiBobotPerSubKriteria
            ];
        }
        $nilaiBobot = $jumlah * $jumlahSubKriteria;
        // dd($nilaiBobot);
        return $nilaiBobot;
    }

    public function approveData(Request $request) {
        $penilaianId = $request->input('penilaian_id');

        $update = Penilaian::find($penilaianId);
        $update->status = true;
        $status = $update->update();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

}
