<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Konten;
use App\Models\Logbook;
use App\Models\PengajuanAlat;
use App\Models\PengajuanJudul;
use App\Models\PengajuanRevisi;
use App\Models\PengajuanSempro;
use App\Models\PengajuanSkripsi;
use App\Models\Role;
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
        if (Gate::allows('mahasiswa')) {
            $konten = Konten::get();
            return view('mahasiswa.index', ['title' => 'index', 'konten' => $konten]);
        }
        abort(404);
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
        if (Gate::allows('mahasiswa') && Auth::user()->id == $user->id) {
            $data = $request->all();
            $rules = [
                'photo_profil' => 'nullable|mimes:jpg,jpeg,png',
                'tanda_tangan' => 'nullable|mimes:jpg,jpeg,png',
                'no_kontak' => 'required|regex:/^\d+$/',
                'nama_ortu' => 'required',
                'no_kontak_ortu' => 'required|regex:/^\d+$/',
            ];
            $messages = [
                'regex' => ':attribute harus berupa angka.',
                'mimes' => ':attribute harus berupa gambar dengan format (jpg, jpeg, png).',
                'required' => ':attribute tidak boleh kosong.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            if ($request->password) {
                $user->update(['password' => $request->password]);
            }

            $this->mahasiswaService->updateProfile($user, $validated);

            return redirect('/mahasiswa/profile');
        }
        abort(404);
    }

    // skripsi
    public function getSkripsi()
    {
        if (Gate::allows('mahasiswa')) {
            if (Auth::user()->pengajuanJudul->isEmpty()) {
                return redirect('/mahasiswa/pengajuan/judul/' . Auth::user()->id)->with('messages', 'Ajukan judul terlebih dahulu.');
            } elseif (Auth::user()->pengajuanJudul->sortByDesc('created_at')->first()->status != 'Diterima') {
                return redirect('/mahasiswa/informasi/')->with('messages', 'Pastikan pengajuan judul sudah Diterima.');
            }
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
        if (Gate::allows('mahasiswa') && Auth::user()->id == $user->id) {
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
            $validated = Validator::make($data, $rules, $messages)->validate();

            $this->mahasiswaService->updateSkripsi($user, $validated);

            return redirect('/mahasiswa/skripsi');
        }
        abort(404);
    }

    // pengajuan
    public function pengajuanJudul()
    {
        if (Gate::allows('mahasiswa')) {
            if (Auth::user()->pengajuanJudul->isEmpty() || Auth::user()->pengajuanJudul->sortByDesc('created_at')->first()->status == 'Ditolak') {
                $roles = Role::find(5)->users()->get();
                return view('mahasiswa.pengajuan.pengajuanJudul', ['title' => 'pengajuan', 'roles' => $roles]);
            } else {
                return redirect('mahasiswa/informasi')->with('messages', 'Anda sudah melakukan pengajuan judul!');
            }
        }
        abort(404);
    }

    public function ajukanJudul(Request $request, User $user)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $user->id) {
            $data = $request->all();
            $rules = [
                'no_kontak' => 'required|regex:/^\d+$/',
                'nama_ortu' => 'required',
                'no_kontak_ortu' => 'required|regex:/^\d+$/',
                'anggota' => 'nullable',
                'judul_dosen' => 'required',
                'judul' => 'required',
                'sub_judul' => 'nullable',
                'abstrak' => 'required',
                'studi_kasus' => 'required',
                'sumber_referensi' => 'required',
                'pilihan1_dospem' => 'required|different:pilihan2_dospem,pilihan3_dospem',
                'pilihan2_dospem' => 'required|different:pilihan1_dospem,pilihan3_dospem',
                'pilihan3_dospem' => 'required|different:pilihan2_dospem,pilihan1_dospem',
                'tanda_tangan' => 'required|mimes:jpg,jpeg,png'
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'regex' => 'penulisan :attribute harus berupa angka.',
                'different' => 'Pilihan dosen pembimbing tidak boleh sama'
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

            $this->mahasiswaService->ajukanJudul($user, $validated_mahasiswa, $validated_skripsi, $validated_pengajuan);

            return redirect('/mahasiswa/informasi');
        }
        abort(404);
    }

    public function pengajuanSempro()
    {
        if (Gate::allows('mahasiswa')) {
            if (Auth::user()->bimbinganMahasiswa == null) {
                return redirect('/mahasiswa/informasi')->with('messages', 'Pastikan sudah mempunyai dosen pembimbing terlebih dahulu.');
            } elseif (count(Auth::user()->bimbinganMahasiswa->logbook->where('status', '=', 'Diterima')) < 3) {
                return redirect('/mahasiswa/logbook')->with('messages', 'Minimal jumlah bimbingan adalah 3x sebelum mengajukan Seminar Proposal');
            } elseif (Auth::user()->pengajuanSemproMahasiswa->isEmpty()) {
                return view('mahasiswa.pengajuan.pengajuanSempro', ['title' => 'pengajuan']);
            } elseif (Auth::user()->pengajuanSemproMahasiswa && (Auth::user()->pengajuanSemproMahasiswa->sortByDesc('created_at')->first()->status == 'Ditolak' || Auth::user()->pengajuanSemproMahasiswa->sortByDesc('created_at')->first()->status == 'Tidak lulus')) {
                return view('mahasiswa.pengajuan.pengajuanSempro', ['title' => 'pengajuan']);
            } else {
                return redirect('/mahasiswa/informasi')->with('messages', 'Anda sudah mengajukan sidang sempro.');
            }
        }
        abort(404);
    }

    public function ajukanSempro(Request $request, User $user)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $user->id) {
            $data = $request->all();
            $rules = [
                'abstrak' => 'required',
                'metode' => 'required',
                'anggota' => 'nullable',
                'bukti_registrasi' => 'required'
            ];
            $messages = [
                'required' => 'silahkan isi :attribute terlebih dahulu.',
                'mimes' => 'pastikan :attribute sesuai dengan format yang disebutkan!'
            ];
            $validator = Validator::make($data, $rules, $messages);

            $validated_sempro = $validator->safe()->only(['metode', 'bukti_registrasi']);
            $validated_sempro['status'] = 'Menunggu persetujuan pembimbing';
            $validated_sempro['mahasiswa_id'] = $user->id;
            $validated_sempro['dospem_id'] = $user->bimbinganMahasiswa->dosen_id;

            $validated_anggota = $validator->safe()->only(['anggota']);
            $validated_abstrak = $validator->safe()->only('abstrak');

            $this->mahasiswaService->ajukanSempro($user, $validated_sempro, $validated_anggota, $validated_abstrak);

            return redirect('/mahasiswa/informasi')->with('success', 'Pengajuan sempro berhasil, mohon cek info secara berkala');
        }
        abort(404);
    }

    public function pengajuanSkripsi()
    {
        if (Gate::allows('mahasiswa')) {
            if (Auth::user()->pengajuanSemproMahasiswa->isEmpty()) {
                return redirect('/mahasiswa/informasi')->with('messages', 'Pastikan sudah menyelesaikan seminar proposal terlebih dahulu.');
            } elseif (Auth::user()->pengajuanSemproMahasiswa->sortByDesc('created_at')->first()->status != 'Lulus') {
                return redirect('/mahasiswa/logbook')->with('messages', 'Pastikan sudah menyelesaikan seminar proposal terlebih dahulu.');
            } elseif (count(Auth::user()->bimbinganMahasiswa->logbook->where('status', '=', 'Diterima')->where('jenis_bimbingan', 'Skripsi')) < 10) {
                return redirect('/mahasiswa/logbook')->with('messages', 'Minimal jumlah bimbingan adalah 10x sebelum mengajukan Sidang Skripsi');
            } elseif (Auth::user()->pengajuanSkripsiMahasiswa->isEmpty()) {
                return view('mahasiswa.pengajuan.pengajuanSkripsi', ['title' => 'pengajuan']);
            } elseif (Auth::user()->pengajuanSkripsiMahasiswa && (Auth::user()->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->status == 'Ditolak' || Auth::user()->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->status == 'Ditolak')) {
                return view('mahasiswa.pengajuan.pengajuanSkripsi', ['title' => 'pengajuan']);
            } else {
                return redirect('/mahasiswa/informasi')->with('messages', 'Anda sudah mengajukan sidang skripsi.');
            }
        }
        abort(404);
    }

    public function ajukanSkripsi(Request $request, User $user)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $user->id) {
            $data = $request->all();
            $rules = [
                'sertifikat_lomba' => 'required',
                'link_presentasi' => 'required',
            ];
            $messages = ['required' => 'silahkan isi :attribute terlebih dahulu.'];

            $validated = Validator::make($data, $rules, $messages)->validate();
            $validated['mahasiswa_id'] = $user->id;
            $validated['dospem_id'] = $user->bimbinganMahasiswa->dosen_id;
            $validated['dospem2_id'] = $user->bimbinganMahasiswa->dosen2_id;
            $validated['status'] = 'Menunggu persetujuan pembimbing';

            $this->mahasiswaService->ajukanSkripsi($validated);

            return redirect('/mahasiswa/informasi')->with('success', 'Pengajuan skripsi berhasil, mohon cek info secara berkala');
        }
        abort(404);
    }

    public function pengajuanAlat()
    {
        if (Gate::allows('mahasiswa')) {
            if (Auth::user()->pengajuanSkripsiMahasiswa->isEmpty()) {
                return redirect('/mahasiswa/informasi')->with('messages', 'Pastikan sudah menyelesaikan sidang skripsi terlebih dahulu.');
            } elseif (Auth::user()->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->status != 'Lulus') {
                return redirect('/mahasiswa/logbook')->with('messages', 'Pastikan sudah menyelesaikan sidang skripsi terlebih dahulu.');
            } elseif (Auth::user()->pengajuanAlat->isEmpty()) {
                return view('mahasiswa.pengajuan.pengajuanAlat', ['title' => 'pengajuan']);
            } elseif (Auth::user()->pengajuanAlat && Auth::user()->pengajuanAlat->sortByDesc('created_at')->first()->status == 'Ditolak') {
                return view('mahasiswa.pengajuan.pengajuanAlat', ['title' => 'pengajuan']);
            } else {
                return redirect('/mahasiswa/informasi')->with('messages', 'Anda sudah mengajukan pengajuan serah terima alat dan skripsi.');
            }
        }
        abort(404);
    }

    public function ajukanAlat(Request $request, User $user)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $user->id) {
            $data = $request->all();
            $rules = [
                'f12' => 'required',
                'f13' => 'required',
                'f14' => 'required',
                'sertifikat_toeic' => 'required',
                'sertifikat_prestasi' => 'required',
                'sertifikat_pkkp' => 'required',
                'sertifikat_organiasi' => 'nullable',
            ];
            $messages = ['required' => 'Silahkan isi terlebih dahulu'];
            $validated = Validator::make($data, $rules, $messages)->validate();
            $validated['user_id'] = $user->id;
            $validated['status'] = 'Menunggu persetujuan';

            $this->mahasiswaService->ajukanAlat($validated);

            return redirect('/mahasiswa/informasi')->with('success', 'Pengajuan serah terima alat dan skripsi berhasil, mohon cek info secara berkala');
        }
        abort(404);
    }

    // logbook
    public function getLogbooks()
    {
        if (Gate::allows('mahasiswa')) {
            if (!isset(Auth::user()->bimbinganMahasiswa)) {
                return redirect('/mahasiswa/informasi/')->with('messages', 'Anda belum mempunyai dosen pembimbing. Silahkan ajukan di tab "Pengajuan -> Judul & Pembimbing" ');
            } else {
                $bimbingan = Auth::user()->bimbinganMahasiswa;
                return view('mahasiswa.logbook.index', ['title' => 'logbook', 'bimbingan' => $bimbingan]);
            }
        }
        abort(404);
    }

    public function getLogbook(Logbook $logbook)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $logbook->bimbingan->mahasiswa_id) {
            $penerima = User::where('id', '=', $logbook->pengizin)->first();
            return view('mahasiswa.logbook.detailLogbook', ['title' => 'logbook', 'logbook' => $logbook, 'penerima' => $penerima]);
        }
        abort(404);
    }

    public function createLogbook()
    {
        if (Gate::allows('mahasiswa')) {
            if (Auth::user()->skripsi->file_skripsi == null) {
                return redirect('/mahasiswa/skripsi/')->with('messages', 'Tambahkan laporan seminar proposal atau skripsi terlebih dahulu.');
            }
            return view('mahasiswa.logbook.logbookCreate', ['title' => 'logbook']);
        }
        abort(404);
    }

    public function storeLogbook(Request $request)
    {
        if (Gate::allows('mahasiswa')) {
            $data = $request->all();
            $rules = [
                'tanggal' => 'required',
                'tempat' => 'required',
                'uraian' => 'required',
                'rencana_pencapaian' => 'required',
            ];
            $messages = ['required' => 'silahkan isi :attribute terlebih dahulu!'];
            $validator = Validator::make($data, $rules, $messages)->validate();

            $validator['bimbingan_id'] = Auth::user()->bimbinganMahasiswa->id;
            $validator['status'] = 'Menunggu persetujuan pembimbing';
            $validator['jenis_bimbingan'] = 'Proposal';

            $this->mahasiswaService->storeLogbook($validator);

            return redirect('/mahasiswa/logbook')->with('success', 'Berhasil mengajukan logbook');
        }
        abort(404);
    }

    // informasi
    public function getInformations()
    {
        if (Gate::allows('mahasiswa')) {
            return view('mahasiswa.informasi.index', ['title' => 'informasi']);
        }
        abort(404);
    }

    public function getPengajuanJudul(PengajuanJudul $pengajuanJudul)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $pengajuanJudul->user_id) {
            $bimbingan = Bimbingan::where('mahasiswa_id', '=', $pengajuanJudul->user_id)->first();
            return view('mahasiswa.informasi.getPengajuanJudul', ['title' => 'informasi', 'pengajuanJudul' => $pengajuanJudul, 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }

    public function getPengajuanSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $pengajuanSempro->mahasiswa_id) {
            $bimbingan = Bimbingan::where('mahasiswa_id', '=', $pengajuanSempro->mahasiswa_id)->first();
            return view('mahasiswa.informasi.getPengajuanSempro', ['title' => 'informasi', 'pengajuanSempro' => $pengajuanSempro, 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }

    public function getPengajuanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $pengajuanSkripsi->mahasiswa_id) {
            $bimbingan = Bimbingan::where('mahasiswa_id', '=', $pengajuanSkripsi->mahasiswa_id)->first();
            return view('mahasiswa.informasi.getPengajuanSkripsi', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi, 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }

    public function getPengajuanAlat(PengajuanAlat $pengajuanAlat)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $pengajuanAlat->user_id) {
            $bimbingan = Bimbingan::where('mahasiswa_id', '=', $pengajuanAlat->user_id)->first();
            return view('mahasiswa.informasi.getPengajuanAlat', ['title' => 'informasi', 'pengajuanAlat' => $pengajuanAlat, 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }


    //form
    public function f1(PengajuanSempro $pengajuanSempro)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSempro->mahasiswa_id == Auth::user()->id) ||
            (Gate::allows('dosen_pembimbing') && ($pengajuanSempro->dospem_id == Auth::user()->id || $pengajuanSempro->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f1', ['title' => 'informasi', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }
    public function f2(PengajuanSempro $pengajuanSempro)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSempro->mahasiswa_id == Auth::user()->id) ||
            (Gate::allows('dosen_pembimbing') && ($pengajuanSempro->dospem_id == Auth::user()->id || $pengajuanSempro->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f2', ['title' => 'informasi', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }
    public function f3(PengajuanSempro $pengajuanSempro)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSempro->mahasiswa_id == Auth::user()->id) ||
            (Gate::allows('dosen_pembimbing') && ($pengajuanSempro->dospem_id == Auth::user()->id || $pengajuanSempro->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f3', ['title' => 'informasi', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }
    public function f4(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f4', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f5(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f5', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f6a(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f6a', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f6b(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f6b', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f7a(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f7a', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f7b(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f7b', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f7c(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f7c', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f8(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f8', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f9(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            $data = $this->mahasiswaService->f9($pengajuanSkripsi);

            return view('mahasiswa.informasi.f9', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi, 'terbilang' => $data['terbilang'], 'deadline' => $data['deadline']]);
        }
        abort(404);
    }
    public function f10(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            return view('mahasiswa.informasi.f10', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function f11(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            (Gate::allows('mahasiswa') && $pengajuanSkripsi->mahasiswa_id == Auth::user()->id) ||
            ((Gate::allows('dosen_pembimbing')) && ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id))
        ) {
            $ttd = $this->mahasiswaService->f11($pengajuanSkripsi);

            return view('mahasiswa.informasi.f11', ['title' => 'informasi', 'pengajuanSkripsi' => $pengajuanSkripsi, 'ttd' => $ttd]);
        }
        abort(404);
    }

    //revisi
    public function getAllRevisi()
    {
        if (Gate::allows('mahasiswa')) {
            if (isset(Auth::user()->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi)) {
                $pengajuanRevisi = PengajuanRevisi::where('pengajuan_skripsi_id', '=', Auth::user()->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->id)
                    ->where('status', '=', 'Revisi')->first();
                return view('mahasiswa.Revisi.index', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
            }
            return view('mahasiswa.Revisi.index', ['title' => 'revisi']);
        }
        abort(404);
    }
    public function getRevisi(PengajuanRevisi $pengajuanRevisi)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->mahasiswa_id) {
            return view('mahasiswa.Revisi.detail', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
        }
        abort(404);
    }
    public function terimaRevisi(Request $request, PengajuanRevisi $pengajuanRevisi)
    {
        if (Gate::allows('mahasiswa') && Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->mahasiswa_id) {
            $link_revisi_alat = $request->link_revisi_alat;

            $this->mahasiswaService->terimaRevisi($pengajuanRevisi, $link_revisi_alat);

            return redirect('/mahasiswa/informasi')->with('success', 'Silahkan cek informasi secara berkala');
        }
        abort(404);
    }

}
