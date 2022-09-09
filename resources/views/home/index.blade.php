@extends('layouts.home')

@section('content')
<div class="row d-flex justify-content-center pt-5">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('img/logo-feb.png') }}" alt="" srcset="" class="img-fluid" width="200px">
                    <p>Masukan Nomer Induk Mahasiswa untuk melanjutkan pelayanan pedaftaran mahasiswa</p>
                </div>
                <form id="form-nim">
                    <div class="mb-3">
                        <label class="form-label">Masukan Nomer Induk Mahasiswa</label>
                        <input type="text" id="nim" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center pt-5">
    <div class="col-md-6" id="detail-mhs">
        <!-- <div class="card shadow">
            <div class="card-body">
                <h5>Detail Mahasiswa</h5>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col">NIM</th>
                        <td scope="col">First</td>
                    </tr>
                    <tr>
                        <th scope="col">Nama</th>
                        <td scope="col">First</td>
                    </tr>
                    <tr>
                        <th scope="col">NIK</th>
                        <td scope="col">First</td>
                    </tr>

                </table>
            </div>
        </div> -->
    </div>
</div>
@endsection

@section('style')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formNim = document.getElementById('form-nim');
        formNim.addEventListener('submit', function(event) {
            event.preventDefault();
            tampilMahasiswa();
        });
    });

    function tampilMahasiswa() {
        const url = 'https://feb-unsiq.ac.id/api/mahasiswa/';

        const nim = document.getElementById('nim').value;

        if (nim === "") {
            return swal("Gagal", `Mahasiswa tidak ditemukan`, "warning");
        }

        fetch(url + nim)
            .then((response) => {
                return response.json();
            }).then((data) => {
                const mahasiswa = data.data;

                let card = document.createElement('div');
                card.classList.add('card', 'shadow');

                card.innerHTML =  `
                <div class="card-body">
                    <h5>Detail Mahasiswa</h5>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col">Nomer Induk Mahasiswa</th>
                            <th scope="col">:</th>
                            <td scope="col">${mahasiswa.nim ?? 'tidak diketahu'}</td>
                        </tr>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">:</th>
                            <td scope="col">${mahasiswa.nama}</td>
                        </tr>
                        <tr>
                            <th scope="col">Prodi</th>
                            <th scope="col">:</th>
                            <td scope="col">${mahasiswa.prodi}</td>
                        </tr>
                    </table>

                    <a href="daftar/${mahasiswa.nim}" class="btn btn-primary">Lanjut Pilih Pendaftaran</a>
                </div>
                `;

                let detailMahasiswa = document.getElementById('detail-mhs');
                
                detailMahasiswa.innerHTML = '';

                detailMahasiswa.append(card);
                return swal("Success", `Mahasiswa dengan nim terdaftar`, "success");


            }).catch(function(err) {
                return swal("Gagal", `Mahasiswa tidak ditemukan`, "warning");
            })
    }
</script>
@endsection