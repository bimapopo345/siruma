<!DOCTYPE html>
<html lang="en">
@foreach($data as $dt)
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$dt->nomor_surat}}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/dripicons/webfont.css')}}"> -->
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/pages/dripicons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
</head>
<style type="text/css">
    .footer_right {
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        text-align: right;
        padding: 10px;
    }
    .footer_center {
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        text-align: center;
        padding: 10px;
    }
    .footer_left {
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        text-align: left;
        padding: 10px;
    }
    .signature {
        display: inline-block;
        text-align: left;
        width: 70%; /* Adjust the width as needed */
        margin: 0 auto;
    }
</style>
<body style="background: white;color: black;">
    <div class="container-fluid" style="background: white;">
        <div class="row">
            <div class="col-xl-12">
                @foreach($desa as $ds)
                <center>
                    <img src="{{asset('kop.png')}}" alt="avatar" class="img" style="width: 100%;">
                </center>
                <br>
                <center>
                    <span style="text-transform: uppercase;font-size: 25px;letter-spacing: 4px;font-weight: bold;"><u>Surat Keterangan</u></span><br><span style="font-size: 15px;">Pengganti Kartu Tanda Mahasiswa (KTM)<br>Nomor : {{$dt->nomor_surat}}</span>
                </center>
                <p style="text-align: left;margin-top: 30px;">
                    Yang bertanda tangan dibawah ini, Wakil Dekan Sekolah Vokasi IPB Bogor, menerangkan bahwa :
                </p>
                <table border="0" style="margin-left: 10px;width: 100%;">
                    <?php  
                    $remark = explode(";", $dt->remark);
                    $remark_1 = explode(";", $dt->remark_1);
                    if ($remark[3] % 2 == 0) {
                        $semester = 'genap';
                    } else {
                        $semester = 'ganjil';
                    }
                    ?>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$remark[0]}}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{$remark[1]}}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{$remark[2]}}</td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>{{$remark[3]}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$remark[5]}}</td>
                    </tr>
                </table>
                <p><br>
                    Berdasarkan Surat Laporan yang diterima di bagian akademik pada tanggal {{tanggal_indonesia($dt->tanggal_surat)}} menyatakan bahwa yang bersangkutan telah kehilangan KTM asli.
                </p>
                <p>
                    Untuk itu, surat keterangan ini dibuat sebagai pengganti KTM, KTM berlaku selama 1 semester (semester {{$semester}} {{$remark[4]}}) dan agar dapat dipergunakan sebagaimana mestinya.
                </p>
                <div class="footer_center">
                    <div class="signature">
                        <img src="{{asset('pengajuan_berkas')}}/{{$remark_1[0]}}" style="float: left;width: 130px;margin-right: 4px;">
                        <div>
                            Bogor, {{tanggal_indonesia($dt->tanggal_surat)}}<br>
                            Wakil Dekan<br>
                            Bidang Akademik Kemahasiswaan dan Alumni,
                            <br>
                            @if($dt->ttd != NULL)
                            <img src="{{asset($dt->ttd)}}" class="text" height="65"><br>
                            @endif
                            @foreach($kepala as $kpl)
                            <u>{{$kpl->name}}</u><br>NIP. {{$kpl->nik}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </body>
    @endforeach
    </html>
