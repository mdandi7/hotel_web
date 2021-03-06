<?php
include "string.php";
include "configdb.php";

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

  <script src="assets/jquery-3.4.1.min.js"></script>
  <script src="assets/jsFunctionBooking.js"></script>
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
          <a class="dropdown-item" href="data_booking.php">Data Booking</a>
          <a class="dropdown-item" href="data_tamu.php">Data Tamu</a>
          <a class="dropdown-item" href="data_kamar.php">Data Kamar</a>
          <a class="dropdown-item" href="data_pegawai.php">Data Pegawai</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
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

<div class="container mt-5 ">
  <h1>Data Booking</h1>
</div>
  <div class="form-group col">
    <!-- <label for="namaobat" class="font-weight-bold  col-form-label">No Registrasi</label> -->
    <div class="col-sm-12 form-inline justify-content-end">
      <h5 class="mr-1">Cari : </h5>
        <input class="form-control mr-sm-2 ktp-search" type="text" placeholder="No. KTP">
        <button class="btn btn-outline-info find-data-ktp" type="submit" >Cari</button>
        <button class="btn btn-outline-info ml-2 clear-search" type="submit">Clear</button>
        <!-- <button class="btn btn-outline-info" type="submit" name="cariobat">Check In</button> -->
    </div>
  
  <div class="container py-4 search-table" style="display: none;"> 
    <h5 class="font-weight-bold">Hasil Pencarian</h5>
    <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No. KTP</th>
        <th scope="col">Nama</th>
        <th scope="col">Type Kamar</th>
        <th scope="col">Total Harga</th>
        <th scope="col">Check In</th>
        <th scope="col">Check Out</th>
        <th scope="col">Konfirmasi</th>
      </tr>
    </thead>
    <tbody class="search-table-show">
    </tbody>
  </table>
  </div>


  <div class="container py-4 all-tables" style="display: block"> 

  <h5 class="font-weight-bold">Konfirmasi Pending </h5>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No. KTP</th>
      <th scope="col">Nama</th>
      <th scope="col">Type Kamar</th>
      <th scope="col">Total Harga</th>
      <th scope="col">Check In</th>
      <th scope="col">Check Out</th>
      <th scope="col">Konfirmasi</th>
    </tr>
  </thead>
  <tbody class="pending-table">
  </tbody>
</table>


  <h5 class="font-weight-bold">Konfirmasi Success </h5>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No. KTP</th>
      <th scope="col">Nama</th>
      <th scope="col">Type Kamar</th>
      <th scope="col">Total Harga</th>
      <th scope="col">Check In</th>
      <th scope="col">Check Out</th>
    </tr>
  </thead>
  <tbody class="succed-table">
  </tbody>
</table>

  <h5 class="font-weight-bold">Konfirmasi Check-In </h5>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No. KTP</th>
      <th scope="col">Nama</th>
      <th scope="col">Type Kamar</th>
      <th scope="col">Total Harga</th>
      <th scope="col">Check In</th>
      <th scope="col">Check Out</th>
      <th scope="col">Konfirmasi Check-In</th>
    </tr>
  </thead>
  <tbody class="chckin-table">
  </tbody>
</table>

  <h5 class="font-weight-bold">Konfirmasi Check-Out </h5>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No. KTP</th>
      <th scope="col">Nama</th>
      <th scope="col">Type Kamar</th>
      <th scope="col">Total Harga</th>
      <th scope="col">Check In</th>
      <th scope="col">Check Out</th>
      <th scope="col">Konfirmasi Check-Out</th>
    </tr>
  </thead>
  <tbody class="chckout-table">
  </tbody>
</table>

</div>
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