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
        width: 40%; /* Adjust the width as needed */
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
                    <span style="text-transform: uppercase;font-size: 25px;letter-spacing: 4px;font-weight: bold;"><u>Surat Tugas</u></span><br><span style="font-size: 15px;font-weight: bold;">No : {{$dt->nomor_surat}}</span>
                </center>
                <p class="text mt-5">
                    Kami menugaskan nama di bawah ini :
                </p>
                <table border="0" style="margin-left: 30px;width: 80%;text-align: center;">
                    <?php  
                    $remark = explode(";", $dt->remark);
                    $remark_1 = explode(";", $dt->remark_1);
                    ?>
                    <?php  
                    function hitungSelisihTanggal($tanggal1, $tanggal2) {
                        $date1 = new DateTime($tanggal1);
                        $date2 = new DateTime($tanggal2);
                        $interval = $date1->diff($date2);

                        if ($interval->y > 0) {
                            return $interval->y . ' tahun';
                        } elseif ($interval->m > 0) {
                            return $interval->m . ' bulan';
                        } elseif ($interval->d >= 7) {
                            $weeks = floor($interval->d / 7);
                            return $weeks . ' minggu';
                        } else {
                            return $interval->d . ' hari';
                        }
                    }
                    ?>
                    <tr style="border-top: 1px solid;">
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                    </tr>
                    <tr style="border-top: 1px solid;">
                        <td>1</td>
                        <td>{{$remark[0]}}</td>
                        <td>{{$remark[1]}}</td>
                    </tr>
                </table>
                <p><br>
                    Mahasiswa Sekolah Vokasi Institut Pertanian Bogor Program Studi <b>{{$remark[3]}}</b> untuk melaksanakan Program Merdeka Belajar Kampus Merdeka (MBKM) di:
                </p>
                <table style="width: 100%;">
                    <tr>
                        <td>Instansi / Tempat</td>
                        <td>:</td>
                        <td>{{$remark_1[0]}}</td>
                    </tr>
                    <tr>
                        <td>Nama Kegiatan</td>
                        <td>:</td>
                        <td>{{$remark_1[1]}}</td>
                    </tr>
                    <tr>
                        <td>Lama MBKM</td>
                        <td>:</td>
                        <td>{{hitungSelisihTanggal($remark_1[2],$remark_1[3])}}</td>
                    </tr>
                    <tr>
                        <td>Periode</td>
                        <td>:</td>
                        <td>{{tanggal_indonesia($remark_1[2])}} - {{tanggal_indonesia($remark_1[3])}}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing</td>
                        <td>:</td>
                        <td>{{$remark_1[4]}}</td>
                    </tr>
                </table>
                <p class="text mt-3">
                    Para mahasiswa diharapkan dapat memperoleh pengalaman, menimba ilmu serta 
                    meningkatkan kompetensi baik itu soft skils maupun hard skills agar lebih siap dan 
                    relevan dengan kebutuhan saat ini. 
                </p>
                <p>
                    Agar pelaksanaan Program Merdeka Belajar Kampus Merdeka (MBKM) dapat berjalan 
                    dengan lancar, dimohon kepada pimpinan Perusahaan/Instansi yang bersangkutan dan 
                    instansi-instansi yang berhubungan untuk memberikan bantuan yang diperlukan.
                </p>
                <p>
                    Demikian surat tugas ini diberikan kepada yang bersangkutan, untuk dilaksanakan 
                    dengan sebaik-baiknya.
                </p>
                <div class="footer_right">
                    <div class="signature">
                        <div>
                            Bogor, {{tanggal_indonesia($dt->tanggal_surat)}}<br>
                            Dekan,<br>
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
