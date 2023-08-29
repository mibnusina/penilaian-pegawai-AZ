

@extends('layout.header')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Form Penilaian</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Form Penilaian</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- /.card-header -->
        <div class="card-body">
            <select name="" id="pegawai-data" class="form-control">
                <option value="">Pilih Nama Pegawai</option>
            </select>
        </div>
        <!-- /.card-body -->
        <!-- Small boxes (Stat box) -->
        <div class="card" id="card-content">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
                <tr>
                    <td>16-20</td>
                    <td>Sangat Baik</td>
                </tr>
                <tr>
                    <td>11-15</td>
                    <td>Baik</td>
                </tr>
                <tr>
                    <td>6-10</td>
                    <td>Kurang</td>
                </tr>
                <tr>
                    <td>1-5</td>
                    <td>Sangat Kurang</td>
                </tr>
            </table>
        </div>

        <div class="card" id="hasil-perhitungan" style="display: none;">
            
        </div>
        <!-- /.card -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form kriteria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_kriteria" placeholder="Kriteria">
                            <input type="hidden" class="form-control" id="id" placeholder="NIK">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-data">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('other-js')
<script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('plugins') }}/jszip/jszip.min.js"></script>
<script src="{{ asset('plugins') }}/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('plugins') }}/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    getDataPegawai();
    init();

    function init() {
        var url = "{{ url('/') }}/kriteria-sub-kriteria"
        
        $.ajax({
            method: "get",
            url: url
        }).done(function (res) {
            // console.log(res)
            var content = ``
            content += `<div class="card-body">`
            for (let i = 0; i < res.data.length; i++) {
                content += `<div class="form-group row">
                                <p class="col-sm-6 col-form-label">${res.data[i].nama_kriteria} - <b>${res.data[i].nama_sub_kriteria} ${res.data[i].kode}</b></p>
                                <div class="col-sm-6">
                                    <input type="text" name="penilaian" id="${res.data[i].id}" class="form-control" placeholder="Nilai ${res.data[i].nama_sub_kriteria}">
                                </div>
                            </div>`;
                
            }
            content +=  `</div>`
            content += `<div class="card-footer"><button class="btn btn-warning" onclick="submit()">Submit</button></div>`
            $('#card-content').append(content)
        })
    }

    function initold() {
        var url = "{{ url('/') }}/kriteria/data"
        
        $.ajax({
            method: "get",
            url: url
        }).done(function (res) {
            // console.log(res)
            var content = ``

            for (let i = 0; i < res.data.length; i++) {
                var kriteria = res.data[i].nama_kriteria
                
                content += `<div class="card-body">
                                <h4>${kriteria}</h4>`
                for (let j = 0; j < res.data.length; j++) {
                    content += `<div class="form-group row">
                                    <p class="col-sm-2 col-form-label">${res.data[j].nama_kriteria}</p>
                                    <div class="col-sm-10">
                                        <input type="text" name="penilaian" id="${res.data[i].id}-${res.data[j].id}" row="${i + 1}" column="${j + 1}" class="form-control" placeholder="Nilai ${res.data[j].nama_kriteria}">
                                    </div>
                                </div>`;
                }
                content +=  `</div>
                            <hr>`
            }

            content += `<div class="card-footer"><button class="btn btn-warning" onclick="submit()">Submit</button></div>`
            $('#card-content').append(content)

            
        })
    }

    function getDataPegawai() {
        var url = "{{ url('/') }}/pegawai/data-by-lokasi"
        
        $.ajax({
            method: "get",
            url: url
        }).done(function (res) {
            console.log(res.data)
            var content = ``

            for (let i = 0; i < res.data.length; i++) {
                content += `<option value="${res.data[i].id}">${res.data[i].name}</option>`;
            }

            $('#pegawai-data').append(content)

            
        })
    }
    
    function hitung() {
        var element = $('input[name=penilaian]')

        var countCol1 = 0;
        var countCol2 = 0;
        var countCol3 = 0;
        var countCol4 = 0;
        var countCol5 = 0;
        var countCol6 = 0;


        for (let i = 0; i < element.length; i++) {
            if ($(element[i]).val() == '') {
                alert('Masih ada data yg belum diisi!');
                return false
            }


        }

        var url = "{{ url('/') }}/kriteria/data"
        
        $.ajax({
            method: "get",
            url: url
        }).done(function (res) {
            // console.log(res)
            var n = res.data.length;

            var content = ``
            content += `<table class="table table-bordered">
                            <tr>
                                <th>Kriteria</th>`
            for (let i = 0; i < res.data.length; i++) {
                content += `<th>${res.data[i].nama_kriteria}</th>`;
            }
            content += `<th>∑baris</th>
                        <th>∑prioritas</th>
                    </tr>`

            for (let i = 0; i < res.data.length; i++) {
                var kriteria = res.data[i].nama_kriteria
                
                content += `<tr>
                                <td>${kriteria}</td>`
                var barisValue = 0;
                for (let j = 0; j < res.data.length; j++) {
                    var searchElement = $(`#${res.data[i].id}-${res.data[j].id}`);
                    var value = eval($(searchElement).val())
                    value = value.toFixed(2);
                    value = Number(value);

                    barisValue = barisValue + value;

                    content += `<td id="td-${res.data[i].id}-${res.data[j].id}" row="${i+1}" col="${j+1}">${value}</td>`;
                    if (j == res.data.length - 1) {
                        console.log('baris value = '+ barisValue)
                        console.log('prioritas value = '+ barisValue / n)
                    }
                }
                content +=  `</tr>`

            }

            $('#hasil-perhitungan').append(content);
            $('#hasil-perhitungan').css('display', '');
        })
    }

    function submit() {
        var pegawaiId = $('#pegawai-data').val()

        if (pegawaiId == '') {
            alert('Pilih nama pegawai!')
            return false
        }

        var element = $('input[name=penilaian]');
        var entries = []

        for (let i = 0; i < element.length; i++) {
            if ($(element[i]).val() == '') {
                alert('Masih ada data yg belum diisi!');
                return false
            }
            entries.push($(element[i]).attr('id')+'-'+$(element[i]).val())
        }

        // console.log(entries)

        var urlPost = "{{ url('/') }}/penilaian/post";

        $.ajax({
            url: urlPost,
            method: "post",
            data: {
                pegawai_id: pegawaiId,
                periode_id: '{{ $periode_id }}',
                entries: entries,
                _token: '{{ csrf_token() }}'
            }
        }).done(function (res) {
            window.location.replace("{{ url('/') }}/penilaian/{{ $periode_id }}");
        })
        
    }
</script>
@endsection