<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct(protected AdminService $adminService)
    {
    }

    public function index()
    {
        return view('admin.index', ['title' => 'index']);
    }

    // mahasiswa
    public function getStudents()
    {
        $data = Mahasiswa::get();
        return view('admin.mahasiswa.index', ['title' => 'mahasiswa', 'data' => $data]);
    }

    public function getStudent(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.detailMahasiswa', ['title' => 'mahasiswa', 'mahasiswa' => $mahasiswa]);
    }

    public function createStudent()
    {
        return view('admin.mahasiswa.createMahasiswa', ['title' => 'mahasiswa']);

    }
    public function storeStudent(Request $request)
    {
        $user = new User;
        $mahasiswa = new Mahasiswa;

        $data = $request->all();
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nama' => 'required',
            'nim' => 'required|integer|unique:mahasiswas,nim',
            'kelas' => 'required',
            'prodi' => 'required',
            'tahun_ajaran' => 'required',
            'status' => 'required'
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah tersedia.',
            'email' => ':attribute tidak valid.',
            'integer' => ':attribute harus berupa angka.'
        ];
        $validator = Validator::make($data, $rules, $messages);
        $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
        $validated_mahasiswa = $validator->safe()->only(['nim', 'kelas', 'prodi', 'tahun_ajaran', 'status']);

        $this->adminService->storeStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa);

        return redirect('/admin/mahasiswa/create')->with('success', 'Data berhasil ditambahkan.');
    }

    public function editStudent(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.editMahasiswa', ['title' => 'mahasiswa', 'mahasiswa' => $mahasiswa]);
    }

    public function updateStudent(Request $request, Mahasiswa $mahasiswa)
    {
        $user = $mahasiswa->user;

        $data = $request->all();
        $rules = [
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
            'nama' => 'required',
            'nim' => ['required', 'integer', Rule::unique('mahasiswas', 'nim')->ignore($mahasiswa)],
            'kelas' => 'required',
            'prodi' => 'required',
            'tahun_ajaran' => 'required',
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah tersedia.',
            'email' => ':attribute tidak valid.',
            'integer' => ':attribute harus berupa angka.'
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($request->password) {
            $rules['password'] = 'required';
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
        } else {
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'nama']);
        }

        $validated_mahasiswa = $validator->safe()->only(['nim', 'kelas', 'prodi', 'tahun_ajaran']);

        $this->adminService->updateStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa);

        return redirect('/admin/mahasiswa')->with('success', 'Data berhasil diubah.');
    }

    public function deleteStudent(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect('/admin/mahasiswa')->with('success', 'Data berhasil dihapus.');
    }

    // dosen
    public function getLecturers()
    {
        $data = Dosen::get();

        return view('admin.dosen.index', ['title' => 'dosen', 'data' => $data]);
    }

    public function getLecturer(Dosen $dosen)
    {
        return view('admin.dosen.detailDosen', ['title' => 'dosen', 'dosen' => $dosen]);
    }

    public function createLecturer()
    {
        return view('admin.dosen.createDosen', ['title' => 'dosen']);
    }

    public function storeLecturer(Request $request)
    {
        $user = new User;
        $dosen = new Dosen;

        $data = $request->all();
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nama' => 'required',
            'nip' => 'required|integer|unique:dosens,nip',
            'jabatan' => 'required',
            'fungsional' => 'required',
            'gol_pangkat' => 'required',
            'role' => 'required',
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah tersedia.',
            'email' => ':attribute tidak valid.',
            'integer' => ':attribute harus berupa angka.'
        ];

        $validator = Validator::make($data, $rules, $messages);
        $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
        $validated_dosen = $validator->safe()->only(['nip', 'jabatan', 'fungsional', 'gol_pangkat', 'role']);

        $this->adminService->storeLecturer($validated_user, $validated_dosen, $user, $dosen);

        return redirect('/admin/dosen/create')->with('success', 'Data berhasil ditambahkan.');
    }

    public function editLecturer(Dosen $dosen)
    {
        return view('admin.dosen.editDosen', ['title' => 'dosen', 'dosen' => $dosen]);
    }

    public function updateLecturer(Request $request, Dosen $dosen)
    {
        $user = $dosen->user;

        $data = $request->all();
        // dd($data);
        $rules = [
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
            'nama' => 'required',
            'nip' => ['required', 'integer', Rule::unique('dosens', 'nip')->ignore($dosen)],
            'jabatan' => 'required',
            'fungsional' => 'required',
            'gol_pangkat' => 'required',
            'role' => 'required',
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah tersedia.',
            'email' => ':attribute tidak valid.',
            'integer' => ':attribute harus berupa angka.'
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($request->password) {
            $rules['password'] = 'required';
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
        } else {
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'nama']);
        }

        $validated_dosen = $validator->safe()->only(['nip', 'jabatan', 'fungsional', 'gol_pangkat', 'role']);
        // dd($validated_dosen);

        $this->adminService->updateLecturer($validated_user, $validated_dosen, $user, $dosen);

        return redirect('/admin/dosen')->with('success', 'Data berhasil diubah.');
    }

    //pengajuan judul
    public function pengajuanJudul()
    {
        return view('admin.pengajuan.judul.index', ['title' => 'pengajuan']);
    }

    public function storePengajuanJudul(Request $request)
    {
        return view('admin.pengajuan.judul.index', ['title' => 'pengajuan']);
    }

    public function getPengajuanJudul()
    {
        return view('admin.pengajuan.judul.detailPengajuan', ['title' => 'pengajuan']);
    }

    //pengajuan sempro
    public function pengajuanSempro()
    {
        return view('admin.pengajuan.sempro.index', ['title' => 'pengajuan']);
    }

    public function getPengajuanSempro()
    {
        return view('admin.pengajuan.sempro.detailPengajuan', ['title' => 'pengajuan']);
    }

    //pengajuan skripsi
    public function pengajuanSkripsi()
    {
        return view('admin.pengajuan.skripsi.index', ['title' => 'pengajuan']);
    }

    public function getPengajuanSkripsi()
    {
        return view('admin.pengajuan.skripsi.detailPengajuan', ['title' => 'pengajuan']);
    }

    //pengajuan alat
    public function getAllPengajuanAlat()
    {
        return view('admin.pengajuan.alat.index', ['title' => 'pengajuan']);
    }

    public function getPengajuanAlat()
    {
        return view('admin.pengajuan.alat.detail', ['title' => 'pengajuan']);
    }

    //skripsi
    public function getSkripsian()
    {
        return view('admin.skripsi.index', ['title' => 'skripsi']);
    }

    //revisi
    public function getAllRevisi()
    {
        return view('admin.revisi.index', ['title' => 'revisi']);
    }
}
