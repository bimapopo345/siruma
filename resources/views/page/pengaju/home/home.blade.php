@extends('page/desa/layout/app')

@section('title','Dashboard Pengaju')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{Auth::user()->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Surat Pengajuan tersedia</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    @foreach($surat as $sur)
    <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
        <div class="card" style="border: 1px solid {{$sur->bg}};border-left: none;border-right: none;">
            <div class="card-content">
                <div class="card-body" style="text-align: center;">
                    <p class="text-center"><span style="text-transform: uppercase;">{{$sur->nama_surat}}</span></p>
                    <p class="" style="border-bottom-right-radius: 40%;border-bottom-left-radius: 40%;">
                        <i class="bx bxs-file-plus" style="color: {{$sur->bg}};font-size: 700%;"></i>
                    </p>
                </div>
            </div>
            <div class="card-footer" style="text-align: center">
                <a href="{{route('request',['id_surat'=>$sur->id_surat, 'surat'=>$sur->nama_surat])}}" class="btn rounded-pill" style="border: 1px solid {{$sur->bg}}"> PENGAJUAN <i class="fa fa-arrow-up"></i> </a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" style="background: {{$sur->bg}}"></li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection