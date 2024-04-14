<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanSempro extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pengajuanSemproMahasiswa(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'mahasiswa_id');
    }
    public function pengajuanSemproDospem(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'dospem_id');
    }
    public function pengajuanSemproPenguji1(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'penguji1_id');
    }
    public function pengajuanSemproPenguji2(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'penguji2_id');
    }
    public function pengajuanSemproPenguji3(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'penguji3_id');
    }
}
