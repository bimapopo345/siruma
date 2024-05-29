<div class="modal fade" id="detail{{$dt->id_pengajuan}}" data-bs-backdrop="static" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel1">Detail Informasi</h5>
         <button
         type="button"
         class="btn-close"
         data-bs-dismiss="modal"
         aria-label="Close"
         ></button>
     </div>
     <div class="modal-body">
        <div class="row">
            <div class="col-6">
                Pengajuan Surat
            </div>
            <div class="col-6">
                {{$dt->nama_surat}}
            </div>
            <div class="col-6">
                Nomor Surat
            </div>
            <div class="col-6">
                {{$dt->nomor_surat}}
            </div>
            <div class="col-6">
                Tanggal Pengajuan
            </div>
            <div class="col-6">
                {{tanggal_indonesia($dt->tgl_req)}}
            </div>
            <div class="col-6">
                Keperluan
            </div>
            <div class="col-6">
                @if($dt->keperluan == NULL)
                {{$dt->nama_surat}}
                @else
                {{$dt->keperluan}}
                @endif
            </div>
           <!--  <div class="col-6">
                NIK
            </div>
            <div class="col-6">
                {{$dt->nik}}
            </div> -->
            <div class="col-6">
                Status Pengajuan
            </div>
            <div class="col-6">
                @if($dt->status_pengajuan=="Pengecekan Permohonan")
                Data Sedang di Periksa
                @else
                <b>{{$dt->status_pengajuan}}</b>
                @endif
            </div>
            @if($dt->status_pengajuan=="Data Belum Lengkap")
            <div class="col-6">
                Keterangan Status Pengajuan
            </div>
            <div class="col-6">
                <?php
                $array = explode(PHP_EOL, $dt->catatan_pengajuan);
                $total = count($array);
                foreach($array as $item) {
                  echo "<b>". $item . "</b><br>";
              }
              ?>
          </div>
          @endif
            <!-- <div class="col-6 mt-5">
                <b><i>Note : </i></b>
            </div>
            <div class="col-6">
                <i><b>SILAHKAN TUNGGU PENGAJUAN SEDANG DI VERIFIKASI, INFO AKAN DI KIRIM MELALUI EMAIL ANDA.</b></i>
            </div> -->
            <hr>
            @foreach($pelengkap as $br)
            @if($br->pengajuan_id==$dt->id_pengajuan)
            <div class="col-lg-4">
                <a href="{{asset('pengajuan_berkas')}}/{{$br->data_berkas}}" class="btn btn-md btn-success text-white" download=""><i class="fa fa-file"></i> Lihat Berkas</a>
                <!-- <img src="" width="50"> -->
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="button"
        class="btn btn-outline-secondary"
        data-bs-dismiss="modal">
        <span class="">Tutup</span>
    </button>
    <!--  -->
</div>
</div>
</div>
</div>