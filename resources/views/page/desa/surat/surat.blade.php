@extends('page/desa/layout/app')

@section('title','Data Surat')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Master Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Surat </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <?php  
    // $opsi_surat = array('Surat Keterangan Domisili','Surat Keterangan Usaha','Surat Keterangan Tidak Mampu','Surat Keterangan Kematian');
    $opsi_surat = DB::table('template')->select(
        \DB::RAW('nama_template')
    )->groupBy('nama_template')
    ->distinct()
    ->where('status_template','Active')
    ->orderBy('nama_template','ASC')
    ->get();
    ?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Surat yang di Sediakan
                <button type="button" style="float: right;" class="btn btn-sm btn-primary btn-sm new">
                    <i class="fa fa-plus"></i> Tambah Surat
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table_surat" style="width: 100%;">
                        <thead>
                            <tr>
                                <th data-priority="2">No. </th>
                                <th data-priority="3">Nama Surat</th>
                                <th data-priority="4">Singkatan</th>
                                <th data-priority="5">Template</th>
                                <th data-priority="1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_surat" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1"></h5>
            <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            ></button>
        </div>
        <div class="modal-body">
          <form method="post" id="suratForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Pengajuan Surat yang di Sediakan</label>
                        <input type="text" hidden="" id="id_surat" name="id_surat">
                        <select class="form-control select_opsi" name="nama_surat" id="nama_surat">
                            <option value="">:. PILIH OPSI SURAT .:</option>
                            @foreach($opsi_surat as $opsis)
                            <?php  
                            $surat = str_replace("_", " ", $opsis->nama_template);
                            $nama_surat = $surat;
                            // $nama_surat = ucwords(strtolower($surat));
                            ?>
                            <option value="{{$nama_surat}}">{{$nama_surat}}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback" role="alert" id="nama_suratError">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Warna Background</label>
                        <input type="color" class="form-control" id="bg" name="bg">
                        <span class="invalid-feedback" role="alert" id="bgError">
                            <strong></strong>
                        </span>
                    </div>  
                    <div class="form-group">
                        <label>Persyaratan</label>
                        <textarea class="form-control" rows="5" id="persyaratan" name="persyaratan"></textarea>
                        <span class="invalid-feedback" role="alert" id="persyaratanError">
                            <strong></strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-loading" id="modal-loading" style="display: none;">
            <span class="fa fa-circle-o-notch fa-pulse fa-3x"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">
                <span>Tutup</span>
            </button>
            <button class="btn btn-primary ml-1">
                <i class="fa fa-save"></i>
                <span>Simpan</span>
            </button>
        </div>
    </form>
</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#table_surat').DataTable({
            processing: true,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "{{ route('data_surat') }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#table_surat').DataTable().ajax.reload();
                }
            },
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { 
                data: 'nama_surat', 
                name: 'nama_surat', 
                render: function (data, type, row) {
                    return data;
                }  
            },
            { 
                data: 'singkatan', 
                name: 'singkatan', 
                render: function (data, type, row) {
                    return data;
                }  
            },
            { 
                data: 'template_id', 
                name: 'template_id', 
                render: function (data, type, row) {
                    if (data == null) {
                        return '<span class="badge bg-danger">Belum Memilih</span>';
                    }else{
                        return '<span class="badge bg-success">Sudah Memilih</span>';
                    }
                }  
            },
            { data: 'action', name: 'action', orderable: false, className: 'space' }
            ]
        });
    });
    var ajaxUrl;
    $(".new").click(function() {
        $("#suratForm")[0].reset();
        $(".modal-title").html('<i class="fa fa-plus"></i> Form Tambah Surat');
        $(".invalid-feedback").children("strong").text("");
        $(".select_opsi").val(null).trigger('change');
        $("#suratForm input").removeClass("is-invalid");
        $("#suratForm select").removeClass("is-invalid");
        $("#suratForm textarea").removeClass("is-invalid");
        $("#modal_form_surat").modal('show');
        ajaxUrl = " {{ route('tambah_surat') }} ";
    });
    $(function () {
        $('#suratForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            show_loading();
            $(".invalid-feedback").children("strong").text("");
            $("#suratForm input").removeClass("is-invalid");
            $("#suratForm select").removeClass("is-invalid");
            $("#suratForm textarea").removeClass("is-invalid");
            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                contentType: false,
                processData: false,
                url: ajaxUrl,
                data: formData,
                success: function (response) {
                    hide_loading();
                    if (response.status == 'true') {
                        $("#suratForm")[0].reset();
                        $('#modal_form_surat').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        $('#table_surat').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Gagal',
                            dangerMode: true,
                            text: response.message
                        });
                    }
                },
                error: function (response) {
                    hide_loading();
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            $("#" + key).addClass("is-invalid");
                            $("#" + key + "Error").children("strong").text(errors[key][0]);
                        });
                    } else {
                        swal({
                            icon: 'error',
                            type: 'error',
                            title: 'Gagal',
                            dangerMode: true,
                            text: response.message
                        });
                    }
                }
            });
        });
    });
    function get_edit(suratID) {
        $.ajax({
            type: "GET",
            url: "{{url('page/surat/get_edit')}}"+"/"+suratID,
            success: function(response) {
                if (response) {
                    hide_loading();
                    $.each(response, function(key, value) {
                        $("#id_surat").val(value.id_surat);
                        $("#nama_surat").val(value.nama_surat).trigger('change');
                        $("#bg").val(value.bg);
                        $("#persyaratan").val(value.persyaratan);
                    });
                }
            },
            error: function(response) {
                get_edit(suratID);
            }
        });
    }
    $(document).on('click','.edit',function() {
        var suratID = $(this).attr('more_id');
        show_loading();
        $("#suratForm")[0].reset();
        $(".modal-title").html('<i class="fa fa-edit"></i> Form Ubah Surat');
        $(".invalid-feedback").children("strong").text("");
        $(".select_opsi").val(null).trigger('change');
        $("#suratForm input").removeClass("is-invalid");
        $("#suratForm select").removeClass("is-invalid");
        $("#suratForm textarea").removeClass("is-invalid");
        $("#modal_form_surat").modal('show');
        ajaxUrl = " {{ route('edit_surat') }} ";
        if (suratID) {
            get_edit(suratID);
        }
    });
    $(document).on('click', '.delete', function (event) {
        suratID = $(this).attr('more_id');
        event.preventDefault();
        Swal.fire({
            title: 'Lanjut Hapus Data?',
            text: 'Data Surat akan dihapus secara Permanent!',
            icon: 'warning',
            type: 'warning',
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "{{url('page/surat/hapus')}}"+"/"+suratID,
                    success: function(response) {
                        if (response.status == 'true') {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: 'Success',
                                text: response.message
                            });
                            $('#table_surat').DataTable().ajax.reload();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: 'Terjadi kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Gagal',
                            dangerMode: true,
                            text: 'Terjadi kesalahan!'
                        });
                    }
                });
            }
        });
    });
</script>
@endsection