<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = "pegawai";

    protected $fillable = [
        'NAMA_PEGAWAI',
        'ALAMAT_PEGAWAI',
        'EMAIL_PEGAWAI',
        'PASSWORD_PEGAWAI',
        'ROLE_PEGAWAI',
        'JENIS_KELAMIN_PEGAWAI',
        'UMUR_PEGAWAI'
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function getCreatedAtAttribute()
    {
        if (!is_null($this->attributes["created_at"])) {
            return Carbon::parse($this->attributes["created_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }
    public function getUpdatedAtAttribute()
    {
        if (!is_null($this->attributes["updated_at"])) {
            return Carbon::parse($this->attributes["updated_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }
}
