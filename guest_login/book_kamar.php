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
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">

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

  <script src="../assets/jquery-3.4.1.min.js"></script>
  <script src="../assets/jsFunction.js"></script>

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
      <li class="nav-item">
        <a class="nav-link" href="guest_login.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="booking.php">Registrasi</a>
      </li> -->
      <li class="nav-item active">
        <a class="nav-link" href="data_kamar.php">Booking Room</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="../ind-login.php" id="navbarDropdown" aria-expanded="false">Login</a>
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


<!-- Modal (Payment Confirmation)  -->
<div class="modal fade" id="PymntConfirmModal" tabindex="-1" role="dialog" aria-labelledby="PymntConfirmModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PymntConfirmModalTitle">Payment Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row justify-content-center paid-modal-head'>Silahkan selesaikan pembayaran pada booking anda dan lakukan konfirmasi.</div><br>
        <div class='container border border-primary text-justify'>Pembayaran bisa dilakukan dengan transfer ke rekening berikut :
          <li>MANDIRI 080989898989 a/n Dandi Ajah</li><li>BRI 080989898989 a/n Dandi Ajah</li>
          <p class='font-weight-bold disp-total-price'>Total Pembayaran : Rp. 0</p>
        </div><br>
        <section class="row justify-content-end mr-1">
          <button type="button" data-current-id="0" class="btn btn-primary btn-konfirm-paid justify-content-end">Confirm</button>
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="accordion container py-4" id="accordionExample">
  <div class="card" >
    <div class="card-header" style="background-color: #333333;" id="headingOne">
      <h1 class="text-center text-light">Book A Room
    <h2 class="mb-0 text-center">
    <button class="btn btn-outline-info btn-room" type="button" data-room="1" room-name="Single Room">
      <img class="card-img-top" height="300" src="1.jpg" alt="Card image cap"><br>Single Room
    </button>
    <!-- <a style="font-size: 35px;" class="text-light font-weight-light">|</a> -->
    <button class="btn btn-outline-info btn-room" type="button" data-room="2" room-name="Family Room">
      <img class="card-img-top" height="300" src="2.jpg" alt="Card image cap"><br>Family Room
    </button>
    <!-- <a style="font-size: 35px;" class="text-light font-weight-light">|</a> -->
    <button class="btn btn-outline-info btn-room" type="button" data-room="3" room-name="Luxury Room">
      <img class="card-img-top" height="300" src="1.jpg" alt="Card image cap"><br>Luxury Room
    </button>
    </h2>
    </h1>
    </div>

    <!-- FORM BOOKING -->
        <!-- FORM TAMU DETAIL -->
        <div class="container-fluid row justify-content-center">
          <div class="col-sm-6">
          <form class="mt-3 form-tamu-detail" method="post">
          <h5>Data Tamu :</h5>
          <div class="alert-add" align="center" style="color: red"></div>
          <div class="form-group col">
            <label for="hargaobat" class="font-weight-bold col-sm-6 col-form-label">No. KTP</label>
              <div class="col-sm-8">
              <input type="text" class="form-control" id="idKtp" placeholder="No. KTP" required>
              </div>
          </div>

          <div class="form-group col">
            <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Nama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nama" placeholder="Nama" required>
            </div>
          </div>

          <div class="form-group col">
            <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label no-HP">No. Hp</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="noHP" placeholder="No.HP" required="required">
            </div>
          </div>
          
          <div class="form-group col">
            <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label email-tx">Email</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="email" placeholder="Email" required="required">
            </div>
          </div>

          <div class="form-group col">
            <label for="jenisobat" class="font-weight-bold col-sm-6 col-form-label">Total Bayar</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" id="ttlByr" placeholder="Total Bayar" readonly="readonly">
            </div>
          </div>

          </form>
          </div>

          <!-- FORM KAMAR -->
          <div class="col-sm-6">
          <form class="mt-3" method="post">
          <h5>Data Pesanan Kamar :</h5>

          <div class="form-group col">
            <!-- <span><?php echo $error; ?></span> -->
            <div class="col-sm-8">
              <input type="text" class="form-control room-name" data-id="0" readonly="readonly" placeholder="Nama Room"></input>
            </div>
          </div>

          <div class="form-group col">
            <!-- <span><?php echo $error; ?></span> -->
            <label for="kodeobat" class="font-weight-bold col-sm-6 col-form-label">Tanggal Check In</label>
            <div class="col-sm-8">
              <input type="date" class="form-control tgl-chck tgl-checkin"></input>
            </div>
          </div>

          <div class="form-group col">
            <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Tanggal Check Out</label>
            <div class="col-sm-8">
              <input type="date" class="form-control tgl-chck tgl-checkout">
            </div>
          </div>

          <div class="form-group col">
            <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Lama Inap</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="LmInap" placeholder="Lama Inap" readonly="readonly">
            </div>
          </div>

          <div class="form-group col">
            <label for="namaobat" class="font-weight-bold col-sm-6 col-form-label">Harga Kamar</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="hrgKmr" placeholder="Harga Kamar" readonly="readonly">
            </div>
          </div>

          </form>
          </div>
          <button class="btn btn-info mt-4 btn-order">Pesan Sekarang</button>
          <button class="btn btn-info mt-4 ml-4 btn-modal" style="display: block" data-toggle="modal" data-target="#PymntConfirmModal">Konfirmasi Pembayaran</button>
        </div>
      </div>
      <!-- FORM BOOKING -->
    </div>


<!-- CARD PALING BAWAH -->
<div class="my-5">
  <div class="container-fluid mt-5">
    <div class="container-fluid row justify-content-center">
      <h2 class="text-center font-weight-bold">Book a room</h2>
    <!-- <a class="btn btn-info text-justify" href="pesan_kamar.php">Pesan Kamar Sekarang</a> -->
    </div>
  </div>
  <div class="card-deck my-3 mx-2 text-justify">
    <div class="card">
      <a href="#"><img class="card-img-top" height="300" src="1.jpg" href="pesan_kamar.php" alt="Card image cap"></a>
      <div class="card-body">
        <h5 class="card-title font-weight-bold">Single Room</h5>
        <p class="card-text">Fasilitas : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </div>
    <div class="card">
      <a href="#"><img class="card-img-top" height="300" src="2.jpg" alt="Card image cap"></a>
      <div class="card-body">
        <h5 class="card-title font-weight-bold">Family Room</h5>
        <p class="card-text">Fasilitas : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </div>
    <div class="card">
      <a href="#"><img class="card-img-top" src="3jpg.jpg" height="300" alt="Card image cap"></a>
      <div class="card-body">
        <h5 class="card-title font-weight-bold">Deluxe Room</h5>
        <p class="card-text">Fasilitas : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </div>
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

<script src="../assets/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</html>