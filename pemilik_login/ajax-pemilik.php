<?php

    ob_start();
    $error=""; // Variable To Store Error Message
    $connection = mysqli_connect("localhost", "root", "", "hotel");
    
    $query_ind = $_POST['query_ind'];
    
    $html = "";

    //Query
    if($query_ind == "daily"){
        $tgl = $_POST['choosenDay'];

        $query = mysqli_query($connection, "SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rd.room_id = rb.room_id WHERE booking_dt = '$tgl' AND cancel_ind = 0 AND timeout_ind = 0 ");
        
        $rows = mysqli_num_rows($query);

        $html .= "<form method='post' class='container-fluid row justify-content-center container-fluid'>";
        $html .= "<table class='table table-outline table-hover col-md-8 mx-3 table-md'>";
        $html .= "<thead class='thead-light'><tr>";
        $html .= "<th>Booking ID</th>";
        $html .= "<th>No KTP</th>";
        $html .= "<th>Nama</th>";
        $html .= "<th>Type Kamar</th>";
        $html .= "<th>Checkin</th>";
        $html .= "<th>CheckOut</th>";
        $html .= "<th>Total Harga</th></tr></thead>";

        for($i=0;$i<$rows;$i++){
            $result = mysqli_fetch_assoc($query);
            $html .= "<tr><td>" .$result['booking_id']. "</td>";
            $html .= "<td>" .$result['no_ktp']. "</td>";
            $html .= "<td>" .$result['nama']. "</td>";
            $html .= "<td>" .$result['room_name']. "</td>";
            $html .= "<td>" .$result['chckin_dt']. "</td>";
            $html .= "<td>" .$result['chckout_dt']. "</td>";
            $html .= "<td>" .$result['total_price']. "</td></tr>";
        }

        $html .= "</table>";

        $html .= "<input class='col-sm-4 btn btn-lg btn-primary btn-block my-4 exportharian' type='submit' value='Download' name='exportharian'></input>";
        $html .= "</form>|";
        $html .= "FunctionOnLoad()";

        echo $html;
    }else if($query_ind == "monthly"){
        $tgl = $_POST['choosenMth'];
        
        $query = mysqli_query($connection, "SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rd.room_id = rb.room_id WHERE DATE_FORMAT(booking_dt,'%Y-%m') = '$tgl' AND cancel_ind = 0 AND timeout_ind = 0 ");
        
        $rows = mysqli_num_rows($query);

        $html .= "<form method='post' class='container-fluid row justify-content-center container-fluid'>";
        $html .= "<table class='table table-outline table-hover col-md-8 mx-3 table-md'>";
        $html .= "<thead class='thead-light'><tr>";
        $html .= "<th>Booking ID</th>";
        $html .= "<th>No KTP</th>";
        $html .= "<th>Nama</th>";
        $html .= "<th>Type Kamar</th>";
        $html .= "<th>Checkin</th>";
        $html .= "<th>CheckOut</th>";
        $html .= "<th>Total Harga</th></tr></thead>";

        for($i=0;$i<$rows;$i++){
            $result = mysqli_fetch_assoc($query);
            $html .= "<tr><td>" .$result['booking_id']. "</td>";
            $html .= "<td>" .$result['no_ktp']. "</td>";
            $html .= "<td>" .$result['nama']. "</td>";
            $html .= "<td>" .$result['room_name']. "</td>";
            $html .= "<td>" .$result['chckin_dt']. "</td>";
            $html .= "<td>" .$result['chckout_dt']. "</td>";
            $html .= "<td>" .$result['total_price']. "</td></tr>";
        }

        $html .= "</table>";
        $html .= "<input class='col-sm-4 btn btn-lg btn-primary btn-block my-4 exportharian' type='submit' value='Download' name='exportharian'></input>";
        $html .= "</form>|";
        $html .= "FunctionOnLoad()";
        
        echo $html;
    }
?>