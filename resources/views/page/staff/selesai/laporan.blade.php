@extends('page/desa/layout/app')

@section('title','Laporan Surat')

@section('content')
<div class="container mb-3">
    <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan /</span> Surat Pengajuan</h4> -->
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Surat Pengajuan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
     <div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
        <form method="get">
            @csrf
            <input type="date" required="" class="form-control mt-4" name="awal">
            <input type="date" required="" class="form-control mt-1" name="akhir">
            <button class="btn btn-sm btn-primary mt-2"><i class="fa fa-filter"></i> Tampilkan</button>
            @if(!empty($_GET['awal']))
            <a href="{{route('print',['awal'=>$_GET['awal'],'akhir'=>$_GET['akhir']])}}" class="btn btn-sm btn-danger mt-2" target="_blank"><i class="fa fa-print"></i></a>
            @endif
        </form>
    </div>
</div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            Laporan Pengajuan Surat
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nomor Surat</th>
                            <th>Surat</th>
                            <th>Nama Pengaju</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $dt)
                        <tr>
                            <th><?=$no; ?>. </th>
                            <td>{{tanggal_indonesia($dt->tgl_req)}}</td>
                            <td>{{$dt->nomor_surat}}</td>
                            <td>{{$dt->nama_surat}}</td>
                            <td>{{$dt->name}}</td>
                            <td>
                                @if($dt->status_pengajuan=="Pengecekan Permohonan")
                                <span class="badge bg-danger">Data Sedang <br>di Periksa</span>
                                @elseif($dt->status_pengajuan=="Data Belum Lengkap")
                                <span class="badge bg-danger">{{$dt->status_pengajuan}}</span>
                                @else
                                <span class="badge bg-success">{{$dt->status_pengajuan}}</span>
                                @endif
                            </td>
                            <td>
                                @if($dt->selesai==NULL)
                                Menunggu Konfirmasi
                                @endif
                                @if($dt->selesai!==NULL)
                                <span class="badge bg-success">
                                    {{$dt->selesai}}
                                </span>
                                @endif
                            </td>
                        </tr>
                        <?php $no++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
@endsection