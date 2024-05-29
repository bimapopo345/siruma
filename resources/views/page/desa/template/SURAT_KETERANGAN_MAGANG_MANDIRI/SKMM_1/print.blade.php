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
                            <td colspan="2">-</td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td>{{$dt->nomor_surat}}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td>Surat Permohonan Magang</td>
                        </tr>
                    </table>
                </center>
                <?php  
                $remark = explode(";", $dt->remark);
                $remark_1 = explode(";", $dt->remark_1);
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
                    <b>{{$remark_1[0]}}</b><br>
                    {{$remark_1[1]}}
                </p>
                <p>
                    Dengan Hormat <br>
                    Dalam rangka mengembangkan potensi serta mengisi liburan akhir semester bagi mahasiswa Sekolah Vokasi IPB, maka dengan ini disampaikan bahwa mahasiswa dari Program Studi <b>{{$remark[3]}}</b> semester <b>{{$remark[4]}} ({{terbilang($remark[4])}})</b> yang tercantum di bawah ini:
                </p>
                <table border="0" style="width: 80%;text-align: center;margin: auto;">
                    <tr>
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>{{$remark[0]}}</td>
                        <td>{{$remark[1]}}</td>
                    </tr>
                </table>
                <p><br>
                    Akan mengikuti magang di instansi yang Bapak/Ibu pimpin selama {{$remark_1[4]}} yang akan dilaksanakan sejak {{tanggal_indonesia($remark_1[2])}} - {{tanggal_indonesia($remark_1[3])}}.<br>
                    Berkaitan hal tersebut di atas, maka dengan ini kami mohon izin dan bantuan Bapak/Ibu untuk dapat menerima mahasiswa kami melaksanakan kegiatan magang, agar proses pembelajaran mahasiswa kami dapat terlaksana dengan baik.
                </p>
                <p>
                    Demikian disampaikan, atas perhatian, izin dan bantuannya kami mengucapkan banyak terima kasih.
                </p>
                <div class="footer_right">
                    <div class="signature">
                        <div>
                            Wakil Dekan<br>
                            Bidang Akademik, Kemahasiswaan dan Alumni,
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
