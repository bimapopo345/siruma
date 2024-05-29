@extends('page/desa/layout/app')
@section('title','Dashboard Kepala Desa')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                @foreach($data as $dt)
                <?php  
                $jml=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.selesai','=','Sudah di Konfirmasi')->count();
                ?>
                <div class="col-lg-3 mt-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bxs-file-plus" style="font-size: 0.5in;color: {{$dt->bg}}"></i>
                        </div>
                        <div class="dropdown">
                          <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt3"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                          >
                          <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href=" {{route('kepaladesa_acc',['id_surat'=>$dt->id_surat,'surat'=>$dt->singkatan])}} ">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <span class="fw-semibold d-block mb-1">{{$dt->nama_surat}}</span>
            <h3 class="card-title mb-2">{{$jml}}</h3>
        </div>
    </div>
</div>
@endforeach
</div>
<!--  -->
<!--  -->
</div>
</section>
</div>
@endsection