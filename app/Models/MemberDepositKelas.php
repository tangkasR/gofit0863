<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MemberDepositKelas extends Model
{
    use HasFactory;

    protected $table = 'member_deposit_kelas';
    protected $primaryKey = 'ID';
    protected $guard = 'member_deposit_kelas';


    protected $fillable = [
        "ID_MEMBER",
        "ID_KELAS",
        "SISA_DEPOSIT_KELAS",
        "MASA_BERLAKU",
        "MASA_EXPIRED_RESET"
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

    public function member()
    {
        return $this->belongsTo('App\Models\Member','ID_MEMBER');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas','ID_KELAS');
    }
}
