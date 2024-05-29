@extends('page/desa/layout/app')

@section('title','Surat Permohonan')

@section('content')
<section class="section">
    <div id="loading">
        <span class="fa fa-circle-o-notch fa-pulse fa-3x"></span>
    </div>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Form Pengajuan Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{Auth::user()->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{Auth::user()->name}} - Request</h4>
            {{$surat->nama_surat}}
        </div>

        <div class="card-body">
            <form method="post" id="requestForm" enctype="multipart/form-data">
                @csrf
                @foreach($data as $dt)
                <div class="row">
                    <div class="col-xl-12">
                        <label>Persyaratan Pengajuan Surat :</label>
                        <div class="form-group">
                            <?php
                            $array = explode(PHP_EOL, $surat->persyaratan);
                            $total = count($array);
                            foreach($array as $item) {
                              echo "<span>". $item . "</span><br>";
                          }
                          ?>
                      </div>
                  </div>
                  <hr>
              </div>
              <div class="scrollable-div p-3" style="max-height: 400px;">
                  <div class="row">
                    <input type="hidden" value="{{$surat->id_surat}}" id="id_surat" name="id_surat">
                    <input type="hidden" value="{{$surat->singkatan}}" name="singkatan" id="singkatan">
                    <input type="text" hidden="" value="{{$surat->singkatan_template}}_{{substr($surat->urutan_template,-1)}}" name="singkatan_template">
                    <div class="col-xl-12 mb-2"><h5><b><u>Lengkapi Form dibawah ini :</u></b></h5></div>
                    <?php  
                    $urutan_template = 'page/pengaju/request/'.$surat->singkatan_template.'/'.strtolower($surat->urutan_template).'_form';
                    ?>
                    @include("$urutan_template")
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 mt-2">
                    @if($dt->nik != NULL)
                    <button class="btn btn-primary form-control" onclick="return confirm('Pastikan data yang anda masukkan sudah benar')">BUAT PENGAJUAN <i class="bx bxs-file-plus"></i></button>
                    @else
                    <span class="badge bg-danger form-control text-white"><i class="fa fa-info-circle"></i> Lengkapi profil anda. <a href="{{route('profil_pengaju')}}">Lengkapi sekarang</a></span>
                    @endif
                </div>
            </div>
        </form>
        <div class="row" id="copy">
            <div class="row" id="control-group">
                <label class="col-lg-4">Nama Mahasiswa & NIM <span class="text-danger">*</span>
                    <a class="text remove text-danger" href="javascript:void(0)" style="float: right;" id="remove"><i class="fa fa-close"></i></a>
                </label>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Mahasiswa" name="nama[]" required="">
                        <span class="invalid-feedback d-block" role="alert" id="tanggal_akhirError">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="NIM" name="nim[]" required="">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#copy").hide();
        $("#add-more").click(function(){ 
           var html = $("#copy").html();
           $("#after-add-more").after(html);
       });
        $("body").on("click","#remove",function(){ 
          $(this).parents("#control-group").remove();
      });
    });
    $(function () {
        $('#requestForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $("#loading").show();
            $(".invalid-feedback").children("strong").text("");
            $("#requestForm input").removeClass("is-invalid");
            $("#requestForm select").removeClass("is-invalid");
            $("#requestForm textarea").removeClass("is-invalid");
            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                contentType: false,
                processData: false,
                url: "{{route('add_request')}}",
                data: formData,
                success: function (response) {
                    $("#loading").hide();
                    if (response.status == 'true') {
                        $("#requestForm")[0].reset();
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 350);
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
                    $("#loading").hide();
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
    $("#semester").on('change',function() {
        var semesterValue = $(this).val();
        if (semesterValue) {
            if (semesterValue == 'lain') {
                $("#semester").attr('hidden',true);
                $("#semester_lain").attr('hidden',false);
            }else{
                $("#semester").attr('hidden',false);
                $("#semester_lain").attr('hidden',true);
            }
        }
    })
</script>
@endsection