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
        width: 50%; /* Adjust the width as needed */
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
                    <table style="width: 100%;">
                       <tr>
                        <td>Nomor</td>
                        <td>:</td>
                        <td>{{$dt->nomor_surat}}</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td>Permohonan Kunjungan Praktikum</td>
                    </tr>
                </table>
            </center>
            <?php  
            $remark = explode(";", $dt->remark);
            $remark_1 = $dt->remark_1;
            // $remark = "Ferdi Utami-043922;Udin Khoirun-9392039;Sindi-039404;";
            $entries = explode(';', $remark_1);
            $entries = array_filter($entries);
            ?>
            <?php
            function terbilang($number) {
                $units = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
                $tens = ['', 'sepuluh', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 'tujuh puluh', 'delapan puluh', 'sembilan puluh'];
                $teens = ['', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'];
                $levels = ['', 'ribu', 'juta', 'milyar', 'triliun'];

                if ($number == 0) {
                    return 'nol';
                }

                $result = '';
                $level = 0;

                while ($number > 0) {
                    $part = $number % 1000;
                    $number = intval($number / 1000);

                    if ($part > 0) {
                        $hundreds = intval($part / 100);
                        $remainder = $part % 100;
                        $tensUnit = '';

                        if ($remainder < 10) {
                            $tensUnit = $units[$remainder];
                        } elseif ($remainder < 20) {
                            $tensUnit = $teens[$remainder - 10];
                        } else {
                            $tensUnit = $tens[intval($remainder / 10)] . ' ' . $units[$remainder % 10];
                        }

                        $hundredsUnit = $hundreds > 0 ? ($hundreds == 1 ? 'seratus' : $units[$hundreds] . ' ratus') : '';
                        $result = trim($hundredsUnit . ' ' . $tensUnit) . ' ' . $levels[$level] . ' ' . $result;
                    }

                    $level++;
                }
                return trim(str_replace('satu ribu', 'seribu', $result));
            }
            ?>
            <p class="text mt-5">
                Kepada Yth. <br>
                Pimpinan <br>
                <b>{{$remark[0]}}</b><br>
                {{$remark[1]}}
            </p>
            <p>
                Dengan Hormat <br>
                Dalam rangka pengembangan potensi mahasiswa Sekolah Vokasi Institut Pertanian Bogor, kami :
            </p>
            <table border="0" style="margin-left: 20px;width: 80%;">
                <tr>
                    <td>Program Studi</td>
                    <td>:</td>
                    <td>{{$remark[2]}}</td>
                </tr>
                <tr>
                    <td>Mata Kuliah</td>
                    <td>:</td>
                    <td>{{$remark[5]}}</td>
                </tr>
                <tr>
                    <td>Nama Dosen Pembimbing</td>
                    <td>:</td>
                    <td>{{$remark[6]}}</td>
                </tr>
            </table>
            <p><br>
                Memberikan tugas kepada mahasiswa Program Studi {{$remark[2]}} semester <b>{{$remark[3]}} ({{terbilang($remark[3])}})</b> tahun akademik {{$remark[4]}}, yang akan melakukan kunjungan ke perusahaan/instansi yang bapak/ibu pimpin, guna melengkapi tugas praktikum. Kegiatan tersebut akan dilaksanakan {{tanggal_indonesia($remark[7])}} - {{tanggal_indonesia($remark[8])}}, adapun nama mahasiswa yang dimaksud sebagai berikut:
            </p>
            <table style="width: 85%;margin-left: 20px;border-bottom: 1px solid;text-align: center;">
                <tr style="border-top: 1px solid;border-bottom: 1px solid;">
                    <th>No.</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                </tr>
                @foreach($entries as $ets)
                <?php  
                list($nama, $nim) = explode('-', $ets);
                ?>
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$nama}}</td>
                    <td>{{$nim}}</td>
                </tr>
                @endforeach
            </table>
            <p class="text mt-4">
                Berkaitan dengan hal tersebut diatas, kami mohon bantuan dan kerjasama bapak/ibu dalam kegiatan mahasiswa kami. Demikian permohonan ini kami sampaikan dan besar harapan kami untuk dapat bapak/ibu pertimbangkan.
            </p>
            <p>
                Atas perhatian, bantuan dan kerjasamanya kami mengucapkan terima kasih.
            </p>
            <div class="footer_right">
                <div class="signature">
                    <div>
                        Wakil Dekan
                        Bidang Akademik,<br> Kemahasiswaan dan Alumni,
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
