<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;


class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'member';
    protected $primaryKey = 'ID_MEMBER';
    protected $keyType = 'string';
    protected $guard = "member";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];
    protected $fillable = [
        "NAMA_MEMBER",
        "ALAMAT_MEMBER",
        "TELEPON_MEMBER",
        "JENIS_KELAMIN_MEMBER",
        "MASA_AKTIVASI",
        "SISA_DEPOSIT_KELAS",
        "SISA_DEPOSIT_UANG",
        "TANGGAL_LAHIR_MEMBER",
        "EMAIL",
        "password",
        "MASA_EXPIRED_KELAS",
        "TANGGAL_NONAKTIF",
        "TANGGAL_RESET_KELAS"
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
