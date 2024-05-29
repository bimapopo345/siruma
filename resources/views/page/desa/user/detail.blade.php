@extends('page/desa/layout/app')
@section('title','Detail Data User')
@section('content')
<div class="page-heading">
  <div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Data User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Detail</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h2>Detail Profil User</h2>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        @foreach($data as $cst)
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
</div>
<div class="row mb-4">
    @foreach($data as $cst)
    @if($cst->alamat==NULL)
    <div class="alert alert-light-danger color-danger"><i
        class="bi bi-exclamation-circle"></i> ALAMAT TIDAK DI KETAHUI</div>
        @else
        <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$cst->alamat}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        @endif

        @endforeach
    </div>
    @endsection