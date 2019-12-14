<?php
include "string.php";
// include "configdb.php";

// $con = OpenCon();
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $nama_aplikasi ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

	<style type="text/css">
		.navbar {
			padding: .8rem;
		}
		.navbar-nav li {
			padding-right: 20px;
		}
		.carousel-inner img {
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body class="text-monospace">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-dark pl-4 fixed-top sticky-top shadow" style="background-color: #333333;">
<a class="navbar-brand" href="#"><img src="4.jpeg" width="30" height="30" class="d-inline-block align-top rounded-circle">
Reservasi Hotel
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-sm-2">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Beranda<span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="booking.php">Registrasi</a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">List Data</a>
        <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="data_tamu.php">Data Tamu</a>
          <a class="dropdown-item" href="data_kamar.php">Data Kamar</a>
          <a class="dropdown-item" href="data_pegawai.php">Data Pegawai</a>
          <a class="dropdown-item" href="data_booking.php">Data Booking</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Guest</a>
        <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<!-- jumbotron -->
<div class="jumbotron jumbotron-fluid rounded-bottom mb-0 shadow " style="background-color: #333333;  background-repeat: no-repeat; background-size: 150%">
  <div class="container text-center">
  	<img src="4.jpeg" width="20%" class="rounded-circle img-thumbnail">
    <h1 class="display-4 text-light">Reservasi Hotel</h1>
    <p  class="lead text-light ">Hotel Bintang 7 Masuk Angin</p>
  </div>
</div>

<div class="container-fluid mt-5">
  <h1>Form Registrasi Kamar</h1>
</div>
<div class="container-fluid row justify-content-center">
  <div class="col-sm-6">
  <form class="mt-3" method="post">
  <h5>Data Tamu :</h5>

  <div class="form-group col">
    <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">No Registrasi</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat" required>
    </div>
  </div>

  <div class="form-group col">
    <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat" required>
    </div>
  </div>

  <div class="form-group col">
    <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Alamat</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat" required>
    </div>
  </div>

  <div class="form-group col">
    <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat" required>
    </div>
  </div>

  <div class="form-group col">
    <label for="jenisobat" class="font-weight-bold col-sm-6 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-8">
      <select class="custom-select" id="jenisobat" name="jenisobat">
        <option selected>Pilih Salah Satu</option>
        <option value="1">Laki-Laki</option>
        <option value="2">Perempuan</option>
    </select>
    </div>
  </div>

  <div class="form-group col">
    <label for="hargaobat" class="font-weight-bold col-sm-6 col-form-label">Nomor KTP</label>
      <div class="col-sm-8">
      <input type="text" class="form-control" id="hargaobat" placeholder="Harga Obat" name="hargaobat" required>
      </div>
  </div>

  </form>
  </div>

<div class="col-sm-6">
  <form class="mt-3" method="post">
  <h5>Data Pesanan Kamar :</h5>

  <div class="form-group col">
    <!-- <span><?php echo $error; ?></span> -->
    <label for="kodeobat" class="font-weight-bold col-sm-6 col-form-label">Tanggal Check In</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" id="kodeobat" name="kodeobat" placeholder="Kode Obat" required></input>
    </div>
  </div>

  <div class="form-group col">
    <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Tanggal Check Out</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat" required>
    </div>
  </div>

  <div class="form-group col">
    <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Lama Inap</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat" required>
    </div>
  </div>

  <div class="form-group col">
    <label for="jenisobat" class="font-weight-bold col-sm-6 col-form-label">Tipe Kamar</label>
    <div class="col-sm-8">
      <select class="custom-select" id="jenisobat" name="jenisobat">
        <option selected>Pilih Salah Satu</option>
        <option value="1">Kamar Kecil</option>
        <option value="2">Kamar Sedang</option>
    </select>
    </div>
  </div>

  <div class="form-group col">
    <label for="jenisobat" class="font-weight-bold col-sm-6 col-form-label">Nomor Kamar</label>
    <div class="col-sm-8">
      <select class="custom-select" id="jenisobat" name="jenisobat">
        <option selected>Pilih Salah Satu</option>
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
    </div>
  </div>

  <div class="form-group col">
    <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Harga Kamar</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat" required>
    </div>
  </div>

  <!-- <div class="form-group col">
    <label for="hargaobat" class="font-weight-bold col-sm-6 col-form-label">Nomor KTP</label>
      <div class="col-sm-8">
      <input type="text" class="form-control" id="hargaobat" placeholder="Harga Obat" name="hargaobat" required>
      </div>
  </div> -->

  </form>
  </div>
  <button class="btn btn-info">Pesan Sekarang</button>
</div>






<!-- Footer -->
<footer class="page-footer text-light font-small unique-color-dark pt-1 mt-4" style="background-color: #555555">

  <!-- Footer Links -->
  <div class="container text-justify text-md-left mt-5" >

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4" >

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold">Company name</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
          consectetur
          adipisicing elit.</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Another Link</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">MDBootstrap</a>
        </p>
        <p>
          <a href="#!">MDWordPress</a>
        </p>
        <p>
          <a href="#!">BrandFlow</a>
        </p>
        <p>
          <a href="#!">Bootstrap Angular</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Social Media</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">Your Account</a>
        </p>
        <p>
          <a href="#!">Become an Affiliate</a>
        </p>
        <p>
          <a href="#!">Shipping Rates</a>
        </p>
        <p>
          <a href="#!">Help</a>
        </p>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p> New York, NY 10012, US</p>
        <p>info@example.com</p>
        <p>+ 01 234 567 88</p>
        <p>+ 01 234 567 89</p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3" style="background-color: #333333">© 2019 Copyright:
    <a href="#">Hotel 757 Tahoa</a>, All right reserved.
  </div>
  <!-- Copyright -->

</footer>

</body>

<script>
function goBack() {
  window.history.back()
}
</script>

<script src="assets/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</html>