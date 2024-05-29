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
		<label class="col-lg-4">Jenis Magang <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<select class="form-control" id="jenis_magang" name="jenis_magang">
					<option value="">.: PILIH JENIS MAGANG :.</option>
					<option value="Mandiri, periode libur perkuliahan">Mandiri</option>
					<option value="MBKM, periode perkuliahan">MBKM</option>
				</select>
				<span class="invalid-feedback d-block" role="alert" id="jenis_magangError">
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
		<label class="col-lg-4">Nama Instansi/Perusahaan <span class="text-danger">*</span> </label>
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
		<label class="col-lg-4">Alamat Instansi/Perusahaan <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<textarea rows="4" id="alamat_instansi" class="form-control" name="alamat_instansi"></textarea>
				<span class="invalid-feedback d-block" role="alert" id="alamat_instansiError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Tanggal Pelaksanaan sampai Berakhir Magang <span class="text-danger">*</span> </label>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="date" class="form-control" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan">
				<span class="invalid-feedback d-block" role="alert" id="tanggal_pelaksanaanError">
					<strong></strong>
				</span>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir">
				<span class="invalid-feedback d-block" role="alert" id="tanggal_berakhirError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Berapa bulan/pekan <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" placeholder="Contoh: 4 pekan/4 bulan" class="form-control" id="pekan_bulan" name="pekan_bulan">
				<span class="invalid-feedback d-block" role="alert" id="pekan_bulanError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Upload Berkas Persyaratan <span class="text-danger">*</span> </label>
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
