<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo';
    protected $primaryKey = 'ID_PROMO';

    protected $fillable = [
        "NAMA_PROMO",
        "TANGGAL_MULAI_PROMO",
        "TANGGAL_AKHIR_PROMO",
        "JENIS_PROMO",
        "SYARAT_PROMO",
        "MINIMAL_PEMBELIAN",
        "BONUS"
    ];
}
