<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = "pegawai";
    protected $primaryKey = "ID_PEGAWAI";
    protected $table = "pegawai";


    protected $fillable = [
        'NAMA_PEGAWAI',
        'ALAMAT_PEGAWAI',
        'EMAIL_PEGAWAI',
        'password',
        'ROLE_PEGAWAI',
        'JENIS_KELAMIN_PEGAWAI',
        'UMUR_PEGAWAI'
    ];
    
    // protected $hidden = [
    //     'remember_token',
    // ];

    public function getCreatedAtAttribute() {
        if(!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdateAtAtrribute() {
        if(!is_null($this->attributes['updated_at'])) {
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
