@extends('page/desa/layout/app')

@section('title','Data User')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Data User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$level}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data User {{$level}}
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new">
                    <i class="bx bx-plus"></i> Tambah {{$level}}
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="width: 100%;" id="table_user">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama</th>
                                <th>Email</th>
                                @if($level == 'Pengaju')
                                <th>NIM</th>
                                @else
                                <th>NIP</th>
                                @endif
                                <th>Role</th>
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
    @include('page/desa/user/form')
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#table_user').DataTable({
            processing: true,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "{{ route('data_user',$level) }}",
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#table_user').DataTable().ajax.reload();
                }
            },
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { 
                data: 'name', 
                name: 'name', 
                render: function (data, type, row) {
                    return data;
                }  
            },
            { 
                data: 'email', 
                name: 'email', 
                render: function (data, type, row) {
                    return data;
                }  
            },
            { 
                data: 'nik', 
                name: 'nik', 
                render: function (data, type, row) {
                    return data;
                }
            },
            { 
                data: 'level', 
                name: 'level', 
                render: function (data, type, row) {
                    if (data == 'Pengaju') {
                        return '<span class="badge bg-primary">'+data+'</span>';
                    }else{
                        return '<span class="badge bg-success">'+data+'</span>';
                    }
                }
            },
            { data: 'action', name: 'action', orderable: false, className: 'space' }
            ]
        });
    });
    var ajaxUrl;
    $(".new").click(function() {
        $("#userForm")[0].reset();
        $(".modal-title").html('<i class="fa fa-plus"></i> Form Tambah User');
        $(".invalid-feedback").children("strong").text("");
        $(".select_opsi").val(null).trigger('change');
        $("#userForm input").removeClass("is-invalid");
        $("#userForm select").removeClass("is-invalid");
        $("#userForm textarea").removeClass("is-invalid");
        $("#modal_form_user").modal('show');
        ajaxUrl = " {{ route('tambah_pengurus') }} ";
    });
    $(function () {
        $('#userForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            show_loading();
            $(".invalid-feedback").children("strong").text("");
            $("#userForm input").removeClass("is-invalid");
            $("#userForm select").removeClass("is-invalid");
            $("#userForm textarea").removeClass("is-invalid");
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
                        $("#userForm")[0].reset();
                        $('#modal_form_user').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        $('#table_user').DataTable().ajax.reload();
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
    function get_edit(userID) {
        $.ajax({
            type: "GET",
            url: "{{url('page/data_user/get_edit')}}"+"/"+userID,
            success: function(response) {
                if (response) {
                    hide_loading();
                    $.each(response, function(key, value) {
                        $("#id").val(value.id);
                        $("#name").val(value.name);
                        $("#email").val(value.email);
                        if (value.level == 'Pengaju') {
                            $("#pekerjaan").val(value.pekerjaan);
                        }else{
                            $("#level").val(value.level).trigger('change');
                        }
                        $("#telepon").val(value.telepon);
                        $("#nik").val(value.nik);
                        $("#agama").val(value.agama);
                        $("#tempat").val(value.tempat);
                        $("#jenis_kelamin").val(value.jenis_kelamin).trigger('change');
                        $("#tgl_lahir").val(value.tgl_lahir);
                        $("#alamat").val(value.alamat);
                        $("#fotoLama").val(value.foto_profil);

                    });
                }
            },
            error: function(response) {
                get_edit(userID);
            }
        });
    }
    $(document).on('click','.edit',function() {
        var userID = $(this).attr('more_id');
        show_loading();
        $("#userForm")[0].reset();
        $(".modal-title").html('<i class="fa fa-edit"></i> Form Ubah User');
        $(".invalid-feedback").children("strong").text("");
        $(".select_opsi").val(null).trigger('change');
        $("#userForm input").removeClass("is-invalid");
        $("#userForm select").removeClass("is-invalid");
        $("#userForm textarea").removeClass("is-invalid");
        $("#modal_form_user").modal('show');
        ajaxUrl = " {{ route('update_pengurus') }} ";
        if (userID) {
            get_edit(userID);
        }
    });
</script>
@endsection