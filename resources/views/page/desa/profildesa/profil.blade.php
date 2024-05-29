@extends('page/desa/layout/app')
@section('title','Profil')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2>Profil <button type="button" class="btn btn-profil rounded-pill btn-sm btn-warning block" style="float: right;">
                    <i class="bx bx-edit"></i> Ubah
                </button></h2>
                
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($data as $cst)
                            <tr>
                                <td>NAMA PROFIL</td>
                                <td>:</td>
                                <td>{{$cst->nama_profil}}</td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td>:</td>
                                <td>{{$cst->email_desa}}</td>
                            </tr>
                            <tr>
                                <td>TELEPON</td>
                                <td>:</td>
                                <td>{{$cst->telepon_desa}}</td>
                            </tr>
                            <tr>
                                <td>LOKASI</td>
                                <td>:</td>
                                <td>{{$cst->lokasi_desa}}</td>
                            </tr>
                            <tr>
                                <td>LOGO</td>
                                <td>:</td>
                                <td>
                                    <img src="{{asset('foto')}}/{{$cst->logo}}" width="70">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>
@include('page/desa/profildesa/ubah')
<div class="row mb-4">
    @foreach($data as $cst)
    @if($cst->lokasi_desa==NULL)
    <div class="alert alert-light-danger color-danger"><i
        class="bi bi-exclamation-circle"></i> ALAMAT TIDAK DI KETAHUI</div>
        @else
        <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q=Kantor+Kelurahan+{{$cst->name_village}}+{{$cst->name_district}}+{{$cst->name_city}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        @endif

        @endforeach
    </div>
    @endsection

    @section('scripts')
    <script type="text/javascript">
        var ajaxUrl;
        $(".btn-profil").click(function() {
            $("#profilDesaForm")[0].reset();
            $(".modal-title").html('<i class="fa fa-building-o"></i> Profil Desa');
            $(".invalid-feedback").children("strong").text("");
            $(".select_opsi").val(null).trigger('change');
            $("#profilDesaForm input").removeClass("is-invalid");
            $("#profilDesaForm select").removeClass("is-invalid");
            $("#profilDesaForm textarea").removeClass("is-invalid");
            $("#modal_form_profil").modal('show');
            ajaxUrl = " {{ route('lengkapi') }} ";
        });
        $(function () {
            $('#profilDesaForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                show_loading();
                $(".invalid-feedback").children("strong").text("");
                $("#profilDesaForm input").removeClass("is-invalid");
                $("#profilDesaForm select").removeClass("is-invalid");
                $("#profilDesaForm textarea").removeClass("is-invalid");
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
                            $("#profilDesaForm")[0].reset();
                                // $('#modal_form_profil').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Success',
                                    text: response.message
                                });
                                setTimeout(function() {
                                    window.location = "";
                                }, 200);
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
    </script>
    @endsection