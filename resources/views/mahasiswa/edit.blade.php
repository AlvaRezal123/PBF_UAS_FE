@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>
    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa['npm']) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>NPM</label>
            <input type="text" name="npm" class="form-control" value="{{ $mahasiswa['npm'] }}" required>
        </div>
        <div class="mb-3">
            <label>ID User</label>
            <input type="number" name="id_user" class="form-control" value="{{ $mahasiswa['id_user'] }}" required>
        </div>
        <div class="mb-3">
            <label>ID Dosen Wali</label>
            <input type="number" name="id_dosen" class="form-control" value="{{ $mahasiswa['id_dosen'] }}" required>
        </div>
        <div class="mb-3">
            <label>ID Kajur</label>
            <input type="number" name="id_kajur" class="form-control" value="{{ $mahasiswa['id_kajur'] }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" class="form-control" value="{{ $mahasiswa['nama_mahasiswa'] }}" required>
        </div>
        <div class="mb-3">
            <label>Tempat Tanggal Lahir</label>
            <input type="text" name="tempat_tanggal_lahir" class="form-control" value="{{ $mahasiswa['tempat_tanggal_lahir'] }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <input type="text" name="jenis_kelamin" class="form-control" value="{{ $mahasiswa['jenis_kelamin'] }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $mahasiswa['alamat'] }}" required>
        </div>
        <div class="mb-3">
            <label>Agama</label>
            <input type="text" name="agama" class="form-control" value="{{ $mahasiswa['agama'] }}" required>
        </div>
        <div class="mb-3">
            <label>Angkatan</label>
            <input type="number" name="angkatan" class="form-control" value="{{ $mahasiswa['angkatan'] }}" required>
        </div>
        <div class="mb-3">
            <label>Program Studi</label>
            <input type="text" name="program_studi" class="form-control" value="{{ $mahasiswa['program_studi'] }}" required>
        </div>
        <div class="mb-3">
            <label>Semester</label>
            <input type="number" name="semester" class="form-control" value="{{ $mahasiswa['semester'] }}" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $mahasiswa['no_hp'] }}" required>
        </div>  
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $mahasiswa['email'] }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection