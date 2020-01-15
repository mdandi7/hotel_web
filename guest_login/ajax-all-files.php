<?php

    ob_start();
    $error=""; // Variable To Store Error Message
    $connection = mysqli_connect("localhost", "root", "", "hotel");
    $txInd = $_POST['txInd'];
    $rsp = "";

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
        $bkTime = $_POST['bkTime'];
        $tglToday = $_POST['tglToday'];

        $query = mysqli_query($connection, "INSERT INTO room_book(no_ktp, nama, no_hp, email, room_id, chckin_dt, chckout_dt, total_price, paid_ind, user_paid_ind, chckout_ind, cancel_ind, timeout_ind, booking_time, booking_dt) VALUES('$noKtp','$nama','$noHp','$email','$roomId','$chckinDt','$chckoutDT','$total',0,0,0,0,1,'$bkTime','$tglToday')");

        $query_room = mysqli_query($connection, "SELECT * FROM room_dim WHERE room_id = '$roomId'");
        $data_room = mysqli_fetch_array($query_room);

        $avail = $data_room['room_avail'] - 1;

        //$query = mysqli_query($connection, "UPDATE room_dim SET room_avail = '$avail' WHERE room_id = '$roomId'");

        $query_book= mysqli_query($connection, "SELECT max(booking_id) as max_id FROM room_book");
        $data_book = mysqli_fetch_array($query_book);
        $current_id = $data_book['max_id'];

        $query_book_get= mysqli_query($connection, "SELECT *, addtime(booking_time,010000) as book_time_interval FROM room_book where booking_id = '$current_id'");
        $data_book_get = mysqli_fetch_array($query_book_get);

        echo $current_id . "|" . $data_book_get['booking_dt'] . "|" . $data_book_get['book_time_interval'] . "|" . $roomId;
    }else if($txInd == "updt-user-paid-ind"){
        $current_id = $_POST['current_id'];
        $current_room = $_POST['current_room'];

        $query = mysqli_query($connection, "UPDATE room_book SET user_paid_ind = 1,timeout_ind = 0 WHERE booking_id = '$current_id'");

        $query_room = mysqli_query($connection, "SELECT * FROM room_dim WHERE room_id = '$current_room'");
        $data_room = mysqli_fetch_array($query_room);

        $avail = $data_room['room_avail'] - 1;

        $query = mysqli_query($connection, "UPDATE room_dim SET room_avail = '$avail' WHERE room_id = '$current_room'");
    }else if($txInd == "book-cancel"){
        $bkCode = $_POST['bkCode'];


        $query_book = mysqli_query($connection, "SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id WHERE booking_id = '$bkCode'");
        $rows = mysqli_num_rows($query_book);
        

        if($rows > 0 ){
            for($i=0;$i<$rows;$i++){
                $cancel_st = "";
                $result = mysqli_fetch_array($query_book);

                if($result['cancel_ind'] == 1){
                    $cancel_st = "<td>Canceled</tr></tr>";
                }elseif($result['chckout_ind'] == 1){
                    $cancel_st = "<td>Check Out</tr></tr>";
                }elseif($result['timeout_ind'] == 1 && $result['user_paid_ind'] == 0){
                    $cancel_st = "<td>Pembayaran Pending / Timeout</tr></tr>";
                }else{
                    $cancel_st = "<td><input data-id='" .$result['booking_id']. "' class='btn-cancel-book btn btn-md btn-primary btn-info btn-block' type='submit' value='Cancel'></tr>";
                }

                
                $rsp .= "<tr><td>" .$result['booking_id']. "</td>";
                $rsp .= "<td>" .$result['nama']. "</td>";
                $rsp .= "<td>" .$result['no_hp']. "</td>";
                $rsp .= "<td>" .$result['room_name']. "</td>";
                $rsp .= "<td>" .$result['chckin_dt']. "</td>";
                $rsp .= "<td>" .$result['chckout_dt']. "</td>";
                $rsp .= $cancel_st;
            }
        }else{
            $rsp .= "<tr><td colspan='5'>Code Booking Tidak Terdafatar</td></tr>";
        }

        echo $rsp;

    }else if($txInd == "cancel-bookcd"){
        $bkCode = $_POST['bkCd'];


        $query_book = mysqli_query($connection, "UPDATE room_book SET cancel_ind = 1 WHERE booking_id = '$bkCode'");
    }
    
?>