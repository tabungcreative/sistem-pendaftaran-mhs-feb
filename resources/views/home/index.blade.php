@extends('layouts.home')

@section('content')
<div class="row d-flex justify-content-center pt-5">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
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


@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formNim = document.getElementById('form-nim');
        formNim.addEventListener('submit', function(event) {
            // event.preventDefault();
            tampilMahasiswa();
        });
    });

    function tampilMahasiswa() {
        const url = 'https://feb-unsiq.ac.id/api/mahasiswa/';

        const nim = document.getElementById('nim').value;

        fetch(url + nim)
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    return swal("Gagal", `Mahasiswa dengan nim ${nim} tidak ditemukan`, "warning");
                    // alert(`Mahasiswa dengan nim ${nim} tidak ditemukan, silahkan masukan kembali nim dengan benar`);
                }
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
                            <td scope="col">${mahasiswa.nim}</td>
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
                    <a href="#" class="btn btn-primary">Lanjut Pilih Pendaftaran</a>
                </div>
                `;

                let detailMahasiswa = document.getElementById('detail-mhs');
                
                detailMahasiswa.innerHTML = '';

                detailMahasiswa.append(card);
                return swal("Success", `Mahasiswa dengan nim terdaftar`, "Success");

            }).catch(function(err) {
                // console.log(err);
            })
    }
</script>
@endsection