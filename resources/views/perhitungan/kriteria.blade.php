

@extends('layout.header')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Perhitungan Kriteria</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Perhitungan Kriteria</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card" id="card-content">
            
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
    init()

    function init() {
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
                                        <input type="text" name="penilaian" id="${res.data[i].id}-${res.data[j].id}" row="${i + 1}" column="${j + 1}" class="form-control" placeholder="Penilaian Perbandingan">
                                    </div>
                                </div>`;
                }
                content +=  `</div>
                            <hr>`
            }

            content += `<div class="card-footer"><button class="btn btn-warning" onclick="hitung()">Hitung</button></div>`
            $('#card-content').append(content)

            
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

            // for (let i = 0; i < element.length; i++) {
            //     var value = eval($(element[i]).val())
            //     $('#td-'+ $(element[i]).attr('id')).html(value.toFixed(2));
            // }
            
        })
    }
</script>
@endsection