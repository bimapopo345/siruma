@extends('page/desa/layout/app')
@section('title','Detail Data Profile')
@section('content')
@foreach($data as $cst)
<div class="page-heading">
  <div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{Auth::user()->level}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{Auth::user()->level}} /</span> Profile</h4> -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <h2>Detail Profile</h2>
            <button type="button" class="btn rounded-pill btn-sm btn-warning btn-profil" style="float: right;">
                <i class="bx bx-edit"></i> Update
            </button>
            <button type="button" class="btn rounded-pill btn-sm btn-primary block" style="float: right;" data-bs-toggle="modal" data-bs-target="#ganti">
                <i class="bx bx-lock"></i> Ganti Password
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>EMAIL</td>
                            <td>:</td>
                            <td>{{$cst->email}}</td>
                        </tr>
                        <tr>
                            <td>NAMA</td>
                            <td>:</td>
                            <td>{{$cst->name}}</td>
                        </tr>
                        <tr>
                            <td>
                                @if($cst->level == 'Pengaju')
                                NIM
                                @else
                                NIP
                                @endif
                            </td>
                            <td>:</td>
                            <td>{{$cst->nik}}</td>
                        </tr>
                        <tr>
                            <td>AGAMA</td>
                            <td>:</td>
                            <td>{{$cst->agama}}</td>
                        </tr>
                        <tr>
                            <td>TEMPAT LAHIR</td>
                            <td>:</td>
                            <td>{{$cst->tempat}}</td>
                        </tr>
                        <tr>
                            <td>TANGGAL LAHIR</td>
                            <td>:</td>
                            <td>{{$cst->tgl_lahir}}</td>
                        </tr>
                        <tr>
                            <td>JENIS KELAMIN</td>
                            <td>:</td>
                            <td>{{$cst->jenis_kelamin}}</td>
                        </tr>
                        @if($cst->level=="Pengaju")
                        <tr>
                            <td>PROGRAM STUDI</td>
                            <td>:</td>
                            <td>{{$cst->pekerjaan}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>PONSEL</td>
                            <td>:</td>
                            <td>
                                @if(substr($cst->telepon,0,1)=='0')
                                <a href="https://wa.me/62{{substr($cst->telepon,1)}}" target="_blank">
                                    +62 {{substr($cst->telepon,1)}}
                                </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>ALAMAT</td>
                            <td>:</td>
                            <td>{{$cst->alamat}}</td>
                        </tr>
                        <tr>
                            <td>FOTO PROFIL</td>
                            <td>:</td>
                            <td>
                                <img src="{{asset('profil')}}/{{$cst->foto_profil}}" width="70">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="row mb-4">
    @if($cst->alamat==NULL)
    <div class="alert alert-light-danger color-danger"><i
        class="bi bi-exclamation-circle"></i> ALAMAT TIDAK DI KETAHUI
    </div>
    @else
    <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$cst->alamat}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
    </div>
    @endif
</div>
@include('page/pengaju/profil/ganti')
@include('page/pengaju/profil/ubah')
@endforeach
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var ajaxUrl;
    $(".btn-profil").click(function() {
        $("#profilForm")[0].reset();
        $(".modal-title").html('<i class="fa fa-edit"></i> Ubah Profil');
        $(".invalid-feedback").children("strong").text("");
        $(".select_opsi").val(null).trigger('change');
        $("#profilForm input").removeClass("is-invalid");
        $("#profilForm select").removeClass("is-invalid");
        $("#profilForm textarea").removeClass("is-invalid");
        $("#modal_form_profil").modal('show');
        ajaxUrl = " {{ route('update_profil_pengurus') }} ";
    });
    $(function () {
        $('#profilForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            show_loading();
            $(".invalid-feedback").children("strong").text("");
            $("#profilForm input").removeClass("is-invalid");
            $("#profilForm select").removeClass("is-invalid");
            $("#profilForm textarea").removeClass("is-invalid");
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
                        $("#profilForm")[0].reset();
                        $('#modal_form_profil').modal('hide');
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