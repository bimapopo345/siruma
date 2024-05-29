@extends('page/desa/layout/app')

@section('title','Data Waktu Pelayanan')

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
                        <li class="breadcrumb-item active" aria-current="page">Waktu Pelayanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Waktu Pelayanan Surat Pengajuan
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
                    <i class="fa fa-plus"></i> Tambah Layanan
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table_layanan" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Hari</th>
                                <th>Waktu Layanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <div class="modal fade text-left" id="modal_form_layanan" data-bs-backdrop="static" tabindex="-1" role="dialog"
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
                <form method="post" id="layananForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Hari</label>
                                <input type="text" hidden="" id="id_layanan" name="id_layanan">
                                <input type="text" id="hari" class="form-control" name="hari">
                                <span class="invalid-feedback" role="alert" id="hariError">
                                    <strong></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Jam Pelayanan</label>
                                <input type="time" class="form-control" id="waktu" name="waktu">
                                <span class="invalid-feedback" role="alert" id="waktuError">
                                    <strong></strong>
                                </span>
                                <input type="time" class="form-control mt-1" name="sampai" id="sampai">
                                <span class="invalid-feedback" role="alert" id="sampaiError">
                                    <strong></strong>
                                </span>
                            </div>  
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary form-control mt-2"><i class="bx bx-save"></i> Simpan</button>
                </form>
            </div>
            <div class="modal-loading" id="modal-loading" style="display: none;">
                <span class="fa fa-circle-o-notch fa-pulse fa-3x"></span>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#table_layanan').DataTable({
            processing: true,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "{{ route('waktu_layanan') }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#table_layanan').DataTable().ajax.reload();
                }
            },
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { 
                data: 'hari', 
                name: 'hari', 
                render: function (data, type, row) {
                    return data;
                }  
            },
            { 
                data: 'waktu', 
                name: 'waktu', 
                render: function (data, type, row) {
                    return data + ' - ' +row.sampai;
                }  
            },
            { data: 'action', name: 'action', orderable: false, className: 'space' }
            ]
        });
    });
    var ajaxUrl;
    $(".new").click(function() {
        $("#layananForm")[0].reset();
        $(".modal-title").html('<i class="fa fa-plus"></i> Form Tambah Layanan');
        $(".invalid-feedback").children("strong").text("");
        $("#layananForm input").removeClass("is-invalid");
        $("#modal_form_layanan").modal('show');
        ajaxUrl = " {{ route('tambah_layanan') }} ";
    });
    $(function () {
        $('#layananForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            show_loading();
            $(".invalid-feedback").children("strong").text("");
            $("#layananForm input").removeClass("is-invalid");
            $("#layananForm select").removeClass("is-invalid");
            $("#layananForm textarea").removeClass("is-invalid");
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
                        $("#layananForm")[0].reset();
                        $('#modal_form_layanan').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        $('#table_layanan').DataTable().ajax.reload();
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
    function get_edit(layananID) {
        $.ajax({
            type: "GET",
            url: "{{url('page/waktu_pelayanan/get_edit')}}"+"/"+layananID,
            success: function(response) {
                if (response) {
                    hide_loading();
                    $.each(response, function(key, value) {
                        $("#id_layanan").val(value.id_layanan);
                        $("#hari").val(value.hari);
                        $("#waktu").val(value.waktu);
                        $("#sampai").val(value.sampai);
                    });
                }
            },
            error: function(response) {
                get_edit(layananID);
            }
        });
    }
    $(document).on('click','.edit',function() {
        var layananID = $(this).attr('more_id');
        show_loading();
        $("#layananForm")[0].reset();
        $(".modal-title").html('<i class="fa fa-edit"></i> Form Ubah Layanan');
        $(".invalid-feedback").children("strong").text("");
        $("#layananForm input").removeClass("is-invalid");
        $("#modal_form_layanan").modal('show');
        ajaxUrl = " {{ route('edit_layanan') }} ";
        if (layananID) {
            get_edit(layananID);
        }
    });
    $(document).on('click', '.delete', function (event) {
        layananID = $(this).attr('more_id');
        event.preventDefault();
        Swal.fire({
            title: 'Lanjut Hapus Data?',
            text: 'Data Layanan akan dihapus secara Permanent!',
            icon: 'warning',
            type: 'warning',
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "{{url('page/waktu_pelayanan/hapus')}}"+"/"+layananID,
                    success: function(response) {
                        if (response.status == 'true') {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: 'Success',
                                text: response.message
                            });
                            $('#table_layanan').DataTable().ajax.reload();
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