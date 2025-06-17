@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mahasiswa</h1>
    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf
        <div class="mb-3">
            <label>NPM</label>
            <input type="text" name="npm" class="form-control" required>
        </div>
        <div class="mb-3">
    <label>User</label>
    <select name="id_user" class="form-control" required>
        @foreach ($users as $user)
            <option value="{{ $user['id_user'] }}">{{ $user['nama_user'] }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Dosen Wali</label>
    <select name="id_dosen" class="form-control" required>
        @foreach ($dosens as $dosen)
            <option value="{{ $dosen['id_dosen'] }}">{{ $dosen['nama_dosen'] }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Ketua Jurusan</label>
    <select name="id_kajur" class="form-control" required>
        @foreach ($kajurs as $kajur)
            <option value="{{ $kajur['id_kajur'] }}">{{ $kajur['nama_kajur'] }}</option>
        @endforeach
    </select>
</div>
        <div class="mb-3">
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tempat Tanggal Lahir</label>
            <input type="text" name="tempat_tanggal_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <input type="text" name="jenis_kelamin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>        
        <div class="mb-3">
            <label>Agama</label>
            <input type="text" name="agama" class="form-control" required>    
        </div>  
        <div class="mb-3">
            <label>Angkatan</label>
            <input type="number" name="angkatan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>program_studi</label>
            <input type="text" name="program_studi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Semester</label>
            <input type="number" name="semester" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>  
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
