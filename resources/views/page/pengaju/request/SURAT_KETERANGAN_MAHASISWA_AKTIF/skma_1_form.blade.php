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
		<label class="col-lg-4">Tempat/Tanggal Lahir <span class="text-danger">*</span> </label>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="text" id="tempat" class="form-control" name="tempat">
				<span class="invalid-feedback d-block" role="alert" id="tempatError">
					<strong></strong>
				</span>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="date" id="tanggal_lahir" class="form-control" name="tanggal_lahir">
				<span class="invalid-feedback d-block" role="alert" id="tanggal_lahirError">
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
		<label class="col-lg-4">Nama Orang Tua/Wali <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="nama_ortu" class="form-control" name="nama_ortu">
				<span class="invalid-feedback d-block" role="alert" id="nama_ortuError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Pekerjaan Orang Tua <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="pekerjaan_ortu" class="form-control" name="pekerjaan_ortu">
				<span class="invalid-feedback d-block" role="alert" id="pekerjaan_ortuError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Alamat Orang Tua <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="alamat_ortu" class="form-control" name="alamat_ortu">
				<span class="invalid-feedback d-block" role="alert" id="alamat_ortuError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Keperluan Pengajuan <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="keperluan" placeholder="Jika untuk beasiswa, sebutkan beasiswanya" class="form-control" name="keperluan" required="">
				<span class="invalid-feedback d-block" role="alert" id="keperluanError">
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
