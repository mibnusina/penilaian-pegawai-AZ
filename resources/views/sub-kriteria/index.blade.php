@extends('layout.header')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Sub Kriteria</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Sub Kriteria</li>
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
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <select name="" id="kriteria-data" class="form-control">
                    <option value="">Pilih Kriteria</option>
                </select>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
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
                
                content += `<option value="${res.data[i].id}">${kriteria}</option>`;
            }


            $('#kriteria-data').append(content)

            // $(function () {
            //     $("#example1").DataTable({
            //         "responsive": true, "lengthChange": false, "autoWidth": false,
            //         // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // });
        })
    }

    $('#kriteria-data').on('change', function() {
        var kriteriaId = $('#kriteria-data').val();

        window.location.replace("{{ url('/') }}/sub-kriteria/" + kriteriaId);
    })
</script>
@endsection