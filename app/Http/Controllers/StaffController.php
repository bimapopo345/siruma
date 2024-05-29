<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Surat;
use App\Models\ProfilDesa;
use App\Models\Pengajuan;
use App\Models\Village;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use PDF;

class StaffController extends Controller
{
	public function dashboard_staff()
	{
		$data=Surat::all();
		return view('page/staff/home/home',compact('data'));
	}
	public function staff_acc($id_surat, $surat)
	{
		$data = User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')
		->where('surat.id_surat',$id_surat)
		->where('surat.singkatan',$surat)
		->where('pengajuan.selesai','=',NULL)
		->orderBy('pengajuan.id_pengajuan','DESC')
		->get();
		return view('page/staff/acc/acc',compact('data','surat'));
	}
	public function staff_cek_berkas($surat,$id_pengajuan)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')
		->where('surat.singkatan',$surat)
		->where('pengajuan.id_pengajuan',$id_pengajuan)
		->where('pengajuan.selesai','=',NULL)->get();
		$berkas=DB::table('berkas_pengajuan')->join('pengajuan','pengajuan.id_pengajuan','=','berkas_pengajuan.pengajuan_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')
		->where('surat.singkatan',$surat)
		->where('pengajuan.id_pengajuan',$id_pengajuan)
		->where('pengajuan.selesai','=',NULL)->get();
		return view('page/staff/acc/cek',compact('data','berkas'));
	}
	public function keterangan(Request $request,$id_pengajuan)
	{
		try {
			DB::beginTransaction();
			DB::table('pengajuan')->where('id_pengajuan',$id_pengajuan)->update([
				'status_pengajuan'=>$request->keterangan
			]);
			DB::commit();
			return redirect(route('staff_acc',['id_surat'=>$request->id_surat,'surat'=>$request->singkatan]))->with('up','-');
		} catch (\Exception $e) {
			DB::rollBack();
		}
	}
	public function konfirmasi(Request $request, $singkatan,$id_pengajuan)
	{
		try {
			DB::beginTransaction();
			// $last_kode_penjualan = Pengajuan::where('surat_id',$request->id_surat)
			// ->max('nomor_surat');
			// $no_urut = substr($last_kode_penjualan, -2);
			// $no_urut++;
			// $kode = sprintf("%04s", abs($no_urut));
			// $new_kode_penjualan = $singkatan.'/'.$kode.'/'.date('Y').'/'.date('m');
			DB::table('pengajuan')->where('id_pengajuan',$id_pengajuan)->update([
				'selesai'=>'Sudah di Konfirmasi',
				'status_pengajuan'=>'Data Sudah Lengkap',
				'nomor_surat'=>$request->nomor_surat,
				'tanggal_surat'=>date('Y-m-d')
			]);
			DB::commit();
			return redirect(route('staff_acc',['id_surat'=>$request->id_surat,'surat'=>$singkatan]))->with('up','Surat berhasil di ACC');
		} catch (\Exception $e) {
			DB::rollBack();
		}		
	}
	public function staff_cetak($id_surat, $surat)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')
		->where('surat.id_surat',$id_surat)
		->where('surat.singkatan',$surat)
		->where('pengajuan.selesai','=','Surat Selesai')->get();
		return view('page/staff/cetak/cetak',compact('data','surat'));
	}
	public function cetak($surat,$id_pengajuan)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->join('template','template.id_template','=','surat.template_id')->where('surat.singkatan',$surat)->where('pengajuan.id_pengajuan',$id_pengajuan)
		->get();
		$desa = ProfilDesa::HeaderProfilDesa();
		$kepala = User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.level','Dekan')
		->limit('1')->get();
		$kades = User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.level','Dekan')->limit('1')->get();
		return view('page/staff/cetak/cek',compact('data','desa','kepala','kades'));
	}
	public function cetak_surat($surat,$id_pengajuan)
	{
		if (Auth::user()->level=="Staff") {
			$data = User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->join('template','template.id_template','=','surat.template_id')->where('surat.singkatan',$surat)->where('pengajuan.id_pengajuan',$id_pengajuan)->get();
			$desa = ProfilDesa::HeaderProfilDesa();
			$kepala=User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.level','Dekan')->limit('1')->get();
		}elseif (AUth::user()->level=="Pengaju") {
			$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->join('template','template.id_template','=','surat.template_id')->where('surat.singkatan',$surat)->where('pengajuan.id_pengajuan',$id_pengajuan)->where('pengajuan.user_id',Auth::user()->id)->get();
			$desa = ProfilDesa::HeaderProfilDesa();
			$kepala=User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.level','Dekan')->limit('1')->get();
		}
		$pdf=PDF::loadview('page/staff/cetak/pdf',compact('data','desa','kepala'));
		foreach ($data as $dt) {
			if ($dt->level=="Pengaju") {
				return $pdf->stream();
			}
		}
	}
	public function surat_selesai()
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('pengajuan.selesai','=','Surat Selesai')->get();
		return view('page/staff/selesai/index',compact('data'));
	}
	public function laporan(Request $request)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('pengajuan.selesai','=','Surat Selesai')->whereBetween('pengajuan.tgl_req',[$request->awal,$request->akhir])->get();
		return view('page/staff/selesai/laporan',compact('data'));
	}
	public function print($awal,$akhir)
	{
		$data=User::join('info_lengkap','users.id','=','info_lengkap.user_id')->join('pengajuan','pengajuan.user_id','=','info_lengkap.user_id')->join('surat','surat.id_surat','=','pengajuan.surat_id')->where('pengajuan.selesai','=','Surat Selesai')->whereBetween('pengajuan.tgl_req',[$awal,$akhir])->get();
		$desa=Village::getDesa();
		$pdf=PDF::loadview('page/staff/selesai/print',compact('data','desa'))->setPaper('A4','landscape');
		// return view('page/staff/cetak/pdf',compact('data','desa','kepala'));
		return $pdf->stream();
	}
}
