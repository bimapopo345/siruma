<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengajuan Surat</title>

    <!-- <link rel="stylesheet" href="{{asset('print.css')}}"> -->
</head>
<style type="text/css">
    @page {
        margin: 100px 25px;
    }

    header {
      position: fixed;
      top: -100px;
      left: 0px;
      right: 0px;
      height: 50px;
      font-size: 20px !important;

      /** Extra personal styles **/
      /*background-color: #008B8B;*/
      /*color: white;*/
      text-align: center;
      line-height: 35px;
  }

  footer {
    position: fixed; 
    bottom: -30px; 
    left: 0px; 
    right: 0px;
    height: 50px; 
    font-size: 20px !important;

    /** Extra personal styles **/
    /*background-color: #008B8B;*/
    /*color: white;*/
    text-align: center;
    line-height: 35px;
}
</style>
<body>

    <header>
        <center>
            <img src="{{asset('foto')}}/{{$desa->logo}}" alt="avatar" class="img pt-3" width="55" style="float: left;padding-top: 13px;">
            Rekap Laporan<br>{{$desa->nama_profil}}<br>
            <sup><small>{{$desa->lokasi_desa}}
                | {{$desa->telepon_desa}}</small></sup>
            </center>
        </header>
        <!-- <footer>
           <center>
            <img src="{{asset('foto')}}/{{$desa->logo}}" alt="avatar" class="img pt-3" width="55" style="float: left;padding-top: 13px;">
            {{$desa->nama_profil}}<br>
            <sup><small>{{$desa->lokasi_desa}}
                | {{$desa->telepon_desa}}</small></sup>
            </center>
        </footer> -->

        <main>
            <div class="card-body" style="font-family: times new roman;">
                <table class="table table-bordered" style="width: 100%;margin-top: 1rem;" cellpadding="6" cellspacing="0" border="1">
                    <thead style="background: #aaa;">
                        <tr>
                            <th>No. </th>
                            <th>Nama Pengaju</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nomor Surat</th>
                            <!-- <th>NIM</th> -->
                            <!-- <th>Keperluan</th> -->
                            <th>Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $dt)   
                        <tr>
                            <td>{{$no}}.</td>
                            <td>{{$dt->name}}<br>({{$dt->nik}})</td>
                            <td>{{tanggal_indonesia($dt->tgl_req)}}</td>
                            <td>{{$dt->nomor_surat}}</td>
                            <!-- <td>{{$dt->nik}}</td> -->
                            <!-- <td>{{$dt->keperluan}}</td> -->
                            <td>{{$dt->nama_surat}}</td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
    </html>
