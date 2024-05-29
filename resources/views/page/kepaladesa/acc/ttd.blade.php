@extends('page/desa/layout/app')

@section('title','Cek Surat Acc')

@section('content')
<div class="container">
    @foreach($data as $dt)
    <div class="row">
        <div class="col-lg-7 pb-4" style="background: white;box-shadow:2px 2px grey;">
            <form method="post" action="{{route('confirm_ttd',$dt->id_pengajuan)}}">
                @csrf
                <input type="hidden" value="{{$dt->singkatan}}" name="singkatan">
                <input type="hidden" value="{{$dt->id_surat}}" name="id_surat">
                <button class="btn btn-sm form-control btn-primary mt-2" onclick="return confirm('Lanjut Konfirmasi Surat Selesai?')">Konfirmasi Surat Selesai</button>
            </form>
        </div>
        <div class="col-lg-7">
            <a href="javascript:void(0)" id="btn-ttd" class="btn btn-sm form-control btn-success mt-2"><i class="bi bi-pencil"></i> Tanda Tangan</a>
        </div>
    </div>
    <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_ttd" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1"><i class="bx bx-pencil"></i> Form Tanda Tangan Digital</h5>
            </div>
            <div class="modal-body">
              <form method="post" id="ttdForm" enctype="multipart/form-data">
                @csrf
                <div id="content_ttd">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="wrapper">
                              <canvas id="signature-pad" class="signature-pad"></canvas>
                          </div>
                          <br>
                          <input type="text" hidden="" name="lama" value="{{$dt->ttd}}">
                          <input type="text" hidden="" name="singkatan" value="{{$dt->singkatan}}">
                          <input type="text" hidden="" name="id_pengajuan" value="{{$dt->id_pengajuan}}">
                          <div id="form-group"></div>
                      </div>
                      <span class="invalid-feedback" role="alert" id="ttdError">
                        <strong></strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-loading" id="modal-loading" style="display: none;">
            <span class="fa fa-circle-o-notch fa-pulse fa-3x"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                <span>Tutup</span>
            </button>
            <button class="btn btn-danger btn-sm ml-1" type="button" id="clear">
                <i class="fa fa-trash"></i>
                <span>Hapus</span>
            </button>
            <button class="btn btn-success btn-sm ml-1" onclick="return confirm('Lanjut Gunakan Tanda Tangan?')" id="sub">
                <i class="fa fa-edit"></i>
                <span>Konfirmasi TTD</span>
            </button>
            <button class="btn btn-primary btn-sm ml-1" type="button" id="konfirmasi">
                <i class="fa fa-check"></i>
                <span>Terapkan</span>
            </button>
        </div>
    </form>
</div>
</div>
</div>
@endforeach
</div>
@foreach($data as $dt)
<?php  
$nama_template = 'page/desa/template/'.$dt->singkatan_template.'/'.$dt->urutan_template.'/'.strtolower($dt->urutan_template);
$path_template_cek = 'page/desa/template/'.$dt->singkatan_template.'/'.$dt->urutan_template.'/cek';
?>
@include($nama_template)
@endforeach
@endsection

@section('css')
<style type="text/css">
  .signature-pad{
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100% !important;
    height: 260px;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    $('#modal_form_ttd').on('shown.bs.modal', function () {
      $("#sub").hide();
      var canvas = document.getElementById('signature-pad');
      function resizeCanvas() {
        var ratio =  Math.max(window.devicePixelRatio || 0.5, 0.5);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    var signaturePad = new SignaturePad(canvas, {
      backgroundColor: 'rgb(255, 255, 255)'
  });
    document.getElementById('konfirmasi').addEventListener('click', function () {
        if(signaturePad.isEmpty()){
          $("#signature-pad").required();
      }else{
          $("#sub").show();
          var data = signaturePad.toDataURL('image/png');
          console.log(data);
          $('#form-group').html('<img src="'+data+'" style="width:50%!important;height:90px;"><textarea id="ttd" name="ttd" style="display:none;">'+data+'</textarea>');
      }
  });
    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
        $("#sub").hide();
    });
});
    $("#btn-ttd").click(function() {
        $("#ttdForm")[0].reset();
        $("#modal_form_ttd").modal('show');
    });

    $(function () {
        $('#ttdForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            show_loading();
            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                contentType: false,
                processData: false,
                url: "{{route('ttd_upload')}}",
                data: formData,
                success: function (response) {
                    hide_loading();
                    if (response.status == 'true') {
                        $("#ttdForm")[0].reset();
                        $('#modal_form_ttd').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        $("#content_cek").load(location.href + " #content_cek");
                        $("#content_ttd").load(location.href + " #content_ttd");
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
                    swal({
                        icon: 'error',
                        type: 'error',
                        title: 'Gagal',
                        dangerMode: true,
                        text: response.message
                    });
                }
            });
        });
    });
</script>
@endsection