<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class DosenService
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
}

?>