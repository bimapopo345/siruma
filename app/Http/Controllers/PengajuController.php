<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Village;
use App\Models\District;
use App\Models\User;
use App\Models\Pengajuan;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
date_default_timezone_set('Asia/Jakarta');

class PengajuController extends Controller
{
	public function dashboard_pengaju()
	{
		// dd(session('desaid'));
		$surat = Surat::join('template','surat.template_id','=','template.id_template')
		// ->where('surat.template_id','!=',NULL)
		->orderBy('surat.id_surat','DESC')
		->get();
		return view('page/pengaju/home/home',compact('surat'));
	}
	public function request($id_surat, $surat)
	{
		$data=User::join('info_lengkap','info_lengkap.user_id','=','users.id')
		->where('users.id',Auth::user()->id)
		->get();
		// $profil=User::join('info_lengkap','info_lengkap.user_id','=','users.id')
		// ->where('info_lengkap.nik','!=',NULL)
		// ->where('users.id',Auth::user()->id)->first();
		$surat = Surat::join('template','template.id_template','=','surat.template_id')
		->where('surat.id_surat',$id_surat)
		->where('surat.nama_surat',$surat)
		->first();
		return view('page/pengaju/request/index',compact('data','surat'));
	}
	public function add_request(Request $request)
	{
		if (!empty($request->keperluan)) {
			$keperluan = $request->keperluan;
		}else{
			$keperluan = NULL;
		}

		$result = Pengajuan::validasiPengajuanRequest($request);
		$remark = $result['remark'];
		$remark_1 = $result['remark_1'];

		try {
			DB::beginTransaction();

			$pengajuan = New Pengajuan();
			$pengajuan -> user_id = Auth::user()->id;
			$pengajuan -> surat_id = $request -> id_surat;
			$pengajuan -> status_pengajuan = 'Pengecekan Permohonan';
			$pengajuan -> tgl_req = date('Y-m-d');
			$pengajuan -> keperluan = $keperluan;
			$pengajuan -> remark = $remark;
			$pengajuan -> remark_1 = $remark_1;
			$pengajuan -> save();

			if (!empty($request->hasFile('foto_ktm'))) {
				$foto_ktm = $request->file('foto_ktm');
				$nama_file = $foto_ktm->getClientOriginalName();
				$file_foto = uniqid();
				$file_foto .= $nama_file;
				$foto_ktm->move(\base_path()."/public/pengajuan_berkas", $file_foto);
			}

			$files = $request->file('berkas');
			$foto = $files->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $foto;
			DB::table('berkas_pengajuan')->insert([
				'pengajuan_id'=>$pengajuan->id_pengajuan,
				'data_berkas'=>$namaFileBaru,
				'path'=>$files->move(\base_path()."/public/pengajuan_berkas",$namaFileBaru),
			]);
			$redirect = route('data_request',['id_surat'=>$request->id_surat,'singkatan'=>$request->singkatan]);
			DB::commit();
			return response()->json([
				'status'=>'true',
				'message'=>'Pengajuan Surat berhasil, Tunggu Konfirmasi dari Staff !!',
				'redirect'=>$redirect
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function data_request($id_surat,$singkatan)
	{
		// $data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.desa_id','=','info_lengkap.desa_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('pengajuan.user_id',Auth::user()->id)->where('surat.singkatan',$singkatan)->where('pengajuan.desa_id',session('desaid'))->where('users.level','Pengaju')->get();
		$data=DB::table('pengajuan')->join('users','users.id','=','pengajuan.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')
		->where('surat.id_surat',$id_surat)
		->where('surat.singkatan',$singkatan)
		->join('info_lengkap','info_lengkap.user_id','=','users.id')
		->where('users.id',Auth::user()->id)
		->where('users.level','Pengaju')
		->orderBy('pengajuan.id_pengajuan','DESC')
		->get();
		$pelengkap=DB::table('berkas_pengajuan')->get();
		return view('page/pengaju.data.data',compact('data','pelengkap','singkatan'));
	}
	public function profil_pengaju()
	{
		$data = User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.id',Auth::user()->id)->get();
		return view('page/pengaju/profil/profil',compact('data'));
	}
	public function update_profil_pengurus(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];
		$validateRules += [
			'name' => 'required',
			'email' => 'required',
			'nik' => 'required',
			'alamat' => 'required',
			'agama' => 'required',
			'telepon' => 'required',
			'jenis_kelamin' => 'required',
			'tempat' => 'required',
			'tgl_lahir' => 'required'
		];
		$validateMessage += [
			'name.required' => 'Nama harus diisi.',
			'email.required' => 'Email harus diisi.',
			'nik.required' => 'NIK harus diisi.',
			'alamat.required' => 'Alamat harus diisi.',
			'agama.required' => 'Agama harus diisi.',
			'telepon.required' => 'Telepon harus diisi.',
			'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
			'tempat.required' => 'Tempat Lahir harus diisi.',
			'tgl_lahir.required' => 'Tanggal lahir harus diisi.'
		];
		if (Auth::user()->level == 'Pengaju') {
			$validateRules += [
				'pekerjaan' => 'required'
			];
			$validateMessage += [
				'pekerjaan.required' => 'Pekerjaan harus diisi.'
			];
		}
		$user = User::where('id',Auth::user()->id)->first();
		if ($user->email != $request->email) {
			$request->validate([
				'email' => 'unique:users,email'
			],[
				'email.unique' => 'Email yang anda gunakan sudah terdaftar.',
			]);
		}
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			if ($request->hasFile('foto')) {
				$ambil=$request->file('foto');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/profil", $namaFileBaru);
			}else{
				$namaFileBaru = $request->fotoLama;
			}
			$user -> name = $request->name;
			$user -> email = $request->email;
			$user -> save();
			DB::table('info_lengkap')->where('user_id',Auth::user()->id)->update([
				'nik'=>$request->nik,
				'alamat'=>$request->alamat,
				'agama'=>$request->agama,
				'telepon'=>$request->telepon,
				'pekerjaan'=>$request->pekerjaan,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'tempat'=>$request->tempat,
				'tgl_lahir'=>$request->tgl_lahir,
				'foto_profil'=>$namaFileBaru,
			]); 
			DB::commit();
			return response()->json(['status'=>'true','message'=>'Profil berhasil diperbarui !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}