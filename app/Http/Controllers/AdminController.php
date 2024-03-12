<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

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
        return view('admin.mahasiswa.index', ['title' => 'student']);
    }

    public function getStudent()
    {
        return view('admin.mahasiswa.detailMahasiswa', ['title' => 'student']);
    }

    public function editStudent()
    {
        return view('admin.mahasiswa.editMahasiswa', ['title' => 'student']);
    }

    public function createStudent()
    {
        return view('admin.mahasiswa.createMahasiswa', ['title' => 'student']);
    }

    // dosen
    public function getLecturers()
    {
        return view('admin.dosen.index', ['title' => 'dosen']);
    }

    public function createLecturer()
    {
        return view('admin.dosen.createDosen', ['title' => 'dosen']);
    }

    public function editLecturer()
    {
        return view('admin.dosen.editDosen', ['title' => 'dosen']);
    }

    // komite
    public function getCommittees()
    {
        return view('admin.komite.index', ['title' => 'komite']);
    }
}
