<?php

    ob_start();
    $error=""; // Variable To Store Error Message
    $connection = mysqli_connect("localhost", "root", "", "hotel");
    $txInd = $_POST['txInd'];

    if($txInd == "room-price"){
        $roomId = $_POST['roomId'];        
        //Query
        $query = mysqli_query($connection, "SELECT * FROM room_dim WHERE room_id = '$roomId'");
        $rows = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);

        $response = $data['room_price'];
        $response .= "|";
        $response .= $data['room_avail'];
        if($rows > 0){
            echo $response;
        }else{
            echo "0";
        }
    }else if($txInd == "book-ind"){
        $noKtp = $_POST['noKtp'];
        $nama = $_POST['nama'];
        $noHp = $_POST['noHP'];
        $email = $_POST['email'];
        $roomId = $_POST['roomId'];
        $chckinDt = $_POST['chckin_dt'];
        $chckoutDT = $_POST['chckout_dt'];
        $total = $_POST['total'];

        $query = mysqli_query($connection, "INSERT INTO room_book(no_ktp, nama, no_hp, email, room_id, chckin_dt, chckout_dt, total_price, paid_ind, user_paid_ind, chckout_ind) VALUES('$noKtp','$nama','$noHp','$email','$roomId','$chckinDt','$chckoutDT','$total',0,0,0)");

        $query_room = mysqli_query($connection, "SELECT * FROM room_dim WHERE room_id = '$roomId'");
        $data_room = mysqli_fetch_array($query_room);

        $avail = $data_room['room_avail'] - 1;

        $query = mysqli_query($connection, "UPDATE room_dim SET room_avail = '$avail' WHERE room_id = '$roomId'");

        $query_book= mysqli_query($connection, "SELECT max(booking_id) as max_id FROM room_book");
        $data_book = mysqli_fetch_array($query_book);
        $current_id = $data_book['max_id'];

        echo $current_id;
    }else if($txInd == "updt-user-paid-ind"){
        $current_id = $_POST['current_id'];

        $query = mysqli_query($connection, "UPDATE room_book SET user_paid_ind = 1 WHERE booking_id = '$current_id'");
    }
    
?>