@extends('layout.header')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Pegawai</li>
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
            @php if (Auth::user()->jabatan == 17) { @endphp
            <div class="card-header">
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
                <div class="col-sm-2">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default" id="new-data"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
            @php } @endphp
            <!-- /.card-header -->
            <div class="card-body" id="table-content">
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nik" placeholder="NIK">
                            <input type="hidden" class="form-control" id="id" placeholder="NIK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="" id="jabatan" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="" id="status" class="form-control">
                                <option value="1">Pegawai Tetap</option>
                                <option value="2">Pegawai Kontrak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <!-- <input type="text" class="form-control" id="lokasi" placeholder="Lokasi"> -->
                            <select name="" id="lokasi" class="form-control">
                            </select>
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
        var url = "{{ url('/') }}/pegawai/data"
        
        $.ajax({
            method: "get",
            url: url
        }).done(function (res) {
            // console.log(res)
            var content = ``
            content += `<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>`

            var no = 1
            for (let i = 0; i < res.data.length; i++) {
                var jabatan = res.data[i].jabatan
                var jabatanText = res.data[i].nama_jabatan
                
                content += `<tr>
                                <td>${no}</td>
                                <td>${res.data[i].nik}</td>
                                <td>${res.data[i].name}</td>
                                <td>${jabatanText}</td>
                                <td>${res.data[i].status == 1 ? 'Pegawai Tetap' : 'Pegawai Kontrak'}</td>
                                <td>${res.data[i].nama_lokasi}</td>
                                <td>
                                    @php if (Auth::user()->jabatan == 17) { @endphp
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-warning" id="${res.data[i].id}" onclick="updateData(this)"><i class="fas fa-wrench"></i></button>
                                        <button class="btn btn-danger" id="${res.data[i].id}" onclick="deleteData(this)"><i class="fas fa-trash"></i></button>
                                    </div>
                                    @php } @endphp
                                </td>
                            </tr>`
                no++
            }

            content += `</tbody></table>`

            $('#table-content').append(content)

            $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        })

        getJabatan();
        getLokasi();
    }
    
    $('#save-data').on('click', function() {
        var id = $('#id').val()
        var nik = $('#nik').val()
        var name = $('#name').val()
        var username = name
        var password = $('#password').val()
        var jabatan = $('#jabatan').val()
        var status = $('#status').val()
        var lokasi = $('#lokasi').val()

        if (nik == '' || name == '' || username == '') {
            alert('Tidak boleh ada data yang kosong!')
            return false
        }

        if (id == '') {
            if (password == '') {
                alert('Tidak boleh ada data yang kosong!')
                return false
            }

            var url = "{{ url('/') }}/pegawai/post"
            $.ajax({
                method: 'post',
                url: url,
                data: {
                    nik: nik,
                    name: name,
                    username: username,
                    password: password,
                    jabatan: jabatan,
                    status: status,
                    lokasi: lokasi,
                    _token: '{{ csrf_token() }}'
                }
            }).done(function (res){
                alert('Data berhasil ditambahkan!')
                $('#modal-default').modal('toggle'); 
                $('#table-content').html('')
                init()
            }).fail(function (err){
                $('#modal-default').modal('toggle'); 
                alert('Data gagal ditambahkan!')
            })
        } else {
            var url = "{{ url('/') }}/pegawai/update"
            $.ajax({
                method: 'post',
                url: url,
                data: {
                    id: id,
                    nik: nik,
                    name: name,
                    username: username,
                    password: password,
                    jabatan: jabatan,
                    status: status,
                    lokasi: lokasi,
                    _token: '{{ csrf_token() }}'
                }
            }).done(function (res){
                alert('Data berhasil diubah!')
                $('#modal-default').modal('toggle'); 
                $('#table-content').html('')
                init()
            }).fail(function (err){
                $('#modal-default').modal('toggle'); 
                alert('Data gagal diubah!')
            })
        }
    })

    function updateData(element) {
        // console.log(element)
        emptyForm()
        var id = $(element).attr('id')
        var url = "{{ url('/') }}/pegawai/data-by-id/"+id

        $.ajax({
            method: "get",
            url: url
        }).done(function(res){
            if (res.data != null) {
                var dataId = res.data.id
                var nik = res.data.nik
                var name = res.data.name
                var username = name
                var jabatan = res.data.jabatan
                var status = res.data.status
                var lokasi = res.data.lokasi_id

                $('#id').val(dataId)
                $('#nik').val(nik)
                $('#name').val(name)
                $('#jabatan').val(jabatan).trigger('change')
                $('#status').val(status).trigger('change')
                $('#lokasi').val(lokasi).trigger('change')

                $('#modal-default').modal('toggle');
            } else {
                alert('Error baca data')
                return false
            }
        })
    }

    function deleteData(element) {
        var id = $(element).attr('id')
        var url = "{{ url('/') }}/pegawai/delete/"+id
        $.ajax({
            method: 'get',
            url: url
        }).done(function (res){
            alert('Data berhasil dihapus!')
            $('#table-content').html('')
            init()
        }).fail(function (err){
            $('#modal-default').modal('toggle'); 
            alert('Data gagal dihapus!')
        })
    }

    function emptyForm() {
        $('#nik').val('')
        $('#name').val('')
        $('#username').val('')
        $('#password').val('')
        $('#lokasi').val('')
        $('#jabatan').val(1).trigger('change')
        $('#status').val(1).trigger('change')
    }

    $('#new-data').on('click', function() {
        $('#id').val('')
        emptyForm()
    })

    function getJabatan() {
        var url = "{{ url('/') }}/jabatan/data"
        
        $.ajax({
            method: "get",
            url: url
        }).done(function (res) {
            // console.log(res)
            var content = ``
            for (let i = 0; i < res.data.length; i++) {
                var jabatan = res.data[i].nama_jabatan
                
                content += `<option value="${res.data[i].id}">${jabatan}</option>`;
            }

            $('#jabatan').append(content)
        })
    }

    function getLokasi() {
        var url = "{{ url('/') }}/lokasi/data"
        
        $.ajax({
            method: "get",
            url: url
        }).done(function (res) {
            // console.log(res)
            var content = ``
            for (let i = 0; i < res.data.length; i++) {
                var lokasi = res.data[i].nama_lokasi
                
                content += `<option value="${res.data[i].id}">${lokasi}</option>`;
            }

            $('#lokasi').append(content)
        })
    }
</script>
@endsection