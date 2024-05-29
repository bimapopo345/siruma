<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Surat;
use App\Models\Pengajuan;
use App\Models\ProfilDesa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KepalaDesaController extends Controller
{
	public function dashboard_kepaladesa()
	{
		$data=Surat::all();
		return view('page/kepaladesa/home/home',compact('data'));
	}
	public function kepaladesa_acc($id_surat,$surat)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')
		->where('surat.id_surat',$id_surat)
		->where('surat.singkatan',$surat)
		->where('pengajuan.selesai','=','Sudah di Konfirmasi')->get();
		return view('page/kepaladesa/acc/acc',compact('data'));
	}
	public function ttd($surat,$id_pengajuan)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->join('template','template.id_template','=','surat.template_id')->where('surat.singkatan',$surat)->where('pengajuan.id_pengajuan',$id_pengajuan)
		->get();
		$desa=ProfilDesa::HeaderProfilDesa();
		$kades = User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.level','Dekan')
		->limit('1')
		->get();
		return view('page/kepaladesa/acc/ttd',compact('data','desa','kades'));
	}
	public function ttd_upload(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'ttd' => 'required'
		];
		$validateMessage += [
			'ttd.required' => 'Tanda Tangan harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);

		try {
			DB::beginTransaction();

			$pengajuan = Pengajuan::where('id_pengajuan',$request->id_pengajuan)->first();
			$tempat = public_path($pengajuan->ttd);
			File::delete($tempat);

			$folderPath= public_path();
			$image_parts=explode(";base64,", $request->ttd);
			$image_type_aux=explode("image/", $image_parts[0]);
			$image_type=$image_type_aux[1];
			$image_base64=base64_decode($image_parts[1]);
			$file=$folderPath.uniqid().'.'.$image_type;
			$name=uniqid().'.'.$image_type;
			file_put_contents($name, $image_base64);
			$pengajuan -> ttd = $name;
			$pengajuan -> save();
			DB::commit();
			return response()->json(['status'=>'true','message'=>'Tanda Tangan berhasil digunakan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function confirm_ttd(Request $request,$id_pengajuan)
	{
		try {
			DB::beginTransaction();
			DB::table('pengajuan')->where('id_pengajuan',$id_pengajuan)->update([
				'id_dekan'=>Auth::user()->id,
				'selesai'=>'Surat Selesai'
			]);
			DB::commit();
			return redirect(route('kepaladesa_acc',['id_surat'=>$request->id_surat,'surat'=>$request->singkatan]))->with('up','Surat Selesai dikonfirmasi !!');
		} catch (\Exception $e) {
			DB::rollBack();
		}
	}
	// public function form_ttd($id_pengajuan)
	// {
	// 	$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('pengajuan.id_pengajuan',$id_pengajuan)->where('pengajuan.desa_id',session('desaid'))->get();
	// 	$desa=User::join('biodata_desa','biodata_desa.user_id','=','users.id')->join('indonesia_provinces','indonesia_provinces.code','=','biodata_desa.province_codes')->join('indonesia_cities','indonesia_cities.code','=','biodata_desa.city_codes')->join('indonesia_districts','indonesia_districts.code','=','biodata_desa.district_codes')->join('indonesia_villages','indonesia_villages.code','=','biodata_desa.village_codes')->join('profil_desa','profil_desa.user_id','biodata_desa.user_id')->where('biodata_desa.user_id',session('desaid'))->get();
	// 	return view('page/kepaladesa/form_ttd',compact('data','desa'));
	// }
}
