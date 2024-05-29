<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Village;
use App\Models\District;
use App\Models\User;
use App\Models\Surat;
use App\Models\ProfilDesa;
use App\Models\BiodataDesa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Log;
use Exception;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data=ProfilDesa::HeaderProfilDesa();
        return view('home.home.home',compact('data'));
    }
    public function daftar(Request $request)
    {
        try {
            DB::begintransaction();
            $users = new User();
            if (User::where('email', $request->email)->first()) {
                return response()->json(['status'=>'warning','message'=>'Email sudah terdaftar.']);
            }elseif ($request->confirm != $request->password) {
                return response()->json(['status'=>'warning','message'=>'Konfirmasi Password tidak sesuai.']);
            }else{
                $users -> email = $request -> email;
                $users -> name = $request -> name;
                $users -> password = Hash::make($request -> password);
                $users -> level = 'Pengaju';
                $users -> status_user = 'True';
                $users -> save();
                DB::table('info_lengkap')->insert([
                    'user_id'=>$users->id
                ]);
            }
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Pendaftaran Akun berhasil, silahkan Login !!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>'false','message'=>'Permintaan data tidak dikirim !!']);
        }
    }
    public function login()
    {
        $data = ProfilDesa::HeaderProfilDesa();
        return view('page.desa.login',compact('data'));
    }
    public function ceklogin(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            if (Auth::user()->level == "Admin") {
                $url = route('dashboard');
            }elseif(Auth::user()->level == "Pengaju"){
                $url = route('dashboard_pengaju');
            }elseif(Auth::user()->level=="Staff"){
                $url = route('dashboard_staff');
            }else{
                $url = route('dashboard_kepaladesa');
            }
            return response()->json([
                'success' => '-',
                'url'=>$url
            ]);
        }else{
            return response()->json([
                'notmasuk' => '-'
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function proses_forgot(Request $request)
    {
        try {
            DB::beginTransaction();
            $data=User::join('info_lengkap','info_lengkap.user_id','=','users.id')
            ->where('users.email',$request->email)
            ->where('users.status_user','True')
            ->first();
            if ($data) {
                $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $shuffle  = substr(str_shuffle($karakter), 0, 8);
                $kode=$shuffle.$data->id;
                DB::table('users')->where('id',$data->id)->update([
                    'password'=>hash::make($kode)
                ]);
                $details = [
                    'status'=>'Lupa Password',
                // 'subject'=>'Lupa Password',
                    'password'=>$kode,
                    'name'=>$data->name
                ];
                \Mail::to($data->email)->send(new \App\Mail\SendMail($details));
            }else{
                return response()->json(['status'=>'warning','message'=>'Email tidak ditemukan.']);
            }
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Lupa Password berhasil, password baru telah terkirim di email Anda !!']);
        } catch (Exception $e) {
            DB::rollBack();
        }

    }

    public function cek_verifikasi(Request $request)
    {
        $data=DB::table('users')->where('verifikasi',$request->token)->first();
        if ($data == null) {
            return redirect()->back()->with('tokensalah','-');
        }else{
            $request->session()->forget('kodeverif');
            $request->session()->put('pss',$data->id);
            return redirect()->back()->with('tokenbenar','-');
        }
    }
    public function ubah_password(Request $request,$title)
    {
        User::where('id',session('pss'))->update([
            'password'=>hash::make($request->password),
        ]);
        User::where('id',session('pss'))->update([
            'verifikasi'=>'',
        ]);
        $request->session()->forget('pss');
        return redirect(route('login',$title));
    }
}