<?php
include "string.php";
include "configdb.php";

//$con = OpenCon();

?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $nama_aplikasi ?></title>

    <!-- Required meta tags -->
  <meta charset="utf-8">
  <script src="../assets/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="../assets/plugin/datepicker/css/bootstrap-datepicker.min.css">
  <script src="../assets/plugin/datepicker/js/bootstrap-datepicker.min.js"></script>

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

  <script type="text/javascript">

    $(document).ready(function(){
      $(function(){
        $(".datepicker").datepicker({
          format: 'yyyy-mm',
          autoclose: true,
          todayHighlight: true,
          startView: "months", 
          minViewMode: "months"
        });
        $(".datepicker").datepicker("setDate", new Date());
      });

      $(".btn-mth").click(function(e){
        var choosenMth = $("#choosen-mth").val();
        var but_this = this;
        $(but_this).attr("disabled", true);
        $(but_this).val("Loading...");

        $.ajax({
          type: "POST",
          url: 'ajax-pemilik.php',
          data:{
            choosenDay : 0,
            choosenMth: choosenMth,
            query_ind: 'monthly'
          },
          complete: function(response){
            var respVal = response.responseText.split('|');
            document.getElementById("form-laporan").innerHTML = respVal[0];
            eval(respVal[1]);
            $(but_this).attr("disabled", false);
            $(but_this).val("go");
          },
          error: function () {
            //alert("Select failed.");
            //$('#test').html('Bummer: there was an error!');
            //document.getElementById("test").innerHTML = prepareSQL;
          }
        });
        return false;
      });

      setTimeout(function() {
        $(".btn-mth").trigger("click");  
      },10);
    });

    function FunctionOnLoad(){

      

      $(".exportharian").click(function(e){
        var choosenMth = $("#choosen-mth").val();
        var page = "export_data.php?data=" + choosenMth +" &download_ind=monthly";
        window.location = page;

        return false;
      });

    }

  </script>

</head>

<body>
<!-- Navigation -->
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
     <!--  <li class="nav-item">
        <a class="nav-link" href="#">Data Kamar</a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laporan</a>
        <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="laporan_harian.php">Laporan Harian</a>
          <a class="dropdown-item" href="laporan_bulanan.php">Laporan Bulanan</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pemilik</a>
        <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container py-5">
  <div class="form-inline justify-content-end mt-3">
    <div class="input-group date">
      <div class="input-group-addon">
           <span class="glyphicon glyphicon-th"><b>Bulan : &nbsp; </b></span>
      </div>
    <input type="text" class="form-control datepicker px-4" id="choosen-mth" autocomplete="off">
    <input class="btn btn-info px-4 mr-2 ml-1 btn-mth" type="button" value="Go"/>
    </div>
  </div>
  <div class="col text-center ">
    <h2 class="">Laporan Bulanan</h2>
  </div>
</div>

<div id="form-laporan">

</div>

<!-- Footer -->

</body>
</html>