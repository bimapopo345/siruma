@extends('page/desa/layout/app')

@section('title','Data Prosedur')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Master Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Prosedur Pengajuan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Prosedur Pengajuan
                @if(count($data) == 0)
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#default">
                <i class="fa fa-plus "></i> Tambahkan Prosedur
            </button>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Prosedur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$no}}. </td>
                        <td>{{$dt->prosedur}}</td>
                        <td align="center">
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#edit{{$dt->id_prosedur}}" class="btn btn-sm rounded-pill btn-success">
                            <i class="fa fa-edit"></i></a>
                            <a href="{{route('hapus_prosedur',$dt->id_prosedur)}}" onclick="return confirm('Lanjutkan Hapus Data?')" class="btn btn-sm rounded-pill btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @include('page/desa/prosedur/update')
                    <?php $no++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>

</section>
</div>
@include('page/desa/prosedur/tambah')
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection