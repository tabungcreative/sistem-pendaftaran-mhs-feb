<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  @yield('style')

  <title>Hello, world!</title>
</head>

<body>
  <!-- As a link -->
  <nav class="navbar navbar-dark bg-danger">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
    </div>
  </nav>

  @yield('content')

  <!-- Footer -->
		<footer class="text-white text-center text-md-start mt-5" style="background-color: #161616">
			<div class="container-fluid p-4">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-11 p-3">
						<div class="row d-flex justify-content-between">
							<div class="col-lg-3 col-md-12 mb-4 mb-md-0">
								<img src="{{ asset('img/logo-feb.png')}}" class="d-block" style="height: 100px; width: 100px" alt="" />
								<hr style="border: 1px solid #b6b7b7" />
								<h5 class="h5" style="color: #b6b7b7">Fakultas Ekonomi dan Bisnis</h5>
								<p style="color: #505050">Universitas Sains Al Qur’an Jawa Tengah di Wonosobo</p>
							</div>

							<div class="col-lg-4 col-md-6 mb-4 mb-md-0">
								<h5 class="text-uppercase">Tentang Fakultas</h5>

								<p style="color: #505050">Sejarah Feb Unsiq</p>
							</div>

							<div class="col-lg-3 col-md-6 mb-4 mb-md-0">
								<h5 class="text-uppercase mb-3">Kontak</h5>

								<div class="text-right" style="color: #505050">
									<p class="text-right">Jl. KH. Hasyim Asy'ari Km. 03, Kalibeber, Kec. Mojotengah, Kab. Wonosobo,</p>
									<p class="text-right">Jawa Tengah - 56351</p>
									<p class="text-right">Telp. : (0286) ******</p>
									<p class="text-right">Fax. : (0286) *******</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row d-flex justify-content-center" style="background-color: #343434">
					<div class="col-lg-11 d-flex justify-content-between align-items-center">
						<div class="text-left p-3" style="color: #aeaeae">Copyright All Right Reserved 2022, Faculty of Economics and Business, UNSIQ</div>
						<div class="d-flex justify-content-between align-items-center">
							<a href="" class="icon-footer">
								<i class="fa fa-facebook-f p-3"></i>
							</a>
							<a href="" class="icon-footer">
								<i class="fa fa-instagram p-3"></i>
							</a>
							<a href="" class="icon-footer">
								<i class="fa fa-twitter p-3" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- Akhir Footer -->
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
    @if(Session::has('success'))
        swal({
            title: "Success",
            text: "{{ Session::get('success') }}",
            icon: "success",
            button: "Ok",
        });
    @endif
    @if(Session::has('error'))
        swal({
            title: "Gagal",
            text: "{{ Session::get('error') }}",
            icon: "error",
            button: "Ok",
        });
    @endif
    @if(Session::has('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        text: '{{ Session::get("warning") }}'
    })
    @endif
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        var form = event.target.form; // storing the form
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    });
</script>
  @yield('script')
</body>

</html>