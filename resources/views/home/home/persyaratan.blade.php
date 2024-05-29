   <div class="modal fade text-left" id="detail{{$srt->id_surat}}" data-bs-backdrop="static" tabindex="-1" role="dialog"
      aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Persyaratan Permohonan Surat
                </h5>
            </div>
            <div class="modal-body">
                <div class="row" style="font-family: times new roman;">
                    <div class="col-lg-12 text-center">
                        <h3>{{$srt->nama_surat}}</h3>
                        <hr>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        $array = explode(PHP_EOL, $srt->persyaratan);
                        $total = count($array);
                        foreach($array as $item) {
                           echo " <span><i class='bi bi-check'></i>". $item ."</span><br>";
                       }
                       ?>
                   </div>
               </div>
           </div>
           <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Tutup</span>
            </button>
        </div>
    </div>
</div>
</div>

<div id="popup-overlay-{{$srt->id_surat}}" class="popup-overlay"></div>
<div id="popup-{{$srt->id_surat}}" class="popup">
    <div class="popup-content">
      <div class="row" style="font-family: times new roman;">
        <div class="col-lg-12 text-center">
            <button class="close-btn" style="background: transparent;" more_id_close="{{$srt->id_surat}}"><i class="bi bi-x"></i></button>
        </div>
        <div class="col-lg-12 text-center">
            <h3>{{$srt->nama_surat}}</h3>
            <hr>
        </div>
        <div class="col-lg-12">
            <?php
            $array = explode(PHP_EOL, $srt->persyaratan);
            $total = count($array);
            foreach($array as $item) {
             echo " <span><i class='bi bi-check'></i>". $item ."</span><br>";
         }
         ?>
     </div>
 </div>
</div>
</div>