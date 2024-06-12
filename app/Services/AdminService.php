<?php

namespace App\Services;

use App\Models\Konten;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    //profile
    public function updateProfile($user, $photo_profil, $tanda_tangan)
    {
        if (isset($photo_profil)) {
            Storage::delete('public/' . $user->dosen->photo_profil);
            $user->dosen->updateOrCreate(
                ['nip' => $user->dosen->nip],
                ['photo_profil' => $photo_profil->store('photo_profil', 'public')]
            );
        }

        if (isset($tanda_tangan)) {
            Storage::delete('public/' . $user->dosen->tanda_tangan);
            $user->dosen->updateOrCreate(
                ['nip' => $user->dosen->nip],
                ['tanda_tangan' => $tanda_tangan->store('tanda_tangan', 'public')]
            );
        }
    }

    //konten
    public function updateKonten($timeline_skripsi, $alur_skripsi)
    {
        if (isset($timeline_skripsi)) {
            Storage::delete('public/' . Konten::where('nama', '=', 'timeline_skripsi')->first()['gambar']);
            Konten::updateOrCreate(
                ['nama' => 'timeline_skripsi'],
                ['gambar' => $timeline_skripsi->store('konten', 'public')]
            );
        }

        if (isset($alur_skripsi)) {
            Storage::delete('public/' . Konten::where('nama', '=', 'alur_skripsi')->first()['gambar']);
            Konten::updateOrCreate(
                ['nama' => 'alur_skripsi'],
                ['gambar' => $alur_skripsi->store('konten', 'public')]
            );
        }
    }

    //mahasiswa
    public function storeStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa)
    {
        $insert_user = $user->create($validated_user);
        $validated_mahasiswa['user_id'] = $insert_user->id;
        $mahasiswa->create($validated_mahasiswa);

        $insert_user->roles()->sync(6);
    }

    public function updateStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa)
    {
        $user->update($validated_user);
        $mahasiswa->update($validated_mahasiswa);
    }

    //dosen
    public function storeLecturer($validated_user, $validated_dosen, $validated_role, $user, $dosen)
    {
        $insert_user = $user->create($validated_user);
        $validated_dosen['user_id'] = $insert_user->id;
        $dosen->create($validated_dosen);

        $id = [];
        foreach ($validated_role as $roles) {
            foreach ($roles as $role) {
                $id[] = $role;
            }
        }
        $role = $insert_user->roles()->sync($id);
    }

    public function updateLecturer($validated_user, $validated_dosen, $validated_role, $dosen)
    {
        $dosen->user->update($validated_user);
        $dosen->update($validated_dosen);

        $id = [];
        foreach ($validated_role as $roles) {
            foreach ($roles as $role) {
                $id[] = $role;
            }
        }
        $dosen->user->roles()->sync($id);
    }

    //pengajuan sempro
    public function terimaPengajuanSempro($pengajuanSempro, $validated)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d', $validated['tanggal']);
        $validated['tanggal'] = $tanggal->translatedFormat('d F Y');

        $validated['status'] = 'Menunggu sidang';

        $pengajuanSempro->update($validated);
        $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->update(['status' => 'Sidang Sempro']);
    }

    //pengajuan skripsi
    public function terimaPengajuanSkripsi($pengajuanSkripsi, $validated)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d', $validated['tanggal']);
        $validated['tanggal'] = $tanggal->translatedFormat('d F Y');

        $validated['status'] = 'Menunggu sidang';

        $pengajuanSkripsi->update($validated);
        $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Sidang Skripsi']);
    }

    //pengajuan alat
    public function terimaPengajuanAlat($pengajuanAlat)
    {
        $pengajuanAlat->update(['status' => 'Diterima']);
        $pengajuanAlat->user->mahasiswa->update(['status' => 'Lulus']);
    }
    public function tolakPengajuanAlat($pengajuanAlat, $validated)
    {
        $validated['status'] = 'Ditolak';
        $pengajuanAlat->update($validated);
    }

    //revisi
    public function keputusanRevisiTolak($pengajuanRevisi)
    {
        $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Ditolak']);
        $pengajuanRevisi->update(['status' => 'Tidak lulus']);
        $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Bimbingan Skripsi']);
    }

    public function keputusanRevisiUlang($pengajuanRevisi)
    {
        if ($pengajuanRevisi->terima_penguji1 == 'Tidak') {
            $pengajuanRevisi->update([
                'terima_penguji1' => null,
                'status' => 'Revisi'
            ]);
            $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
        }
        if ($pengajuanRevisi->terima_penguji2 == 'Tidak') {
            $pengajuanRevisi->update([
                'terima_penguji2' => null,
                'status' => 'Revisi'
            ]);
            $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
        }
        if ($pengajuanRevisi->terima_penguji3 == 'Tidak') {
            $pengajuanRevisi->update([
                'terima_penguji3' => null,
                'status' => 'Revisi'
            ]);
            $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
        }
        if ($pengajuanRevisi->terima_pembimbing == 'Tidak') {
            $pengajuanRevisi->update([
                'terima_pembimbing' => null,
                'status' => 'Revisi'
            ]);
            $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
        }
        if ($pengajuanRevisi->terima_pembimbing2 == 'Tidak') {
            $pengajuanRevisi->update([
                'terima_pembimbing2' => null,
                'status' => 'Revisi'
            ]);
            $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
        }
    }

    public function keputusanRevisiTerima($pengajuanRevisi)
    {
        $tanggal = Carbon::now()->translatedFormat('d F Y');
        $pengajuanRevisi->update([
            'status' => 'Diterima',
            'terima_ketua_komite' => Auth::user()->id,
            'tanggal_revisi' => $tanggal,
        ]);
        $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Lulus']);
        $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Serah terima alat']);
    }
}

