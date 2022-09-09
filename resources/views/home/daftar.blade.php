@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <h4>Pilih Jenis Pendaftaran</h4>
            <hr/>
            <div class="row d-flex justify-content-left mt-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Skripsi</h5>
                        <a href="{{ route('skripsi.create', $nim) }}" class="btn btn-sm btn-primary">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection