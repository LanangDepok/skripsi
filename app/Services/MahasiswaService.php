<?php

namespace App\Services;

use App\Models\Logbook;
use App\Models\PengajuanAlat;
use App\Models\PengajuanJudul;
use App\Models\PengajuanSempro;
use App\Models\PengajuanSkripsi;
use App\Models\Skripsi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class MahasiswaService
{
    //profile
    public function updateProfile($user, $validated)
    {
        if (isset($validated['photo_profil'])) {
            Storage::delete('public/' . $user->mahasiswa->photo_profil);
            $photo_profil = $validated['photo_profil']->store('photo_profil', 'public');
            $validated['photo_profil'] = $photo_profil;
        }

        if (isset($validated['tanda_tangan'])) {
            Storage::delete('public/' . $user->mahasiswa->tanda_tangan);
            $tanda_tangan = $validated['tanda_tangan']->store('tanda_tangan', 'public');
            $validated['tanda_tangan'] = $tanda_tangan;
        }

        $user->mahasiswa->update($validated);
    }

    //skripsi
    public function updateSkripsi($user, $validated)
    {
        if (isset($validated['file_skripsi'])) {
            if (isset($user->skripsi)) {
                Storage::delete('public/' . $user->skripsi->file_skripsi);
            }
            $file_skripsi = $validated['file_skripsi']->store('file_skripsi', 'public');
        }

        if (isset($validated['file_skripsi'])) {
            Skripsi::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'file_skripsi' => $file_skripsi,
                    'judul' => $validated['judul'],
                    'sub_judul' => $validated['sub_judul'],
                    'anggota' => $validated['anggota'],
                ]
            );
        } else {
            Skripsi::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'judul' => $validated['judul'],
                    'sub_judul' => $validated['sub_judul'],
                    'anggota' => $validated['anggota'],
                ]
            );
        }
    }

    //pengajuan
    public function ajukanJudul($user, $validated_mahasiswa, $validated_skripsi, $validated_pengajuan)
    {
        PengajuanJudul::create($validated_pengajuan);

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

    public function ajukanSempro($user, $validated_sempro, $validated_anggota, $validated_abstrak)
    {
        PengajuanSempro::create($validated_sempro);
        $user->skripsi->update($validated_anggota);
        $user->pengajuanJudul->sortByDesc('created_at')->first()->update($validated_abstrak);
    }

    public function ajukanSkripsi($validated)
    {
        PengajuanSkripsi::create($validated);
    }

    public function ajukanAlat($validated)
    {
        PengajuanAlat::create($validated);
    }

    //logbook
    public function storeLogbook($validator)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d', $validator['tanggal']);
        $validator['tanggal'] = $tanggal->translatedFormat('d F Y');

        if (Auth::user()->mahasiswa->status == 'Bimbingan Skripsi') {
            $validator['jenis_bimbingan'] = 'Skripsi';
        }

        Logbook::create($validator);
    }

    //form
    public function f8($pengajuanSkripsi)
    {
        $huruf_mutu = "";

        if ($pengajuanSkripsi->nilai_total >= 81) {
            $huruf_mutu = 'A';
        } elseif ($pengajuanSkripsi->nilai_total >= 76) {
            $huruf_mutu = 'A-';
        } elseif ($pengajuanSkripsi->nilai_total >= 72) {
            $huruf_mutu = 'B+';
        } elseif ($pengajuanSkripsi->nilai_total >= 68) {
            $huruf_mutu = 'B';
        } elseif ($pengajuanSkripsi->nilai_total >= 64) {
            $huruf_mutu = 'B-';
        } elseif ($pengajuanSkripsi->nilai_total >= 60) {
            $huruf_mutu = 'C+';
        } elseif ($pengajuanSkripsi->nilai_total >= 56) {
            $huruf_mutu = 'C';
        } elseif ($pengajuanSkripsi->nilai_total >= 41) {
            $huruf_mutu = 'D';
        } elseif ($pengajuanSkripsi->nilai_total >= 1) {
            $huruf_mutu = 'E';
        }

        return $huruf_mutu;
    }

    public function f9($pengajuanSkripsi)
    {
        $numberFormatter = new NumberFormatter('id', NumberFormatter::SPELLOUT);
        $nilaiRataRata = number_format($pengajuanSkripsi->nilai_total, 1);
        $terbilang = $numberFormatter->format($nilaiRataRata);

        $tanggal = Carbon::createFromFormat('Y-m-d', $pengajuanSkripsi->updated_at->format('Y-m-d'))->addDays(10);
        $deadline = $tanggal->translatedFormat('d F Y');

        $data = [
            'terbilang' => $terbilang,
            'deadline' => $deadline
        ];

        return $data;
    }

    public function f11($pengajuanSkripsi)
    {
        $penerima = $pengajuanSkripsi->pengajuanRevisi->terima_ketua_komite;
        $ttd = User::where('id', '=', $penerima)->first();

        return $ttd;
    }

    //revisi
    public function terimaRevisi($pengajuanRevisi, $link_revisi_alat)
    {
        $pengajuanRevisi->update([
            'status' => 'Menunggu persetujuan',
            'link_revisi_alat' => $link_revisi_alat
        ]);
        $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Menunggu persetujuan revisi']);
    }
}


