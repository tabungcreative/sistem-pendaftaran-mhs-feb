@extends('layouts.home')   

@section('content')
<div class="row d-flex justify-content-center pt-5">
    <div class="col-md-6" id="detail-mhs">
        <div class="card shadow">
            <div class="card-body">
                <h5>Detail Mahasiswa</h5>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col">NIM</th>
                        <td scope="col">{{ $mahasiswa['nim'] }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Nama</th>
                        <td scope="col">{{ $mahasiswa['nama'] }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Prodi</th>
                        <td scope="col">{{ $mahasiswa['prodi'] }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Tempat Lahir</th>
                        <td scope="col">{{ $mahasiswa['tempat_lahir'] }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Tanggal Lahir</th>
                        <td scope="col">{{ $mahasiswa['tanggal_lahir'] }}</td>
                    </tr>
                    <tr>
                        <th scope="col">NIK</th>
                        <td scope="col">{{ $mahasiswa['nik'] }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Nomer HP</th>
                        <td scope="col">{{ $mahasiswa['nomer_hp'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center pt-5">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-body">
                <h5>Form Pendaftaran Ujian Skripsi</h5>
                <form method="POST" action="{{ route('skripsi.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $mahasiswa['nim'] }}">
                    <div class="mb-3">
                        <label class="form-label">Judul Skripsi</label>
                        <input type="text" name="judul" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pembimbing 1</label>
                        <input type="text" name="pembimbing1" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pembimbing 2</label>
                        <input type="text" name="pembimbing2" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Skripsi</label>
                        <input type="file" name="file_skripsi" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Pembayaran Skripsi</label>
                        <input type="text" name="no_pembayaran" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection