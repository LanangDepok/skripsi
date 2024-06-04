<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class MahasiswaService
{
    //profile
    public function updateProfile($user, $validated_user)
    {
        if (isset($validated_user['photo_profil'])) {
            Storage::delete('public/' . $user->mahasiswa->photo_profil);
            $photo_profil = $validated_user['photo_profil']->store('photo_profil', 'public');
            $validated_user['photo_profil'] = $photo_profil;
        }

        if (isset($validated_user['tanda_tangan'])) {
            Storage::delete('public/' . $user->mahasiswa->tanda_tangan);
            $tanda_tangan = $validated_user['tanda_tangan']->store('tanda_tangan', 'public');
            $validated_user['tanda_tangan'] = $tanda_tangan;
        }

        $user->mahasiswa->update($validated_user);
    }

    //skripsi
    public function updateSkripsi($user, $skripsi, $validated_user)
    {
        if (isset($validated_user['file_skripsi'])) {
            if (isset($user->skripsi)) {
                Storage::delete('public/' . $user->skripsi->file_skripsi);
            }
            $file_skripsi = $validated_user['file_skripsi']->store('file_skripsi', 'public');
        }

        if (isset($validated_user['file_skripsi'])) {
            $skripsi->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'file_skripsi' => $file_skripsi,
                    'judul' => $validated_user['judul'],
                    'sub_judul' => $validated_user['sub_judul'],
                    'anggota' => $validated_user['anggota'],
                ]
            );
        } else {
            $skripsi->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'judul' => $validated_user['judul'],
                    'sub_judul' => $validated_user['sub_judul'],
                    'anggota' => $validated_user['anggota'],
                ]
            );
        }
    }

    //pengajuan
    public function ajukanSkripsi($user, $pengajuan_judul, $validated_mahasiswa, $validated_skripsi, $validated_pengajuan)
    {
        $pengajuan_judul->create($validated_pengajuan);

        if ($user->mahasiswa->tanda_tangan != null) {
            Storage::delete('public/' . $user->skripsi->file_skripsi);
        }

        $tanda_tangan = $validated_mahasiswa['tanda_tangan']->store('tanda_tangan', 'public');
        $validated_mahasiswa['tanda_tangan'] = $tanda_tangan;

        $user->mahasiswa()->update($validated_mahasiswa);

        $user->skripsi()->updateOrCreate(
            ['user_id' => $user->id],
            $validated_skripsi
        );
    }
}

?>