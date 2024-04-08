<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dosen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['role' => 'array'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function bimbingans(): HasMany
    {
        return $this->hasMany(Bimbingan::class);
    }
}
