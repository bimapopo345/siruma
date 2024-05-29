<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProfilDesa;

class Village extends Model
{
    // use HasFactory;
	protected $table="indonesia_villages";
	protected $primaryKey="id";

	public static function getDesa()
	{
		$data=ProfilDesa::first();
		// ->where('profil_desa.kode_desa',session('kodeakses'))
		return $data;
	}
}
