@extends('page/desa/layout/app')

@section('title','Cek Surat Cetak')

@section('content')
<div class="container">
	 <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Cetak Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Preview</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
	@foreach($data as $dt)
	<div class="row">
		<div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
			<a href="{{route('cetak_surat',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])}}?keyword=print-surat" class="btn btn-sm form-control btn-primary mt-2" target="_blank"><i class="bx bx-printer"></i></a>
		</div>
	</div>
	@endforeach
</div>
@foreach($data as $dt)
<?php  
$nama_template = 'page/desa/template/'.$dt->singkatan_template.'/'.$dt->urutan_template.'/'.strtolower($dt->urutan_template);
$path_template_cek = 'page/desa/template/'.$dt->singkatan_template.'/'.$dt->urutan_template.'/cek';
// $path_template_print = 'desa/template/'.$dt->singkatan_template.'/'.$dt->urutan_template.'/print';
?>
@include($nama_template)
@endforeach
@endsection