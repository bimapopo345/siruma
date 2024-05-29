<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Pengajuan extends Model
{
    // use HasFactory;
	protected $table="pengajuan";
	protected $primaryKey="id_pengajuan";

	public static function validasiPengajuanRequest($request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'berkas' => 'required'
		];

		if ($request->singkatan_template == 'SURAT_KETERANGAN_MAHASISWA_AKTIF_1') {
			$validateRules += [
				'nama' => 'required',
				'tempat' => 'required',
				'tanggal_lahir' => 'required',
				'nim' => 'required',
				'prodi' => 'required',
				'semester' => 'required',
				'tahun_akademik' => 'required',
				'nama_ortu' => 'required',
				'pekerjaan_ortu' => 'required',
				'alamat_ortu' => 'required'
			];
			if ($request->semester == 'lain') {
				$validateRules += [
					'semester_lain' => 'required',
				];
				$semester = $request->semester_lain;
			}else{
				$semester = $request->semester;
			}
			$remark = implode(';', array_filter([$request->nama, $request->tempat, $request->tanggal_lahir, $request->nim, $request->prodi, $semester, $request->tahun_akademik]));
			$remark_1 = implode(';', array_filter([$request->nama_ortu, $request->pekerjaan_ortu, $request->alamat_ortu]));
		}elseif ($request->singkatan_template == 'SURAT_KETERANGAN_KEHILANGAN_KTM_1') {
			$validateRules += [
				'nama' => 'required',
				'nim' => 'required',
				'prodi' => 'required',
				'semester' => 'required',
				'tahun_akademik' => 'required',
				'alamat_domisili' => 'required',
				'foto_ktm' => 'required'
			];
			if ($request->hasFile('foto_ktm')) {
				$foto_ktm = $request->file('foto_ktm');
				$nama_file = $foto_ktm->getClientOriginalName();
				$file_foto = uniqid();
				$file_foto .= $nama_file;
			}else{
				$file_foto = NULL;
			}
			if ($request->semester == 'lain') {
				$validateRules += [
					'semester_lain' => 'required',
				];
				$semester = $request->semester_lain;
			}else{
				$semester = $request->semester;
			}
			$remark = implode(';', array_filter([$request->nama, $request->nim, $request->prodi, $semester, $request->tahun_akademik, $request->alamat_domisili]));
			$remark_1 = $file_foto.';';
		}elseif ($request->singkatan_template == 'SURAT_KETERANGAN_MAGANG_MANDIRI_1') {
			$validateRules += [
				'nama' => 'required',
				'nim' => 'required',
				'jenis_magang' => 'required',
				'prodi' => 'required',
				'semester' => 'required',
				'nama_instansi' => 'required',
				'alamat_instansi' => 'required',
				'tanggal_pelaksanaan' => 'required',
				'tanggal_berakhir' => 'required',
				'pekan_bulan' => 'required'
			];
			if ($request->semester == 'lain') {
				$validateRules += [
					'semester_lain' => 'required',
				];
				$semester = $request->semester_lain;
			}else{
				$semester = $request->semester;
			}
			$remark = implode(';', array_filter([$request->nama, $request->nim, $request->jenis_magang, $request->prodi, $semester]));
			$remark_1 = implode(';', array_filter([$request->nama_instansi, $request->alamat_instansi, $request->tanggal_pelaksanaan, $request->tanggal_berakhir, $request->pekan_bulan]));
		}elseif ($request->singkatan_template == 'SURAT_TUGAS_MERDEKA_BELAJAR_KAMPUS_MERDEKA_1') {
			$validateRules += [
				'nama' => 'required',
				'nim' => 'required',
				'semester' => 'required',
				'prodi' => 'required',
				'tahun_akademik' => 'required',
				'nama_instansi' => 'required',
				'nama_kegiatan' => 'required',
				'tanggal_mulai' => 'required',
				'tanggal_berakhir' => 'required',
				'dospem' => 'required'
			];
			if ($request->semester == 'lain') {
				$validateRules += [
					'semester_lain' => 'required',
				];
				$semester = $request->semester_lain;
			}else{
				$semester = $request->semester;
			}
			$remark = implode(';', array_filter([$request->nama, $request->nim, $semester, $request->prodi, $request->tahun_akademik]));
			$remark_1 = implode(';', array_filter([$request->nama_instansi, $request->nama_kegiatan, $request->tanggal_mulai, $request->tanggal_berakhir, $request->dospem]));
		}elseif ($request->singkatan_template == 'SURAT_PENGANTAR_TUGAS_PRATIKUM_1') {
			$validateRules += [
				'nama_instansi' => 'required',
				'alamat_instansi' => 'required',
				'prodi' => 'required',
				'semester' => 'required',
				'tahun_akademik' => 'required',
				'matakuliah' => 'required',
				'dospem' => 'required',
				'tanggal_awal' => 'required',
				'tanggal_akhir' => 'required'
			];
			if ($request->semester == 'lain') {
				$validateRules += [
					'semester_lain' => 'required',
				];
				$semester = $request->semester_lain;
			}else{
				$semester = $request->semester;
			}
			$remark = implode(';', array_filter([$request->nama_instansi, $request->alamat_instansi, $request->prodi, $semester, $request->tahun_akademik, $request->matakuliah, $request->dospem, $request->tanggal_awal, $request->tanggal_akhir]));
			$remark_1 = '';
			foreach ($request->nama as $key => $value) {
				$remark_1 .= $request->nama[$key].'-'.$request->nim[$key].';';
			}
		}
		$request->validate($validateRules);

		return ['remark'=>$remark,'remark_1'=>$remark_1];
	}
}
