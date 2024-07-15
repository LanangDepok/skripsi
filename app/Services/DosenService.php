<?php

namespace App\Services;

use App\Models\Bimbingan;
use App\Models\PengajuanRevisi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DosenService
{
    //profile
    public function updateProfile($user, $validated)
    {
        if (isset($validated['photo_profil'])) {
            Storage::delete('public/' . $user->dosen->photo_profil);
            $photo_profil = $validated['photo_profil']->store('photo_profil', 'public');
            $validated['photo_profil'] = $photo_profil;
        }

        if (isset($validated['tanda_tangan'])) {
            Storage::delete('public/' . $user->dosen->tanda_tangan);
            $tanda_tangan = $validated['tanda_tangan']->store('tanda_tangan', 'public');
            $validated['tanda_tangan'] = $tanda_tangan;
        }

        $user->dosen->update($validated);
    }

    //logbook
    public function acceptLogbook($logbook, $cekTerima)
    {
        if ($cekTerima) {
            $logbook->update([
                'status' => 'Diterima',
                'pengizin' => Auth::user()->id,
            ]);
        } else {
            $logbook->update([
                'status' => 'Ditolak',
                'pengizin' => Auth::user()->id,
            ]);
        }
    }

    //persetujuan sidang
    public function acceptPersetujuanSidangSempro($pengajuanSempro, $cekTerima)
    {
        if ($cekTerima) {
            $tanggal = Carbon::now()->translatedFormat('d F Y');

            $pengajuanSempro->update([
                'status' => 'Menunggu pembagian jadwal',
                'acc_dospem' => $tanggal,
            ]);
        } else {
            $pengajuanSempro->update(['status' => 'Ditolak']);
        }
    }

    public function acceptPersetujuanSidangSkripsi($pengajuanSkripsi, $cekTerima)
    {
        if ($cekTerima) {
            $tanggal = Carbon::now()->translatedFormat('d F Y');

            $pengajuanSkripsi->update([
                'status' => 'Menunggu pembagian jadwal',
                'acc_dospem' => $tanggal,
                'pengizin' => Auth::user()->id
            ]);
        } else {
            $pengajuanSkripsi->update(['status' => 'Ditolak']);
        }
    }

    //pengujian sempro
    public function nilaiSempro($pengajuanSempro, $validator, $dospem2_id)
    {
        if ($validator['nilai'] >= 400) {
            if ($dospem2_id) {
                $bimbingan = Bimbingan::where('mahasiswa_id', '=', $pengajuanSempro->mahasiswa_id)->first();
                if ($dospem2_id == $bimbingan->dosen_id) {
                    return redirect()->route('dsn.penilaianSempro', ['pengajuanSempro' => $pengajuanSempro->id])->with('errorDospem', 'Pilihan dosen pembimbing 2 tidak boleh sama');
                } else {
                    $bimbingan->update(['dosen2_id' => $dospem2_id]);
                    $validator['dospem2_id'] = $dospem2_id;
                }
            }

            $validator['status'] = 'Lulus';
            $pengajuanSempro->update($validator);
        } else {
            $validator['status'] = 'Tidak lulus';
            $pengajuanSempro->update($validator);
        }

        $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->update(['status' => 'Bimbingan Skripsi']);
    }

    //pengujian skripsi
    public function nilaiSkripsiPenguji($pengajuanSkripsi, $validated)
    {
        if (Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
            $pengajuanSkripsi->update([
                'nilai1' => $validated['total_nilai'],
                'status' => 'Menunggu penilaian',
                '1a1' => $validated['a1'],
                '1a2' => $validated['a2'],
                '1a3' => $validated['a3'],
                '1b1' => $validated['b1'],
                '1b2' => $validated['b2'],
                '1b3' => $validated['b3'],
                '1b4' => $validated['b4'],
                '1b5' => $validated['b5'],
            ]);
        } elseif (Auth::user()->id == $pengajuanSkripsi->penguji2_id) {
            $pengajuanSkripsi->update([
                'nilai2' => $validated['total_nilai'],
                'status' => 'Menunggu penilaian',
                '2a1' => $validated['a1'],
                '2a2' => $validated['a2'],
                '2a3' => $validated['a3'],
                '2b1' => $validated['b1'],
                '2b2' => $validated['b2'],
                '2b3' => $validated['b3'],
                '2b4' => $validated['b4'],
                '2b5' => $validated['b5'],
            ]);
        } elseif (Auth::user()->id == $pengajuanSkripsi->penguji3_id) {
            $pengajuanSkripsi->update([
                'nilai3' => $validated['total_nilai'],
                'status' => 'Menunggu penilaian',
                '3a1' => $validated['a1'],
                '3a2' => $validated['a2'],
                '3a3' => $validated['a3'],
                '3b1' => $validated['b1'],
                '3b2' => $validated['b2'],
                '3b3' => $validated['b3'],
                '3b4' => $validated['b4'],
                '3b5' => $validated['b5'],
            ]);
        }
    }

    public function nilaiSkripsiPembimbing($pengajuanSkripsi, $validated)
    {
        if (Auth::user()->id == $pengajuanSkripsi->dospem_id) {
            $pengajuanSkripsi->update([
                'nilai_pembimbing' => $validated['total_nilai'],
                'status' => 'Menunggu penilaian',
                '4a1' => $validated['a1'],
                '4a2' => $validated['a2'],
                '4a3' => $validated['a3'],
                '4b1' => $validated['b1'],
                '4b2' => $validated['b2'],
                '4b3' => $validated['b3'],
                '4b4' => $validated['b4'],
                '4c1' => $validated['c1'],
                '4c2' => $validated['c2'],
                '4c3' => $validated['c3'],
                '4c4' => $validated['c4'],
            ]);
        } elseif (Auth::user()->id == $pengajuanSkripsi->dospem2_id) {
            $pengajuanSkripsi->update([
                'nilai_pembimbing2' => $validated['total_nilai'],
                'status' => 'Menunggu penilaian',
                '5a1' => $validated['a1'],
                '5a2' => $validated['a2'],
                '5a3' => $validated['a3'],
                '5b1' => $validated['b1'],
                '5b2' => $validated['b2'],
                '5b3' => $validated['b3'],
                '5b4' => $validated['b4'],
                '5c1' => $validated['c1'],
                '5c2' => $validated['c2'],
                '5c3' => $validated['c3'],
                '5c4' => $validated['c4'],
            ]);
        }
    }

    //rekapitulasi nilai
    public function rekapNilai($pengajuanSkripsi, $validated)
    {
        $nilai_mutu = "";
        if ($validated['nilai_total'] >= 81) {
            $nilai_mutu = 'A';
        } elseif ($validated['nilai_total'] >= 76) {
            $nilai_mutu = 'A-';
        } elseif ($validated['nilai_total'] >= 72) {
            $nilai_mutu = 'B+';
        } elseif ($validated['nilai_total'] >= 68) {
            $nilai_mutu = 'B';
        } elseif ($validated['nilai_total'] >= 64) {
            $nilai_mutu = 'B-';
        } elseif ($validated['nilai_total'] >= 60) {
            $nilai_mutu = 'C+';
        } elseif ($validated['nilai_total'] >= 56) {
            $nilai_mutu = 'C';
        } elseif ($validated['nilai_total'] >= 41) {
            $nilai_mutu = 'D';
        } elseif ($validated['nilai_total'] >= 1) {
            $nilai_mutu = 'E';
        }

        $validated['nilai_mutu'] = $nilai_mutu;
        $validated['status'] = 'Menunggu kelulusan';
        $pengajuanSkripsi->update($validated);
    }

    public function revisiSkripsi($pengajuanSkripsi, $validated)
    {
        $validated['pengajuan_skripsi_id'] = $pengajuanSkripsi->id;
        $validated['status'] = 'Revisi';
        $deadline_timestamp = Carbon::now()->addDays(10)->translatedFormat('d F Y');
        $validated['deadline'] = $deadline_timestamp;

        PengajuanRevisi::create($validated);
        $pengajuanSkripsi->update([
            'status' => 'Revisi',
            'tanggal_lulus' => Carbon::now()->translatedFormat('d F Y')
        ]);
        $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Revisi']);
    }

    //revisi
    public function terimaRevisi($pengajuanRevisi)
    {
        if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji1_id) {
            $pengajuanRevisi->update([
                'terima_penguji1' => 'Ya',
                'keterangan_penguji1' => 'Diterima'
            ]);
        } elseif (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji2_id) {
            $pengajuanRevisi->update([
                'terima_penguji2' => 'Ya',
                'keterangan_penguji2' => 'Diterima'
            ]);
        } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji3_id) {
            $pengajuanRevisi->update([
                'terima_penguji3' => 'Ya',
                'keterangan_penguji3' => 'Diterima'
            ]);
        } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem_id) {
            $pengajuanRevisi->update([
                'terima_pembimbing' => 'Ya',
                'keterangan_pembimbing' => 'Diterima'
            ]);
        } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem2_id) {
            $pengajuanRevisi->update([
                'terima_pembimbing2' => 'Ya',
                'keterangan_pembimbing2' => 'Diterima'
            ]);
        }
    }

    public function revisiUlang($pengajuanRevisi, $validated)
    {
        if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji1_id) {
            $pengajuanRevisi->update([
                'keterangan_penguji1' => $validated['keterangan_revisi'],
                'terima_penguji1' => 'Tidak'
            ]);
        } elseif (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji2_id) {
            $pengajuanRevisi->update([
                'keterangan_penguji2' => $validated['keterangan_revisi'],
                'terima_penguji2' => 'Tidak'
            ]);
        } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji3_id) {
            $pengajuanRevisi->update([
                'keterangan_penguji3' => $validated['keterangan_revisi'],
                'terima_penguji3' => 'Tidak'
            ]);
        } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem_id) {
            $pengajuanRevisi->update([
                'keterangan_pembimbing' => $validated['keterangan_revisi'],
                'terima_pembimbing' => 'Tidak'
            ]);
        } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem2_id) {
            $pengajuanRevisi->update([
                'keterangan_pembimbing2' => $validated['keterangan_revisi'],
                'terima_pembimbing2' => 'Tidak'
            ]);
        }
    }
}

