<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bimbinganMahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
    public function bimbinganDosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
    public function bimbinganDosen2()
    {
        return $this->belongsTo(User::class, 'dosen2_id');
    }
    public function logbook()
    {
        return $this->hasMany(Logbook::class);
    }
}
