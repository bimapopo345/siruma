<div class="col-lg-12">
	<div class="row">
		<label class="col-lg-4">Nama <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="nama" class="form-control" name="nama">
				<span class="invalid-feedback d-block" role="alert" id="namaError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">NIM <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="number" id="nim" class="form-control" name="nim">
				<span class="invalid-feedback d-block" role="alert" id="nimError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Semester <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="number" hidden="" id="semester_lain" class="form-control" name="semester_lain">
				<select class="form-control" id="semester" name="semester">
					<option value="">.: PILIH SEMESTER :.</option>
					<option value="2">2</option>
					<option value="4">4</option>
					<option value="6">6</option>
					<option value="8">8</option>
					<option value="lain">Lainnya</option>
				</select>
				<span class="invalid-feedback d-block" role="alert" id="semesterError">
					<strong></strong>
				</span>
				<span class="invalid-feedback d-block" role="alert" id="semester_lainError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Program Studi <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<?php  
				$prodi = array('Komunikasi Digital dan Media','Ekowisata','Teknologi Rekayasa Perangkat Lunak','Teknologi Rekayasa Komputer','Supervisor Jaminan Mutu Pangan','Manajemen Industri Jasa Makanan dan Gizi','Teknologi Industri Benih','Teknologi dan Manajemen Pembenihan Ikan','Teknologi dan Manajemen Ternak','Manajemen Agribisnis','Manajemen Industri','Analisa Kimia','Teknik dan Manajemen Lingkungan','Akuntansi','Paramedik Veteriner','Teknologi dan Manajemen Produksi Perkebunan','Teknologi Produksi dan Pengembangan Masyarakat Pertanian');
				?>
				<!-- <input type="text" id="prodi" class="form-control" name="prodi"> -->
				<select class="form-control" id="prodi" name="prodi">
					<option value="">.: PILIH PROGRAM STUDI :.</option>
					@foreach($prodi as $prd)
					<option value="{{$prd}}">{{$prd}}</option>
					@endforeach
				</select>
				<span class="invalid-feedback d-block" role="alert" id="prodiError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Tahun Akademik <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="tahun_akademik" placeholder="Contoh: 2023/2024" class="form-control" name="tahun_akademik">
				<span class="invalid-feedback d-block" role="alert" id="tahun_akademikError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Instansi/tempat MBKM <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="nama_instansi" class="form-control" name="nama_instansi">
				<span class="invalid-feedback d-block" role="alert" id="nama_instansiError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Nama Kegiatan <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<select class="form-control" id="nama_kegiatan" name="nama_kegiatan">
					<option value="">.: PILIH NAMA KEGIATAN :.</option>
					<option value="Magang dan Studi Independen Bersertifikat (MSIB)">Magang dan Studi Independen Bersertifikat (MSIB)</option>
					<option value="Kampus Mengajar Wirausaha Merdeka (MWK)">Kampus Mengajar Wirausaha Merdeka (MWK)</option>
					<option value="One Vilage One Ceo (OVOC)">One Vilage One Ceo (OVOC)</option>
					<option value="Summer Cource, Pertukaran Mahasiswa Merdeka (PMM)">Summer Cource, Pertukaran Mahasiswa Merdeka (PMM)</option>
					<option value="Indonesia International Student Mobility Awards (IISMA)">Indonesia International Student Mobility Awards (IISMA)</option>
					<option value="Magang Bersertifikat Kampus Merdeka (MBKM)">Magang Bersertifikat Kampus Merdeka (MBKM)</option>
				</select>
				<span class="invalid-feedback d-block" role="alert" id="nama_kegiatanError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Tanggal Mulai MBKM <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="date" id="tanggal_mulai" class="form-control" name="tanggal_mulai">
				<span class="invalid-feedback d-block" role="alert" id="tanggal_mulaiError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Tanggal Berakhir MBKM <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="date" id="tanggal_berakhir" class="form-control" name="tanggal_berakhir">
				<span class="invalid-feedback d-block" role="alert" id="tanggal_berakhirError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Dosen Pembimbing <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="dospem" class="form-control" name="dospem">
				<span class="invalid-feedback d-block" role="alert" id="dospemError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Berkas Persyaratan <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="file" id="berkas" class="form-control" name="berkas">
				<span class="invalid-feedback d-block" role="alert" id="berkasError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
</div>
