<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiInstruktur extends Model
{
    use HasFactory;

    protected $table = 'presensi_instruktur';
    protected $primaryKey = 'ID_PRESENSI_INSTRUKTUR';

    protected $fillable = [
        "ID_INSTRUKTUR",
        "TANGGAL_MENGAJAR",
        "WAKTU_TERLAMBAT",
        "JAM_MULAI",
        "JAM_SELESAI",
        "DURASI_KELAS"
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
        if (!is_null($this->attributes["update_at"])) {
            return Carbon::parse($this->attributes["update_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }
}
