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
                    <span style="text-transform: uppercase;font-size: 25px;letter-spacing: 4px;font-weight: bold;"><u>Surat Keterangan</u></span><br><span style="font-size: 15px;font-weight: bold;">Nomor : {{$dt->nomor_surat}}</span>
                </center>
                <p class="text mt-5 mb-4">
                    Yang bertandatangan di bawah ini Wakil Dekan Bidang Akademik, Kemahasiswaan dan Alumni Sekolah Vokasi IPB, menerangkan bahwa :
                </p>
                <table border="0" style="margin-left: 30px;width: 80%;" cellpadding="5">
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
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$remark[0]}}</td>
                    </tr>
                    <tr>
                        <td>Tempat/Tgl. lahir</td>
                        <td>:</td>
                        <td>{{$remark[1]}}/{{tanggal_indonesia($remark[2])}}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{$remark[3]}}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{$remark[4]}}</td>
                    </tr>
                    <tr>
                        <td>Nama Orang Tua/Wali</td>
                        <td>:</td>
                        <td>{{$remark_1[0]}}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan Orang Tua</td>
                        <td>:</td>
                        <td>{{$remark_1[1]}}</td>
                    </tr>
                    <tr>
                        <td>Alamat Orang Tua</td>
                        <td>:</td>
                        <td>{{$remark_1[2]}}</td>
                    </tr>
                </table>
                <p>
                    <br>
                    Adalah benar mahasiswa Sekolah Vokasi IPB Institut Pertanian Bogor yang saat ini tercatat pada semester {{$remark[5]}} ({{terbilang($remark[5])}}) Tahun Akademik {{$remark[6]}}.
                </p>
                <p>
                    Demikian Surat Keterangan ini dibuat untuk <b>{{$dt->keperluan}}</b>
                </p>
                <div class="footer_right">
                    <div class="signature">
                        <div>
                            Bogor, {{tanggal_indonesia($dt->tanggal_surat)}}<br>
                            Wakil Dekan Bidang Akademik Kemahasiswaan, dan Alumni,
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
