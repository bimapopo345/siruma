@extends('page/desa/layout/app')

@foreach($data as $dt)
@section('title','Cek Pelengkap Permohonan')

@section('content')
<div class="page-content">
    <section class="row">
       <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Validasi Pengajuan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="form form-vertical" method="post" action="{{route('keterangan',$dt->id_pengajuan)}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="" hidden="" name="id_surat" value="{{$dt->id_surat}}">
                                        <input type="" hidden="" name="singkatan" value="{{$dt->singkatan}}">
                                        <label for="first-name-vertical">Keterangan</label>
                                        <select class="form-control" id="keterangan" name="keterangan">
                                            <option value="">.: OPSI STATUS PENGAJUAN :.</option>
                                            <option <?php if($dt->status_pengajuan=="Data Sudah Lengkap"){echo "selected";} ?> value="Data Sudah Lengkap">Data Sudah Lengkap</option>
                                            <option <?php if($dt->status_pengajuan=="Data Belum Lengkap"){echo "selected";} ?> value="Data Belum Lengkap">Data Belum Lengkap</option>
                                        </select>
                                        <button class="btn btn-sm btn-outline-primary rounded-pill mt-2 mb-2"> <i class="fa fa-edit"></i> Ubah</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Konfirmasi</label>
                                    <a href="" data-bs-target="#modal_form_nomor" data-bs-toggle="modal" class="btn btn-sm btn-outline-success rounded-pill mt-2 form-control"> <i class="icon dripicons-checkmark"></i> Masukkan Nomor Surat </a>
                                </div>
                            </div>
                            <hr>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">NIK</label>
                                    <p>{{$dt->nik}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Nama Lengkap</label>
                                    <p>{{$dt->name}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Email</label>
                                    <p>{{$dt->email}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Telepon</label>
                                    <p>{{$dt->telepon}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Agama</label>
                                    <p>{{$dt->agama}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Alamat</label>
                                    <p>{{$dt->alamat}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Jenis Kelaminn</label>
                                    <p>{{$dt->jenis_kelamin}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Tempat Lahir</label>
                                    <p>{{$dt->tempat}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Pekerjaan</label>
                                    <p>{{$dt->pekerjaan}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Tanggal Lahir</label>
                                    <p>{{$dt->tgl_lahir}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Keperluan</label>
                                    <p>
                                        @if($dt->keperluan == NULL)
                                        {{$dt->nama_surat}}
                                        @else
                                        {{$dt->keperluan}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Status Pengajuan</label>
                                    <p>{{$dt->status_pengajuan}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Keterangan</label>
                                    <p>
                                        @if($dt->selesai==NULL)
                                        Menunggu Konfirmasi
                                        @endif
                                        @if($dt->selesai!==NULL)
                                        {{$dt->keterangan}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Request Surat</label>
                                    <p>{{$dt->nama_surat}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Tanggal Request</label>
                                    <p>{{$dt->tgl_req}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email-id-vertical">Nomor Surat</label>
                                    <p>{{$dt->nomor_surat}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade text-left" id="modal_form_nomor" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Konfirmasi Pengajuan & Nomor Surat</h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form method="get" enctype="multipart/form-data" action="{{route('konfirmasi',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nomor Surat</label>
                                    <input type="" hidden="" value="{{$dt->id_surat}}" name="id_surat">
                                    <input type="text" class="form-control" placeholder="Masukkan nomor surat ..." required="" id="nomor_surat" name="nomor_surat">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <span class="">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-outline-success ml-1" onclick="return confirm('Lanjut konfirmasi Pengajuan')">
                        <i class="bx bx-check"></i>
                        <span class="">Konfirmasi Pengajuan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<div class="col-12 col-lg-4">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">Berkas Pengajuan</h4>
                <hr>
                <div class="form-body">
                    @foreach($berkas as $brk)
                    <div class="row mt-2">
                        <a href="{{asset('pengajuan_berkas')}}/{{$brk->data_berkas}}" download="" class="btn btn-md btn-outline-success"><i class="fa fa-file"></i></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
</section>
</div>
@endsection
@section('scripts')
<!-- <script type="text/javascript">
    $("#catatan_pengajuan").hide();
    $(document).on('change','#keterangan',function() {
        var keteranganValue = $(this).val();
        if (keteranganValue) {
            if (keteranganValue == 'Data Sudah Lengkap') {
                $("#catatan_pengajuan").hide();
                $("#catatan_pengajuan").attr('required',false);
            }else{
                $("#catatan_pengajuan").show();
                $("#catatan_pengajuan").attr('required',true);
            }
        }
    });
    setTimeout(function() {
        var keterangan = "{{$dt->status_pengajuan}}";
        var catatan = "{{$dt->catatan_pengajuan}}";
        $("#catatan_pengajuan").val(catatan);
        $("#keterangan").val(keterangan).trigger('change');
    }, 1000);
</script> -->
@endsection
@endforeach