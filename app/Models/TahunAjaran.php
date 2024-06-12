<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class, 'tahun_ajaran_id');
    }
}
