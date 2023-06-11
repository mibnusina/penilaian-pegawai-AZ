@extends('layout.header')

@section('content')
    @php
        $jabatan = Auth::user()->jabatan;
        $jabatanText = "";
        if ($jabatan == 1) {
            $jabatanText = "General Manager Cluster";
        }
    @endphp
  <h4>Selamat Datang <b>{{Auth::user()->name}} - {{ $jabatanText }}</b>.</h4>
@endsection