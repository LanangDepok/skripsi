<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logbook extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bimbingan(): BelongsTo
    {
        return $this->belongsTo(Bimbingan::class);
    }
}
