<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Logbook;
use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;
use App\Models\Role;
use App\Models\Skripsi;
use App\Models\User;
use App\Services\MahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function pengajuanJudul(User $user)
    {
        if (!isset($user->pengajuanJudul) || $user->pengajuanJudul->latest()->first()->status == 'ditolak') {
            $roles = Role::find(5)->users()->get();

            return view('mahasiswa.pengajuan.pengajuanJudul', ['title' => 'pengajuan', 'roles' => $roles]);
        } else {
            return redirect('mahasiswa/informasi')->with('messages', 'Anda sudah melakukan pengajuan judul!');
        }
    }

    public function ajukanJudul(Request $request, User $user)
    {
        $pengajuan_judul = new PengajuanJudul();

        $data = $request->all();
        $rules = [
            'no_kontak' => 'required|integer',
            'nama_ortu' => 'required',
            'no_kontak_ortu' => 'required|integer',
            'anggota' => 'nullable',
            'judul_dosen' => 'required',
            'judul' => 'required',
            'sub_judul' => 'nullable',
            'abstrak' => 'required',
            'studi_kasus' => 'required',
            'sumber_referensi' => 'required',
            'pilihan1_dospem' => 'required',
            'pilihan2_dospem' => 'required',
            'pilihan3_dospem' => 'required',
            'tanda_tangan' => 'required|mimes:jpg,jpeg,png'
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'integer' => 'penulisan :attribute harus mengikuti aturan dasar.'
        ];
        $validator = Validator::make($data, $rules, $messages);
        $validated_mahasiswa = $validator->safe()->only(['no_kontak', 'nama_ortu', 'no_kontak_ortu', 'tanda_tangan']);
        $validated_mahasiswa['status'] = 'Melakukan pengajuan judul';

        $validated_skripsi = $validator->safe()->only(['judul', 'sub_judul', 'anggota', 'sumber_referensi']);
        $validated_skripsi['user_id'] = $user->id;

        $validated_pengajuan = $validator->safe()->only(['anggota', 'judul_dosen', 'judul', 'sub_judul', 'abstrak', 'studi_kasus', 'sumber_referensi']);
        $dosen_pilihan = $validator->safe()->only(['pilihan1_dospem', 'pilihan2_dospem', 'pilihan3_dospem']);
        $validated_pengajuan['dosen_pilihan'] = implode(' - ', $dosen_pilihan);
        $validated_pengajuan['user_id'] = $user->id;
        $validated_pengajuan['status'] = 'menunggu';

        $this->mahasiswaService->ajukanSkripsi($user, $pengajuan_judul, $validated_mahasiswa, $validated_skripsi, $validated_pengajuan);

        return redirect('/mahasiswa/informasi');
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
        if (Auth::user()->mahasiswa->bimbingan == null) {
            return redirect('/mahasiswa/informasi/')->with('messages', 'Anda belum mempunyai dosen pembimbing.');
        } else {
            $bimbingan = Auth::user()->mahasiswa->bimbingan;
            return view('mahasiswa.logbook.index', ['title' => 'logbook', 'bimbingan' => $bimbingan]);
        }
    }

    public function getLogbook(Logbook $logbook)
    {
        return view('mahasiswa.logbook.detailLogbook', ['title' => 'logbook', 'logbook' => $logbook]);
    }

    public function createLogbook()
    {
        return view('mahasiswa.logbook.logbookCreate', ['title' => 'logbook']);
    }

    public function storeLogbook(Request $request)
    {
        $data = $request->all();
        $rules = [
            'tanggal' => 'required',
            'tempat' => 'required',
            'uraian' => 'required',
            'rencana_pencapaian' => 'required',
            'jenis_bimbingan' => 'required',
        ];
        $messages = ['required' => 'silahkan isi :attribute terlebih dahulu!'];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $validator['bimbingan_id'] = Auth::user()->mahasiswa->bimbingan->id;
        $validator['status'] = 'Menunggu persetujuan';

        Logbook::create($validator);

        return redirect('/mahasiswa/logbook')->with('success', 'Berhasil mengajukan logbook');
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

    public function getPengajuanJudul(PengajuanJudul $pengajuanJudul)
    {
        return view('mahasiswa.informasi.getPengajuanJudul', ['title' => 'informasi', 'pengajuanJudul' => $pengajuanJudul]);
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
