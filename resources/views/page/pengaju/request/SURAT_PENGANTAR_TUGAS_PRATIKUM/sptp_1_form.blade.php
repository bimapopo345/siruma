<div class="col-lg-12">
	<div class="row">
		<label class="col-lg-4">Nama Instansi <span class="text-danger">*</span> </label>
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
		<label class="col-lg-4">Alamat Instansi <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="alamat_instansi" class="form-control" name="alamat_instansi">
				<span class="invalid-feedback d-block" role="alert" id="alamat_instansiError">
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
		<label class="col-lg-4">Matakuliah <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" id="matakuliah" class="form-control" name="matakuliah">
				<span class="invalid-feedback d-block" role="alert" id="matakuliahError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-lg-4">Nama Dosen Pembimbing <span class="text-danger">*</span> </label>
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
		<label class="col-lg-4">Tanggal Wawancara <span class="text-danger">*</span> </label>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal">
				<span class="invalid-feedback d-block" role="alert" id="tanggal_awalError">
					<strong></strong>
				</span>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir">
				<span class="invalid-feedback d-block" role="alert" id="tanggal_akhirError">
					<strong></strong>
				</span>
			</div>
		</div>
	</div>
	<button type="button" id="add-more" class="btn btn-sm btn-success rounded-pill">
		<i class="fa fa-plus"></i>
	</button>
	<div class="row" id="after-add-more">
		<label class="col-lg-4">Nama Mahasiswa & NIM <span class="text-danger">*</span> </label>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Nama Mahasiswa" name="nama[]" required="">
				<span class="invalid-feedback d-block" role="alert">
					<strong></strong>
				</span>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<input type="number" class="form-control" placeholder="NIM" name="nim[]" required="">
				<span class="invalid-feedback d-block" role="alert">
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
