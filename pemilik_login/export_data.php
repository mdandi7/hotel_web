	<?php
    ob_start();
    $error=""; // Variable To Store Error Message
    $connection = mysqli_connect("localhost", "root", "", "hotel");

    $download_ind = $_GET["download_ind"];
    

	if($download_ind == "daily"){
		@header("Content-Disposition: attachment; filename=laporan_harian.csv");

		$tgl=$_GET["data"];

		$query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rd.room_id = rb.room_id WHERE booking_dt = '$tgl' AND cancel_ind = 0 AND timeout_ind = 0");
		$data = "";
		$data.="Booking ID,";
		$data.="No KTP,";
		$data.="Nama,";
		$data.="Type Kamar,";
		$data.="Checkin,";
		$data.="CheckOut,";
		$data.="Harga \n";
		 while($row=mysqli_fetch_assoc($query))
		 {
		  $data.=$row['booking_id'].",";
		  $data.=$row['no_ktp'].",";
		  $data.=$row['nama'].",";
		  $data.=$row['room_name'].",";
		  $data.=$row['chckin_dt'].",";
		  $data.=$row['chckout_dt'].",";
		  $data.=$row['total_price']."\n";
		 }

		 echo $data;
 		exit();
		}

		if($download_ind == "monthly"){
		@header("Content-Disposition: attachment; filename=laporan_bulanan.csv");

		$tgl=$_GET["data"];

		$query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rd.room_id = rb.room_id WHERE DATE_FORMAT(booking_dt,'%Y-%m') = '$tgl' AND cancel_ind = 0 AND timeout_ind = 0");
		$data = "";
		$data.="Booking ID,";
		$data.="No KTP,";
		$data.="Nama,";
		$data.="Type Kamar,";
		$data.="Checkin,";
		$data.="CheckOut,";
		$data.="Harga \n";
		 while($row=mysqli_fetch_assoc($query))
		 {
		  $data.=$row['booking_id'].",";
		  $data.=$row['no_ktp'].",";
		  $data.=$row['nama'].",";
		  $data.=$row['room_name'].",";
		  $data.=$row['chckin_dt'].",";
		  $data.=$row['chckout_dt'].",";
		  $data.=$row['total_price']."\n";
		 }
		 
		 echo $data;
 		exit();
		}

?>