<div class="container mt-3" id="content_cek" style="background: white;color: #000;">
    <div class="row">
        <div class="col-lg-2">

        </div>
        <div class="col-lg-8">
            @foreach($desa as $ds)
            <img src="{{asset('kop.png')}}" alt="avatar" class="img" style="width: 100%;">
            <br>
            <br>
            <center>
                <span style="text-transform: uppercase;font-size: 25px;letter-spacing: 4px;font-weight: bold;"><u>Surat Keterangan</u></span><br><span style="font-size: 15px;">Pengganti Kartu Tanda Mahasiswa (KTM)<br>Nomor : {{$dt->nomor_surat}}</span>
                
            </center>
            <p class="text mt-5">
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
            <div class="row" style="margin-top: 10%;">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                    <img src="{{asset('pengajuan_berkas')}}/{{$remark_1[0]}}" style="float: left;width: 130px;margin-right: 4px;">
                    Bogor, {{tanggal_indonesia($dt->tanggal_surat)}}<br>
                    Wakil Dekan<br>
                    Bidang Akademik Kemahasiswaan dan Alumni,
                    <br>
                    @if($dt->ttd != NULL)
                    <img src="{{asset($dt->ttd)}}" class="text" height="65"><br>
                    @endif
                    @foreach($kades as $kpl)
                    <u>{{$kpl->name}}</u><br>NIP. {{$kpl->nik}}
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-2">

        </div>
    </div>
</div>