<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Village;
use App\Models\District;
use App\Models\User;
use App\Models\Surat;
use App\Models\Layanan;
use App\Models\Prosedur;
use App\Models\ProfilDesa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use DataTables;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    public function dashboard()
    {
        $pengaju = User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('users.level','Pengaju')->count();
        $pengurus = User::join('info_lengkap','info_lengkap.user_id','=','users.id')
        ->where('users.level','!=','Pengaju')
        ->where('users.level','!=','Admin')
        ->count();
        $surat = Surat::count();
        $layanan = Layanan::count();
        $prosedur = Prosedur::count();
        return view('page/desa/dashboard/dashboard',compact('pengaju','pengurus','surat','layanan','prosedur'));
    }
    // public function user_pengaju()
    // {
    //     $data=User::join('info_lengkap','info_lengkap.user_id','=','users.id')->where('info_lengkap.desa_id',Auth::user()->id)->where('users.level','Pengaju')->get();
    //     return view('page/desa/user/pengaju',compact('data'));
    // }
    public function data_user(Request $request, $level)
    {
        if ($level == 'Pengaju') {
            $level = 'Pengaju';
        }else{
            $level = 'Pengurus';
        }
        if ($request->ajax()) {
            $data = User::join('info_lengkap','info_lengkap.user_id','=','users.id');
            if ($level == 'Pengaju') {
                $data->where('users.level','Pengaju');
            }else{
                $data->where('users.level','!=','Pengaju')->where('users.level','!=','Admin');
            }
            $data = $data->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('', function($data) {
                $a = '';
                return $a;
            })
            ->addColumn('action', function($data) {
                $button = '<a href="javascript:void(0)" more_id="'.$data->id.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
                $button .= '<a href="'.route('cek_user',$data->id).'" more_id="'.$data->id.'" class="btn view btn-primary text-white rounded-pill btn-sm"><i class="fa fa-eye"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('page/desa/user/index',compact('level'));
    }
    public function get_edit_user($id)
    {
        $data = User::join('info_lengkap','info_lengkap.user_id','=','users.id')
        ->where('users.id',$id)
        ->get();
        return response()->json($data);
    }
    public function cek_user($id)
    {
        $data=User::join('info_lengkap','info_lengkap.user_id','=','users.id')
        ->where('users.id',$id)
        ->get();
        return view('page/desa/user/detail',compact('data'));
    }
    public function data_surat(Request $request)
    {
        if ($request->ajax()) {
            $data = Surat::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('', function($data) {
                $a = '';
                return $a;
            })
            ->addColumn('action', function($data) {
                $button = '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
                $button .= '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
                $button .= '<a href="'.route('template',['id_surat'=>$data->id_surat]).'" class="btn btn-sm rounded-pill btn-primary"><i class="bx bx-cabinet"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('page/desa/surat/surat');
    }
    public function tambah_surat(Request $request)
    {
        $validateRules = [];
        $validateMessage = [];

        $validateRules += [
            'nama_surat' => 'required',
            'bg' => 'required',
            'persyaratan' => 'required'
        ];
        $validateMessage += [
            'nama_surat.required' => 'Nama Surat harus dipilih.',
            'bg.required' => 'Background Surat harus dipilih.',
            'persyaratan.required' => 'Persyaratan harus diisi.'
        ];
        $request->validate($validateRules, $validateMessage);

        try {
            DB::beginTransaction();
            $string = $request->nama_surat;
            $arr = explode(' ', $string);
            $singkatan = '';
            foreach($arr as $kata)
            {
                $singkatan .= substr($kata, 0, 1);
            }
            $singkatan_template = str_replace(' ', '_', strtoupper($request->nama_surat));

            $surat = new Surat();
            $surat -> nama_surat = $request -> nama_surat;
            $surat -> singkatan = $singkatan;
            $surat -> singkatan_template = $singkatan_template;
            $surat -> bg = $request -> bg;
            $surat -> persyaratan = $request -> persyaratan;
            $surat -> save();
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Data Surat berhasil ditambahkan !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
        return ;
    }
    public function get_edit_surat($id_surat)
    {
        $data = Surat::where('id_surat',$id_surat)
        ->get();
        return response()->json($data);
    }
    public function edit_surat(Request $request)
    {
        $validateRules = [];
        $validateMessage = [];

        $validateRules += [
            'nama_surat' => 'required',
            'bg' => 'required',
            'persyaratan' => 'required'
        ];
        $validateMessage += [
            'nama_surat.required' => 'Nama Surat harus dipilih.',
            'bg.required' => 'Background Surat harus dipilih.',
            'persyaratan.required' => 'Persyaratan harus diisi.'
        ];
        $request->validate($validateRules, $validateMessage);

        try {
            DB::beginTransaction();
            $string = $request->nama_surat;
            $arr = explode(' ', $string);
            $singkatan = '';
            foreach($arr as $kata)
            {
                $singkatan .= substr($kata, 0, 1);
            }
            $singkatan_template = str_replace(' ', '_', strtoupper($request->nama_surat));
            Surat::where('id_surat',$request->id_surat)->update([
                'nama_surat'=>$request->nama_surat,
                'singkatan'=>$singkatan,
                'singkatan_template'=>$singkatan_template,
                'bg'=>$request->bg,
                'persyaratan'=>$request->persyaratan,
            ]);
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Data Surat berhasil diubah !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
    }
    public function hapus_surat($id_surat)
    {
        try {
            DB::beginTransaction();
            Surat::where('id_surat',$id_surat)->delete();
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Data Surat berhasil dihapus !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
    }
    public function waktu_layanan(Request $request)
    {
        if ($request->ajax()) {
            $data=Layanan::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('', function($data) {
                $a = '';
                return $a;
            })
            ->addColumn('action', function($data) {
                $button = '<a href="javascript:void(0)" more_id="'.$data->id_layanan.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
                $button .= '<a href="javascript:void(0)" more_id="'.$data->id_layanan.'" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('page/desa/layanan/layanan');
    }
    public function tambah_layanan(Request $request)
    {
        $validateRules = [];
        $validateMessage = [];

        $validateRules += [
            'hari' => 'required',
            'waktu' => 'required',
            'sampai' => 'required'
        ];
        $validateMessage += [
            'hari.required' => 'Hari harus dipilih.',
            'waktu.required' => 'Waktu Awal Surat harus dipilih.',
            'sampai.required' => 'Waktu Akhir harus diisi.'
        ];
        $request->validate($validateRules, $validateMessage);

        try {
            DB::beginTransaction();
            $layanan = new Layanan();
            $layanan -> hari = $request -> hari;
            $layanan -> waktu = $request -> waktu;
            $layanan -> sampai = $request -> sampai;
            $layanan -> save();
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Data Layanan berhasil ditambahkan !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
    }
    public function get_edit_layanan($id_layanan)
    {
        $data = Layanan::where('id_layanan',$id_layanan)->get();
        return response()->json($data);
    }
    public function edit_layanan(Request $request)
    {
        $validateRules = [];
        $validateMessage = [];

        $validateRules += [
            'hari' => 'required',
            'waktu' => 'required',
            'sampai' => 'required'
        ];
        $validateMessage += [
            'hari.required' => 'Hari harus dipilih.',
            'waktu.required' => 'Waktu Awal Surat harus dipilih.',
            'sampai.required' => 'Waktu Akhir harus diisi.'
        ];
        $request->validate($validateRules, $validateMessage);

        try {
            DB::beginTransaction();
            Layanan::where('id_layanan',$request->id_layanan)->update([
                'hari'=>$request->hari,
                'waktu'=>$request->waktu,
                'sampai'=>$request->sampai
            ]);
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Data Layanan berhasil diubah !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
    }
    public function hapus_layanan($id_layanan)
    {
        try {
            DB::beginTransaction();
            Layanan::where('id_layanan',$id_layanan)->delete();
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Data Layanan berhasil dihapus !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
    }
    public function prosedur()
    {
        $data = Prosedur::all();
        return view('page/desa/prosedur/prosedur',compact('data'));
    }
    public function tambah_prosedur(Request $request)
    {
        $prosedur = new Prosedur();
        $prosedur -> prosedur = $request->prosedur;
        $prosedur -> save();
        return redirect()->back()->with('add','Prosedur berhasil ditambahkan !!');
    }
    public function edit_prosedur(Request $request,$id_prosedur)
    {
        Prosedur::where('id_prosedur',$id_prosedur)->update([
            'prosedur'=>$request->prosedur,
        ]);
        return redirect()->back()->with('up','-');
    }
    public function hapus_prosedur($id_prosedur)
    {
        Prosedur::where('id_prosedur',$id_prosedur)->delete();
        return redirect()->back()->with('del','-');
    }
    public function profil_desa()
    {
        $data = ProfilDesa::HeaderProfilDesa();
        return view('page/desa/profildesa/profil',compact('data'));
    }
    public function lengkapi(Request $request)
    {
        $validateRules = [];
        $validateMessage = [];
        $validateRules += [
            'nama_profil' => 'required',
            'email_desa' => 'required',
            'telepon_desa' => 'required',
            'lokasi_desa' => 'required'
        ];
        $validateMessage += [
            'nama_profil.required' => 'Nama harus diisi.',
            'email_desa.required' => 'Email harus diisi.',
            'telepon_desa.required' => 'Telepon harus diisi.',
            'lokasi_desa.required' => 'Alamat harus diisi.'
        ];

        // $user = ProfilDesa::where('',Auth::user()->id)->first();
        // if ($user->email != $request->email) {
        //     $request->validate([
        //         'email_desa' => 'unique:users,email'
        //     ],[
        //         'email_desa.unique' => 'Email yang anda gunakan sudah terdaftar.',
        //     ]);
        // }
        $request->validate($validateRules, $validateMessage);

        try {
            DB::beginTransaction();
            if ($request->hasFile('foto')) {
                $ambil = $request->file('foto');
                $name = $ambil->getClientOriginalName();
                $namaFileBaru = uniqid();
                $namaFileBaru .= $name;
                $ambil->move(\base_path()."/public/foto", $namaFileBaru);
            }else{
                $namaFileBaru = $request->fotoLama;
            }
            ProfilDesa::where('id_profil',$request->id_profil)->update([
                'nama_profil'=>$request->nama_profil,
                'lokasi_desa'=>$request->lokasi_desa,
                'telepon_desa'=>$request->telepon_desa,
                'email_desa'=>$request->email_desa,
                'logo'=>$namaFileBaru
            ]);
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Profil berhasil diubah !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }

        return redirect()->back()->with('up','-');
    }
    public function ganti_password(Request $request,$id)
    {
        DB::table('users')->where('id',$id)->update([
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->back()->with('up','-');
    }
    public function tambah_pengurus(Request $request)
    {
        $validateRules = [];
        $validateMessage = [];

        $validateRules += [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email',
            'nik' => 'required',
            'password' => 'required',
            'agama' => 'required',
            'tempat' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required',
            'alamat' => 'required'
        ];
        $validateMessage += [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email yang digunakan sudah terdaftar.',
            'nik.required' => 'NIK harus diisi.',
            'agama.required' => 'Role harus diisi.',
            'tempat.required' => 'Tempat Lahir harus diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
            'password.required' => 'Password harus diisi.',
            'telepon.required' => 'Telepon harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
        ];
        if ($request->role == 'Pengaju') {
            $validateRules += [
                'pekerjaan' => 'required'
            ];
            $validateMessage += [
                'pekerjaan.required' => 'Pekerjaan harus diisi.',
            ];
        }else{
            $validateRules += [
                'level' => 'required'
            ];
            $validateMessage += [
                'level.required' => 'Role harus diisi.',
            ];
        }
        $request->validate($validateRules, $validateMessage);

        try {
            DB::beginTransaction();
            if ($request->file('foto')) {
                $ambil=$request->file('foto');
                $name=$ambil->getClientOriginalName();
                $namaFileBaru = uniqid();
                $namaFileBaru .= $name;
                $ambil->move(\base_path()."/public/profil", $namaFileBaru);
            }else{
                $namaFileBaru = NULL;
            }
            if (empty($request->pekerjaan)) {
                $pekerjaan = NULL;
            }else{
                $pekerjaan = $request->pekerjaan;
            }
            if (empty($request->level)) {
                $level = NULL;
            }else{
                $level = $request->level;
            }

            $user = new User();
            $user -> name = $request -> name;
            $user -> email = $request -> email;
            $user -> password = hash::make($request -> password);
            if ($request->role == 'Pengaju') {
                $user -> level = 'Pengaju';
            }else{
                $user -> level = $level;
            }
            $user -> status_user = 'True';
            $user->save();
            DB::table('info_lengkap')->insert([
                'user_id'=>$user->id,
                'nik'=>$request->nik,
                'alamat'=>$request->alamat,
                'agama'=>$request->agama,
                'telepon'=>$request->telepon,
                'pekerjaan'=>$pekerjaan,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'tempat'=>$request->tempat,
                'tgl_lahir'=>$request->tgl_lahir,
                'foto_profil'=>$namaFileBaru,
            ]); 
            DB::commit();
            return response()->json(['status'=>'true','message'=>'Data User berhasil ditambahkan !!']);
        } catch (\Exception $e) {
           DB::rollBack();
           Log::error($e);
           return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
       }
   }
   public function update_pengurus(Request $request)
   {
    $validateRules = [];
    $validateMessage = [];

    $validateRules += [
        'name' => 'required',
        'email' => 'required',
        'nik' => 'required',
        'agama' => 'required',
        'tempat' => 'required',
        'tgl_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'telepon' => 'required',
        'alamat' => 'required'
    ];
    $validateMessage += [
        'name.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'nik.required' => 'NIK harus diisi.',
        'agama.required' => 'Role harus diisi.',
        'tempat.required' => 'Tempat Lahir harus diisi.',
        'tgl_lahir.required' => 'Tanggal Lahir harus diisi.',
        'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
        'telepon.required' => 'Telepon harus diisi.',
        'alamat.required' => 'Alamat harus diisi.',
    ];
    if ($request->role == 'Pengaju') {
        $validateRules += [
            'pekerjaan' => 'required'
        ];
        $validateMessage += [
            'pekerjaan.required' => 'Pekerjaan harus diisi.',
        ];
    }else{
        $validateRules += [
            'level' => 'required'
        ];
        $validateMessage += [
            'level.required' => 'Role harus diisi.',
        ];
    }
    $user_cek = User::where('id',$request->id)->first();
    if ($user_cek->email != $request->email) {
        $request->validate([
            'email' => 'unique:users,email'
        ],[
            'email.unique' => 'Email yang anda gunakan sudah terdaftar.',
        ]);
    }
    $request->validate($validateRules, $validateMessage);

    try {
        DB::beginTransaction();
        if ($request->file('foto')) {
            $ambil=$request->file('foto');
            $name=$ambil->getClientOriginalName();
            $namaFileBaru = uniqid();
            $namaFileBaru .= $name;
            $ambil->move(\base_path()."/public/profil", $namaFileBaru);
        }else{
            $namaFileBaru = $request->fotoLama;
        }
        if (empty($request->pekerjaan)) {
            $pekerjaan = NULL;
        }else{
            $pekerjaan = $request->pekerjaan;
        }
        if (empty($request->level)) {
            $level = NULL;
        }else{
            $level = $request->level;
        }

        $user = User::where('id',$request->id)->first();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        if ($request->password != '') {
            $user -> password = hash::make($request -> password);
        }
        if ($request->role == 'Pengaju') {
            $user -> level = 'Pengaju';
        }else{
            $user -> level = $level;
        }
        $user->save();
        DB::table('info_lengkap')->where('user_id',$request->id)->update([
            'nik'=>$request->nik,
            'alamat'=>$request->alamat,
            'agama'=>$request->agama,
            'telepon'=>$request->telepon,
            'pekerjaan'=>$pekerjaan,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tempat'=>$request->tempat,
            'tgl_lahir'=>$request->tgl_lahir,
            'foto_profil'=>$namaFileBaru
        ]); 
        DB::commit();
        return response()->json(['status'=>'true','message'=>'Data User berhasil diubah !!']);
    } catch (\Exception $e) {
       DB::rollBack();
       Log::error($e);
       return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
   }
}

public function template($id_surat)
{
    $data = DB::table('template')->where('status_template','Active')->orderBy('urutan_template','ASC')->get();
    $surat = Surat::where('id_surat',$id_surat)->get();
    return view('page/desa/template/pilih',compact('data','surat'));
}
public function custom_template(Request $request,$template_id)
{
    DB::table('surat')->where('id_surat',$request->id_surat)->update([
        'template_id'=>$template_id
    ]);
    return redirect(route('data_surat'))->with('up','-');
}
}
