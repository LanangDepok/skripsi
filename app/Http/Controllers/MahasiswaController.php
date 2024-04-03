<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\User;
use App\Services\MahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function __construct(protected MahasiswaService $mahasiswaService)
    {
    }

    public function index()
    {
        $konten = Konten::get();
        return view('mahasiswa.index', ['title' => 'index', 'konten' => $konten]);
    }

    // pengajuan
    public function pengajuanJudul()
    {
        return view('mahasiswa.pengajuan.pengajuanJudul', ['title' => 'pengajuan']);
    }

    public function pengajuanSempro()
    {
        return view('mahasiswa.pengajuan.pengajuanSempro', ['title' => 'pengajuan']);
    }

    public function pengajuanSkripsi()
    {
        return view('mahasiswa.pengajuan.pengajuanSkripsi', ['title' => 'pengajuan']);
    }

    public function pengajuanAlat()
    {
        return view('mahasiswa.pengajuan.pengajuanAlat', ['title' => 'pengajuan']);
    }

    // logbook
    public function getLogbooks()
    {
        return view('mahasiswa.logbook.index', ['title' => 'logbook']);
    }

    public function createLogbook()
    {
        return view('mahasiswa.logbook.logbookCreate', ['title' => 'logbook']);
    }

    // skripsi
    public function getSkripsi()
    {
        if (Gate::allows('mahasiswa')) {
            return view('mahasiswa.skripsi.index', ['title' => 'skripsi']);
        }
        abort(404);

    }

    public function editSkripsi()
    {
        if (Gate::allows('mahasiswa')) {
            return view('mahasiswa.skripsi.skripsiEdit', ['title' => 'skripsi']);
        }
        abort(404);
    }

    public function updateSkripsi(Request $request, User $user)
    {
        $skripsi = new Skripsi();

        if (Gate::forUser($user)->allows('mahasiswa')) {
            $data = $request->all();
            $rules = [
                'judul' => 'required',
                'sub_judul' => 'nullable',
                'anggota' => 'nullable',
                'file_skripsi' => 'required|mimes:pdf',
            ];
            $messages = [
                'integer' => ':attribute harus berupa angka.',
                'mimes' => ':attribute harus berupa pdf',
                'required' => ':attribute tidak boleh kosong.'
            ];
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->validated();

            $this->mahasiswaService->updateSkripsi($user, $skripsi, $validated_user);

            return redirect('/mahasiswa/skripsi');
        }
        abort(404);
    }

    // informasi
    public function getInformations()
    {
        return view('mahasiswa.informasi.index', ['title' => 'informasi']);
    }

    public function getBeritaSempro()
    {
        return view('mahasiswa.informasi.beritaSempro', ['title' => 'informasi']);
    }
    public function getBeritaSkripsi()
    {
        return view('mahasiswa.informasi.beritaSkripsi', ['title' => 'informasi']);
    }

    //Revisi
    public function getAllRevisi()
    {
        return view('mahasiswa.Revisi.index', ['title' => 'revisi']);
    }
    public function getRevisi()
    {
        return view('mahasiswa.Revisi.detail', ['title' => 'revisi']);
    }

    // profile
    public function getProfile()
    {
        if (Gate::allows('mahasiswa')) {
            return view('mahasiswa.profile.index', ['title' => 'profile']);
        }
        abort(404);
    }

    public function editProfile()
    {
        if (Gate::allows('mahasiswa')) {
            return view('mahasiswa.profile.profileEdit', ['title' => 'profile']);
        }
        abort(404);
    }

    public function updateProfile(Request $request, User $user)
    {
        if (Gate::forUser($user)->allows('mahasiswa')) {
            $data = $request->all();
            $rules = [
                'photo_profil' => 'nullable|mimes:jpg,jpeg,png',
                'tanda_tangan' => 'required|mimes:jpg,jpeg,png',
                'no_kontak' => 'required|integer',
                'nama_ortu' => 'required',
                'no_kontak_ortu' => 'required|integer',
            ];
            $messages = [
                'integer' => ':attribute harus berupa angka.',
                'mimes' => ':attribute harus berupa gambar dengan format (jpg, jpeg, png).',
                'required' => ':attribute tidak boleh kosong.'
            ];
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->validated();

            $this->mahasiswaService->updateProfile($user, $validated_user);

            return redirect('/mahasiswa/profile');
        }
        abort(404);
    }
}
