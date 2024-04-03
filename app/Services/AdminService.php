<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class AdminService
{
    //konten
    public function updateKonten($konten, $timeline_skripsi, $alur_skripsi)
    {
        if (isset($timeline_skripsi)) {
            Storage::delete('public/' . $konten->where('nama', '=', 'timeline_skripsi')->first()['gambar']);
            $konten->updateOrCreate(
                ['nama' => 'timeline_skripsi'],
                ['gambar' => $timeline_skripsi->store('konten', 'public')]
            );
        }

        if (isset($alur_skripsi)) {
            Storage::delete('public/' . $konten->where('nama', '=', 'alur_skripsi')->first()['gambar']);
            $konten->updateOrCreate(
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
}

?>