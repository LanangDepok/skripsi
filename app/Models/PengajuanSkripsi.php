<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanSkripsi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pengajuanSkripsiMahasiswa(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'mahasiswa_id');
    }
    public function pengajuanSkripsiDospem(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'dospem_id');
    }
    public function pengajuanSkripsiPenguji1(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'penguji1_id');
    }
    public function pengajuanSkripsiPenguji2(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'penguji2_id');
    }
    public function pengajuanSkripsiPenguji3(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'penguji3_id');
    }
    public function pengajuanRevisi()
    {
        return $this->hasOne(PengajuanRevisi::class, 'pengajuan_skripsi_id', 'id');
    }
}
