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
  
  <!-- Javascript paged based-->
  <script type="text/javascript">
    
    $(document).ready(function(e){
      
      $(".room-detail").each(function(e){
        var roomID = $(this).attr("data-id");
        const thisDiv = $(this);

        $.ajax({
          type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "select-room",
            roomID : roomID,
          },
          complete: function(response){
            var rsp = response.responseText.split("|");
            $(thisDiv).children("#rmAvail").val(rsp[0])
            $(thisDiv).children("#rmTtl").val(rsp[1])
            $(thisDiv).children("#rmPrice").val(rsp[2])
          },
          error: function(){
            alert("Connection to database failed!");
          }
        });
      })

      $(document).on("click",".btn-update-room",function(e){
          var rmTotal = $(this).siblings("#rmTtl").val();
          var price = $(this).siblings("#rmPrice").val();
          var roomID = $(this).parents(".room-detail").attr("data-id");

          $.ajax({
            type : 'POST',
            url : 'ajax-all-files.php',
            data : {
              txInd : "update-room",
              roomID : roomID,
              rmTotal : rmTotal,
              price : price,
            },
            complete: function(response){
              alert("Update Complete...");
            },
            error: function(){
              alert("Connection to database failed!");
            }
          });
      });


    });
  </script>

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

<div class="container card my-5">
  <img class="mt-3 card-img-top" src="1.jpg" height="250" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title font-weight-bold">Singel Room</h5>
    <div class="col-sm-8 room-detail" data-id='1'>
        Room Available : <input type="text" class="form-control" id="rmAvail" placeholder="Room Avail" readonly="readonly">
        Total Room  : <input type="text" class="form-control" id="rmTtl" placeholder="Total Room">
        Room Price : <input type="text" class="form-control" id="rmPrice" placeholder="Total Room">
        <button class="btn btn-info mt-4 btn-update-room">Update</button>
    </div>
  </div>
</div>

<div class="container card my-5">
  <img class="mt-3 card-img-top" src="2.jpg" height="250" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title font-weight-bold">Family Room</h5>
    <div class="col-sm-8 room-detail" data-id='2'>
        Room Available : <input type="text" class="form-control" id="rmAvail" placeholder="Room Avail" readonly="readonly">
        Total Room  : <input type="text" class="form-control" id="rmTtl" placeholder="Total Room">
        Room Price : <input type="text" class="form-control" id="rmPrice" placeholder="Total Room">
        <button class="btn btn-info mt-4 btn-update-room">Update</button>
    </div>
    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
  </div>
</div>

<div class="container card my-5">
  <img class="mt-3 card-img-top" src="3jpg.jpg" height="250" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title font-weight-bold">Luxury Room</h5>
    <div class="col-sm-8 room-detail" data-id='3'>
        Room Available : <input type="text" class="form-control" id="rmAvail" placeholder="Room Avail" readonly="readonly">
        Total Room  : <input type="text" class="form-control" id="rmTtl" placeholder="Total Room">
        Room Price : <input type="text" class="form-control" id="rmPrice" placeholder="Total Room">
        <button class="btn btn-info mt-4 btn-update-room">Update</button>
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

<script src="assets/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</html>