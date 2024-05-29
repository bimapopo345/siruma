<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    // use HasFactory;
        // use HasFactory;
    protected $table="profil_desa";
    protected $primaryKey="id_profil";

    public static function HeaderProfilDesa()
    {
    	$data = ProfilDesa::all();
    	return $data;
    }
}
