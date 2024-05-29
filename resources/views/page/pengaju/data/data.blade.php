@extends('page/desa/layout/app')

@section('title','Data Request Surat Permohonan')

@section('content')
<section class="section">
  <div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Pengajuan Saya</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$singkatan}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Data Pengajuan Surat Saya
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-responsive dt-responsive" style="width: 100%;" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Tanggal Pengajuan</th>
                        <th>Surat</th>
                        <!-- <th>Nama</th> -->
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <tr>
                        <th><?=$no; ?>. </th>
                        <td>{{tanggal_indonesia($dt->tgl_req)}}</td>
                        <td>{{$dt->nama_surat}}</td>
                        <!-- <td>{{$dt->name}}</td> -->
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
                        <td align="center">
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#detail{{$dt->id_pengajuan}}" class="btn btn-sm btn-primary rounded-pill"><i class="bx bx-file"></i></a>
                            @if($dt->selesai=="Surat Selesai")
                            <a href="{{route('cetak_surat',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])}}?keyword=print-surat" class="btn btn-sm btn-danger rounded-pill"><i class="bx bx-printer"></i></a>
                            @endif
                        </td>
                    </tr>
                    <?php $no++ ?>
                    @include('page/pengaju/data/detail')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</section>
@endsection