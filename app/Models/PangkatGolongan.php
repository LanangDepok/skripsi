<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PangkatGolongan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dosen(): HasMany
    {
        return $this->hasMany(Dosen::class, 'gol_pangkat_id');
    }
}
