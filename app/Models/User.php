<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class);
    }
    public function dosen(): HasOne
    {
        return $this->hasOne(Dosen::class);
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
    public function skripsi(): HasOne
    {
        return $this->hasOne(Skripsi::class);
    }
    public function pengajuanJudul(): HasMany
    {
        return $this->hasMany(pengajuanJudul::class);
    }
    public function pengajuanSemproMahasiswa(): HasMany
    {
        return $this->hasMany(PengajuanSempro::class, 'mahasiswa_id');
    }
    public function pengajuanSemproDospem(): HasMany
    {
        return $this->hasMany(PengajuanSempro::class, 'dospem_id');
    }
    public function pengajuanSemproPenguji1(): HasMany
    {
        return $this->hasMany(PengajuanSempro::class, 'penguji1_id');
    }
    public function pengajuanSemproPenguji2(): HasMany
    {
        return $this->hasMany(PengajuanSempro::class, 'penguji2_id');
    }
    public function pengajuanSemproPenguji3(): HasMany
    {
        return $this->hasMany(PengajuanSempro::class, 'penguji3_id');
    }
    public function bimbinganMahasiswa(): HasOne
    {
        return $this->hasOne(Bimbingan::class, 'mahasiswa_id');
    }
    public function bimbinganDosen(): HasMany
    {
        return $this->hasMany(Bimbingan::class, 'dosen_id');
    }
    public function bimbinganDosen2(): HasMany
    {
        return $this->hasMany(Bimbingan::class, 'dosen2_id');
    }
    public function pengajuanSkripsiMahasiswa(): HasMany
    {
        return $this->hasMany(PengajuanSkripsi::class, 'mahasiswa_id');
    }
    public function pengajuanSkripsiDospem(): HasMany
    {
        return $this->hasMany(PengajuanSkripsi::class, 'dospem_id');
    }
    public function pengajuanSkripsiDospem2(): HasMany
    {
        return $this->hasMany(PengajuanSkripsi::class, 'dospem2_id');
    }
    public function pengajuanSkripsiPenguji1(): HasMany
    {
        return $this->hasMany(PengajuanSkripsi::class, 'penguji1_id');
    }
    public function pengajuanSkripsiPenguji2(): HasMany
    {
        return $this->hasMany(PengajuanSkripsi::class, 'penguji2_id');
    }
    public function pengajuanSkripsiPenguji3(): HasMany
    {
        return $this->hasMany(PengajuanSempro::class, 'penguji3_id');
    }
    public function pengajuanAlat(): HasMany
    {
        return $this->hasMany(PengajuanAlat::class);
    }
}
