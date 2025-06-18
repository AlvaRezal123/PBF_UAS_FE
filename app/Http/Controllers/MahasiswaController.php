<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Digunakan untuk koneksi ke API (backend CI)

class MahasiswaController extends Controller
{
    // Fungsi untuk menampilkan semua data mahasiswa
    public function index()
    {
        // Mengambil data dari API di backend CI (http://localhost:8080/mahasiswa)
        $response = Http::get('http://localhost:8080/mahasiswa');

        // Ubah hasil JSON jadi array
        $mhs = $response->json();

        // Kirim data mahasiswa ke halaman view mahasiswa/index.blade.php
        return view('mahasiswa.index', compact('mhs'));
    }

    // Fungsi untuk membuka halaman form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.create'); // Tampilkan form tambah mahasiswa
    }

    // Fungsi untuk menyimpan data mahasiswa ke database (melalui API CI)
    public function store(Request $request)
    {
        // Validasi inputan form, supaya tidak kosong dan sesuai tipe data
        $request->validate([
            'npm' => 'required|integer',
            'id_user' => 'required|integer',
            'id_dosen' => 'required|integer',
            'id_kajur' => 'required|integer',
            'nama_mahasiswa' => 'required|string|max:50',
            'tempat_tanggal_lahir' => 'required|string|max:50',
            'jenis_kelamin' => 'required|string|max:10',
            'alamat' => 'required|string|max:100',
            'agama' => 'required|string|max:20',
            'angkatan' => 'required|integer',
            'program_studi' => 'required|string|max:20',
            'semester' => 'required|integer',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email',
        ]);

        // Kirim data mahasiswa ke API dengan metode POST
        $response = Http::asJson()->post('http://localhost:8080/mahasiswa', [
            'npm' => $request->npm,
            'id_user' => $request->id_user,
            'id_dosen' => $request->id_dosen,
            'id_kajur' => $request->id_kajur,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'angkatan' => $request->angkatan,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'no_hp' => $request->no_hp,
            'email' => $request->email
        ]);

        // Jika berhasil disimpan, kembalikan ke halaman index dengan pesan sukses
        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Berhasil menambahkan mahasiswa.');
        }

        // Jika gagal, kembalikan ke form dengan pesan error
        return back()->withErrors(['error' => 'Gagal menambahkan data'])->withInput();
    }

    // Fungsi untuk membuka halaman form edit mahasiswa
    public function edit($npm)
    {
        // Ambil data mahasiswa berdasarkan NPM dari API
        $response = Http::get("http://localhost:8080/mahasiswa/$npm");

        // Jika datanya ada
        if ($response->successful()) {
            $mahasiswa = $response->json()[0]; // Ambil data pertama dari hasil API
            return view('mahasiswa.edit', compact('mahasiswa')); // Kirim data ke form edit
        }

        // Kalau tidak ada datanya, kembalikan ke halaman sebelumnya
        return back()->with('error', 'Data tidak ditemukan.');
    }

    // Fungsi untuk menyimpan perubahan data mahasiswa (update)
    public function update(Request $request, $npm)
    {
        // Validasi data yang diinputkan saat update
        $request->validate([
            'npm' => 'required|integer',
            'id_user' => 'required|integer',
            'id_dosen' => 'required|integer',
            'id_kajur' => 'required|integer',
            'nama_mahasiswa' => 'required|string|max:50',
            'tempat_tanggal_lahir' => 'required|string|max:50',
            'jenis_kelamin' => 'required|string|max:10',
            'alamat' => 'required|string|max:100',
            'agama' => 'required|string|max:20',
            'angkatan' => 'required|integer',
            'program_studi' => 'required|string|max:20',
            'semester' => 'required|integer',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email',
        ]);

        // Kirim data hasil update ke API menggunakan PUT
        $response = Http::put("http://localhost:8080/mahasiswa/$npm", $request->all());

        // Kalau update berhasil, kembali ke halaman utama
        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Berhasil mengupdate data.');
        }

        // Kalau gagal, tetap di form edit dengan pesan error
        return back()->withErrors(['error' => 'Gagal mengupdate data'])->withInput();
    }

    // Fungsi untuk menghapus data mahasiswa
    public function destroy($npm)
    {
        // Kirim request hapus ke API
        $response = Http::delete("http://localhost:8080/mahasiswa/$npm");

        // Kalau berhasil dihapus, kembali ke index dengan pesan sukses
        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Berhasil menghapus data.');
        }

        // Kalau gagal menghapus, kembali dengan pesan error
        return back()->with('error', 'Gagal menghapus data.');
    }
}
