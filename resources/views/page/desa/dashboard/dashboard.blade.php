@extends('page/desa/layout/app')

@section('title','Dashboard Admin')

@section('content')
<div class="page-heading">
    <h3>Dashboard Desa</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-xl-12">
            <div class="row">
                <div class="col-lg-3 mt-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-user" style="font-size: 0.5in;"></i>
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
                        <a class="dropdown-item" href=" {{route('data_user','Pengaju')}} ">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <span class="fw-semibold d-block mb-1">User Pengaju</span>
            <h3 class="card-title mb-2">{{$pengaju}}</h3>
        </div>
    </div>
</div>
<div class="col-lg-3 mt-2">
  <div class="card">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar flex-shrink-0">
            <i class="bx bx-user" style="font-size: 0.5in;"></i>
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
        <a class="dropdown-item" href=" {{route('data_user','Pengurus')}} ">Lihat Detail</a>
    </div>
</div>
</div>
<span class="fw-semibold d-block mb-1">User Pengurus</span>
<h3 class="card-title mb-2">{{$pengurus}}</h3>
</div>
</div>
</div>
<div class="col-lg-3 mt-2">
  <div class="card">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar flex-shrink-0">
            <i class="bx bx-file" style="font-size: 0.5in;"></i>
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
        <a class="dropdown-item" href=" {{route('data_surat')}} ">Lihat Detail</a>
    </div>
</div>
</div>
<span class="fw-semibold d-block mb-1">Layanan Surat</span>
<h3 class="card-title mb-2">{{$surat}}</h3>
</div>
</div>
</div>
<div class="col-lg-3 mt-2">
  <div class="card">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar flex-shrink-0">
            <i class="bx bx-time" style="font-size: 0.5in;"></i>
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
        <a class="dropdown-item" href=" {{route('waktu_layanan')}} ">Lihat Detail</a>
    </div>
</div>
</div>
<span class="fw-semibold d-block mb-1">Waktu Pelayanan</span>
<h3 class="card-title mb-2">{{$layanan}}</h3>
</div>
</div>
</div>
<div class="col-lg-3 mt-2">
  <div class="card">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar flex-shrink-0">
            <i class="bx bx-note" style="font-size: 0.5in;"></i>
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
        <a class="dropdown-item" href=" {{route('prosedur')}} ">Lihat Detail</a>
    </div>
</div>
</div>
<span class="fw-semibold d-block mb-1">Prosedur Pengajuan</span>
<h3 class="card-title mb-2">{{$prosedur}}</h3>
</div>
</div>
</div>


</div>

</div>
</section>
</div>
@endsection