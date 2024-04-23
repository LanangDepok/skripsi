<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanRevisi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pengajuanSkripsi()
    {
        return $this->belongsTo(PengajuanSkripsi::class, 'pengajuan_skripsi_id', 'id');
    }
}
