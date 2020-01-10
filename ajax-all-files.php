<?php

    ob_start();
    $error=""; // Variable To Store Error Message
    $connection = mysqli_connect("localhost", "root", "", "hotel");
    $txInd = $_POST['tx-ind'];

    if($txInd == "room-price"){
        $roomId = $_POST['roomId'];        
        //Query
        $query = mysqli_query($connection, "SELECT * FROM room_dim WHERE room_id = '$roomId'");
        $rows = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);

        if($rows > 0){
            echo $data['room_price'];
        }else{
            echo "0";
        }
    }
    
?>