<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class AdminService
{
    //mahasiswa
    public function storeStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa)
    {
        $insert_user = $user->create($validated_user);
        $validated_mahasiswa['user_id'] = $insert_user->id;
        $mahasiswa->create($validated_mahasiswa);
    }

    public function updateStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa)
    {
        $user->update($validated_user);
        $mahasiswa->update($validated_mahasiswa);
    }

    //dosen
    public function storeLecturer($validated_user, $validated_dosen, $user, $dosen)
    {
        $insert_user = $user->create($validated_user);
        $validated_dosen['user_id'] = $insert_user->id;
        $dosen->create($validated_dosen);
    }

    public function updateLecturer($validated_user, $validated_dosen, $user, $dosen)
    {
        $user->update($validated_user);
        $dosen->update($validated_dosen);
    }
}

?>