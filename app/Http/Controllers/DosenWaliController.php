<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Buat mengakses API (dari backend CodeIgniter)

class DosenWaliController extends Controller
{
    // Menampilkan semua data dosen wali
    public function index()
    {
        // Ambil data dari API endpoint dosen
        $response = Http::get('http://localhost:8080/dosen');

        // Ubah hasil JSON dari API jadi array PHP
        $dosen_wali = $response->json();

        // Kirim data ke tampilan dosen_wali/index.blade.php
        return view('dosen_wali.index', compact('dosen_wali'));
    }

    // Menampilkan form tambah dosen wali
    public function create()
    {
        return view('dosen_wali.create'); // Tampilkan form tambah dosen wali
    }

    // Menyimpan data dosen wali ke API
    public function store(Request $request)
    {
        // Validasi inputan dari form
        $request->validate([
            'nama_dosen' => 'required|string|max:50',
            'nidn' => 'required|string|max:15',
            'id_user' => 'required|integer',
        ]);

        // Kirim data ke backend CI menggunakan POST
        $response = Http::asJson()->post('http://localhost:8080/dosen', [
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'id_user' => $request->id_user,
        ]);

        // Jika berhasil disimpan
        if ($response->successful()) {
            return redirect()->route('dosen_wali.index')->with('success', 'Berhasil menambahkan dosen.');
        }

        // Jika gagal disimpan
        return back()->withErrors(['error' => 'Gagal menambahkan data'])->withInput();
    }

    // Menampilkan form edit dosen berdasarkan ID
    public function edit($id_dosen)
    {
        // Ambil data dosen berdasarkan id dari API
        $response = Http::get("http://localhost:8080/dosen/$id_dosen");

        // Jika datanya berhasil ditemukan
        if ($response->successful()) {
            $dosen = $response->json()[0]; // Ambil data pertama dari array JSON
            return view('dosen_wali.edit', compact('dosen')); // Tampilkan form edit
        }

        // Jika data tidak ditemukan
        return back()->with('error', 'Data tidak ditemukan.');
    }

    // Menyimpan perubahan data dosen wali
    public function update(Request $request, $id)
    {
        // Validasi data input dari form
        $request->validate([
            'nama_dosen' => 'required|string|max:50',
            'nidn' => 'required|string|max:15',
            'id_user' => 'required|integer',
        ]);

        // Kirim data update ke API pakai metode PUT
        $response = Http::put("http://localhost:8080/dosen/$id", $request->all());

        // Jika update berhasil
        if ($response->successful()) {
            return redirect()->route('dosen_wali.index')->with('success', 'Berhasil mengupdate data.');
        }

        // Kalau gagal update
        return back()->withErrors(['error' => 'Gagal mengupdate data'])->withInput();
    }

    // Menghapus data dosen wali
    public function destroy($id)
    {
        // Kirim permintaan hapus ke API
        $response = Http::delete("http://localhost:8080/dosen/$id");

        // Jika berhasil dihapus
        if ($response->successful()) {
            return redirect()->route('dosen_wali.index')->with('success', 'Berhasil menghapus data.');
        }

        // Kalau gagal hapus
        return back()->with('error', 'Gagal menghapus data.');
    }
}
