 @extends('layouts.app') 

 @section('content') 
<div class="container">
    <h1>Daftar Mahasiswa</h1>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>npm</th>
                <th>id_user</th>
                <th>id_dosen</th>
                <th>id_kajur</th>
                <th>nama_mahasiswa</th>
                <th>tempat_tanggal_lahir</th>
                <th>jenis_kelamin</th>
                <th>alamat</th>
                <th>agama</th>
                <th>angkatan</th>
                <th>program_studi</th>
                <th>semester</th>
                <th>no_hp</th>
                <th>email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mhs as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa['npm'] }}</td>
                <td>{{ $mahasiswa['id_user'] }}</td>
                <td>{{ $mahasiswa['id_dosen'] }}</td>
                <td>{{ $mahasiswa['id_kajur'] }}</td>
                <td>{{ $mahasiswa['nama_mahasiswa'] }}</td>
                <td>{{ $mahasiswa['tempat_tanggal_lahir'] }}</td>
                <td>{{ $mahasiswa['jenis_kelamin'] }}</td>
                <td>{{ $mahasiswa['alamat'] }}</td>
                <td>{{ $mahasiswa['agama'] }}</td>
                <td>{{ $mahasiswa['angkatan'] }}</td>
                <td>{{ $mahasiswa['program_studi'] }}</td>
                <td>{{ $mahasiswa['semester'] }}</td>
                <td>{{ $mahasiswa['no_hp'] }}</td>
                <td>{{ $mahasiswa['email'] }}</td>

                
                <td>
                    <a href="{{ route('mahasiswa.edit', $mahasiswa['npm']) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('mahasiswa.destroy', $mahasiswa['npm']) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
 @endsection 
