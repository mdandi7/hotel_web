<?php

    ob_start();
    $error=""; // Variable To Store Error Message
    $connection = mysqli_connect("localhost", "root", "", "hotel");
    $txInd = $_POST['txInd'];
    $rsp=""; //Variable to store the response

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
    }else if($txInd == "select-room"){
        $roomID = $_POST['roomID'];

        $query = mysqli_query($connection, "SELECT * FROM room_dim WHERE room_id = '$roomID'");
        $data = mysqli_fetch_array($query);
        
        $rsp .= $data['room_avail'] . "|";
        $rsp .= $data['room_total'] . "|";
        $rsp .= $data['room_price'];

        echo $rsp;
    }else if($txInd == "update-room"){
        $roomID = $_POST['roomID'];
        $rmTotal = $_POST['rmTotal'];
        $price = $_POST['price'];

        $query = mysqli_query($connection, "UPDATE room_dim SET room_price = '$price', room_total = '$rmTotal' WHERE room_id = '$roomID'");
    }else if($txInd == "book-page"){
        $query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id WHERE user_paid_ind = 1 AND paid_ind = 0 and chckout_ind = 0 and cancel_ind = 0");
        $rows = mysqli_num_rows($query);

        for($i=0;$i<$rows;$i++){
            $result = mysqli_fetch_assoc($query);
            $rsp .= "<tr><td>" .$result['no_ktp']. "</td>";
            $rsp .= "<td>" .$result['nama']. "</td>";
            $rsp .= "<td>" .$result['room_name']. "</td>";
            $rsp .= "<td>" .$result['total_price']. "</td>";
            $rsp .= "<td>" .$result['chckin_dt']. "</td>";
            $rsp .= "<td>" .$result['chckout_dt']. "</td>";
            $rsp .= "<td><input data-id='" .$result['booking_id']. "'class='button-confirm btn btn-md btn-primary btn-info btn-block' type='submit' value='Confirm'></tr>";
        }

        $rsp .= "|";
        $query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id WHERE user_paid_ind = 1 AND paid_ind = 1 AND cancel_ind = 0 AND chckout_ind = 0");
        $rows = mysqli_num_rows($query);

        for($i=0;$i<$rows;$i++){
            $result = mysqli_fetch_assoc($query);
            $rsp .= "<tr><td>" .$result['no_ktp']. "</td>";
            $rsp .= "<td>" .$result['nama']. "</td>";
            $rsp .= "<td>" .$result['room_name']. "</td>";
            $rsp .= "<td>" .$result['total_price']. "</td>";
            $rsp .= "<td>" .$result['chckin_dt']. "</td>";
            $rsp .= "<td>" .$result['chckout_dt']. "</td></tr>";
        }

        $rsp .= "|";
        $query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id WHERE chckout_ind = 0 AND cancel_ind = 0 AND chckout_dt <= now()");
        $rows = mysqli_num_rows($query);

        for($i=0;$i<$rows;$i++){
            $result = mysqli_fetch_assoc($query);
            $rsp .= "<tr><td>" .$result['no_ktp']. "</td>";
            $rsp .= "<td>" .$result['nama']. "</td>";
            $rsp .= "<td>" .$result['room_name']. "</td>";
            $rsp .= "<td>" .$result['total_price']. "</td>";
            $rsp .= "<td>" .$result['chckin_dt']. "</td>";
            $rsp .= "<td>" .$result['chckout_dt']. "</td>";
            $rsp .= "<td><input data-id='" .$result['booking_id']. "' data-room='" .$result['room_id']. "' class='btn-confirm-ckout btn btn-md btn-primary btn-info btn-block' type='submit' value='Confirm-CheckOut'></tr>";
        }

        $rsp .= "|";
        $query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id WHERE chckout_ind = 0 AND chckin_ind = 0 AND paid_ind = 1 AND user_paid_ind = 1 AND cancel_ind = 0 AND timeout_ind = 0 AND chckout_dt >= now()");
        $rows = mysqli_num_rows($query);

        for($i=0;$i<$rows;$i++){
            $result = mysqli_fetch_assoc($query);
            $rsp .= "<tr><td>" .$result['no_ktp']. "</td>";
            $rsp .= "<td>" .$result['nama']. "</td>";
            $rsp .= "<td>" .$result['room_name']. "</td>";
            $rsp .= "<td>" .$result['total_price']. "</td>";
            $rsp .= "<td>" .$result['chckin_dt']. "</td>";
            $rsp .= "<td>" .$result['chckout_dt']. "</td>";
            $rsp .= "<td><input data-id='" .$result['booking_id']. "' data-room='" .$result['room_id']. "' class='btn-confirm-ckin btn btn-md btn-primary btn-info btn-block' type='submit' value='Confirm-CheckIn'></tr>";
        }

        echo $rsp;
    }else if($txInd == "confirm-book"){
        $bookId = $_POST['bookId'];

        $query = mysqli_query($connection, "UPDATE room_book SET paid_ind = 1 WHERE booking_id = '$bookId'");
    }else if($txInd == "confirm-ckout"){
        $bookId = $_POST['bookId'];
        $roomId = $_POST['roomId'];

        $query = mysqli_query($connection, "UPDATE room_book SET chckout_ind = 1 WHERE booking_id = '$bookId'");

        $query = mysqli_query($connection, "SELECT * FROM room_dim WHERE room_id = '$roomId'");
        $result = mysqli_fetch_assoc($query);
        $roomAvail = $result['room_avail'] + 1;

        $query = mysqli_query($connection, "UPDATE room_dim SET room_avail = '$roomAvail' WHERE room_id = '$roomId'");        

    }else if($txInd == "search-ktp"){
        $ktpNum = $_POST['ktpNum'];
        $query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id WHERE no_ktp = '$ktpNum'");
        $rows = mysqli_num_rows($query);

        if($rows > 0 ){
            for($i=0;$i<$rows;$i++){
                $result = mysqli_fetch_assoc($query);
                $status = "";

                if($result['paid_ind'] == '1' and $result['user_paid_ind'] == '1'){
                    $status = "Success";
                }else{
                    $status = "Pending";
                }
                $rsp .= "<tr><td>" .$result['no_ktp']. "</td>";
                $rsp .= "<td>" .$result['nama']. "</td>";
                $rsp .= "<td>" .$result['room_name']. "</td>";
                $rsp .= "<td>" .$result['total_price']. "</td>";
                $rsp .= "<td>" .$result['chckin_dt']. "</td>";
                $rsp .= "<td>" .$result['chckout_dt']. "</td>";
                $rsp .= "<td>" .$status. "</tr>";
            }
        }else{
            $rsp .= "<tr><td colspan='7'>No KTP tidak pernah melakukan transaksi</td></tr>";
        }

        echo $rsp;
    }else if($txInd == "guest-page"){
        $query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id");
        $rows = mysqli_num_rows($query);

        if($rows > 0 ){
            for($i=0;$i<$rows;$i++){
                $result = mysqli_fetch_assoc($query);
                $status = "";

                if($result['paid_ind'] == '1' and $result['user_paid_ind'] == '1'){
                    $status = $result['total_price'];
                }else{
                    $status = "Pending";
                }
                $rsp .= "<tr><td>" .$result['no_ktp']. "</td>";
                $rsp .= "<td>" .$result['nama']. "</td>";
                $rsp .= "<td>" .$result['no_hp']. "</td>";
                $rsp .= "<td>" .$result['email']. "</td>";
                $rsp .= "<td>" .$result['room_name']. "</td>";
                $rsp .= "<td>" .$result['chckin_dt']. "</td>";
                $rsp .= "<td>" .$result['chckout_dt']. "</td>";
                $rsp .= "<td>" .$status. "</tr>";
            }
        }else{
            $rsp .= "<tr><td colspan='7'>Belum ada Tamu</td></tr>";
        }

        echo $rsp;
    }else if($txInd == "search-guest-page"){
        $ktpNum = $_POST['ktpNum'];
        $query = mysqli_query($connection,"SELECT * FROM room_book rb LEFT JOIN room_dim rd ON rb.room_id = rd.room_id WHERE no_ktp = '$ktpNum'");
        $rows = mysqli_num_rows($query);

        if($rows > 0 ){
            for($i=0;$i<$rows;$i++){
                $result = mysqli_fetch_assoc($query);
                $status = "";

                if($result['paid_ind'] == '1' and $result['user_paid_ind'] == '1'){
                    $status = $result['total_price'];
                }else{
                    $status = "Pending";
                }
                $rsp .= "<tr><td>" .$result['no_ktp']. "</td>";
                $rsp .= "<td>" .$result['nama']. "</td>";
                $rsp .= "<td>" .$result['no_hp']. "</td>";
                $rsp .= "<td>" .$result['email']. "</td>";
                $rsp .= "<td>" .$result['room_name']. "</td>";
                $rsp .= "<td>" .$result['chckin_dt']. "</td>";
                $rsp .= "<td>" .$result['chckout_dt']. "</td>";
                $rsp .= "<td>" .$status. "</tr>";
            }
        }else{
            $rsp .= "<tr><td colspan='7'>No KTP tidak pernah melakukan transaksi</td></tr>";
        }

        echo $rsp;
    }else if($txInd == "insert-pegawai"){
        $nip = $_POST['nip'];
        $namapegawai = $_POST['namapegawai'];
        $jeniskelamin = $_POST['jeniskelamin'];
        $tgllahir = $_POST['tgllahir'];
        $alamat = $_POST['alamat'];

        $query = mysqli_query($connection, "SELECT * FROM pegawai WHERE NIP = '$nip'");
        $rows = mysqli_num_rows($query);

        if($rows > 0){
            $rsp .= "Nomer NIP Telah terdaftar";
        }else{
            $query_insert = mysqli_query($connection, "INSERT INTO pegawai(nip,nama_pegawai,jenis_kelamin,tgl_lahir,alamat) VALUES('$nip','$namapegawai','$jeniskelamin','$tgllahir','$alamat')");
            $rsp .= "Pegawai berhasil didaftarkan";
        }

        echo $rsp;

    }else if($txInd == "pegawai-page"){
        $query = mysqli_query($connection,"SELECT * FROM pegawai");
        $rows = mysqli_num_rows($query);

        if($rows > 0 ){
            for($i=0;$i<$rows;$i++){
                $result = mysqli_fetch_assoc($query);
                $rsp .= "<tr><td>" .$result['NIP']. "</td>";
                $rsp .= "<td>" .$result['nama_pegawai']. "</td>";
                $rsp .= "<td>" .$result['jenis_kelamin']. "</td>";
                $rsp .= "<td>" .$result['tgl_lahir']. "</td>";
                $rsp .= "<td>" .$result['alamat']. "</td>";
                $rsp .= "<td><input data-id='" .$result['NIP']. "' class='btn-delete-pgw btn btn-md btn-primary btn-info btn-block' type='submit' value='Delete'></tr>";
            }
        }else{
            $rsp .= "<tr><td colspan='5'>Belum ada pegawai</td></tr>";
        }

        echo $rsp;
    }else if($txInd == "pegawai-page-search"){
        $nip = $_POST['nip'];
        $query = mysqli_query($connection,"SELECT * FROM pegawai WHERE nip = '$nip'");
        $rows = mysqli_num_rows($query);

        if($rows > 0 ){
            for($i=0;$i<$rows;$i++){
                $result = mysqli_fetch_assoc($query);
                $rsp .= "<tr><td>" .$result['NIP']. "</td>";
                $rsp .= "<td>" .$result['nama_pegawai']. "</td>";
                $rsp .= "<td>" .$result['jenis_kelamin']. "</td>";
                $rsp .= "<td>" .$result['tgl_lahir']. "</td>";
                $rsp .= "<td>" .$result['alamat']. "</td>";
                $rsp .= "<td><input data-id='" .$result['NIP']. "' class='btn-delete-pgw btn btn-md btn-primary btn-info btn-block' type='submit' value='Delete'></tr>";
            }
        }else{
            $rsp .= "<tr><td colspan='5'>NIP Tidak terdaftar</td></tr>";
        }

        echo $rsp;
    }else if($txInd == "pegawai-delete"){
        $nip = $_POST['nip'];
        $query = mysqli_query($connection,"DELETE FROM pegawai WHERE nip = '$nip'");
    }else if($txInd == "confirm-chckin-bt"){
        $bkCd = $_POST['bkCd'];
        
        $query = mysqli_query($connection,"UPDATE room_book SET chckin_ind = 1 WHERE booking_id = '$bkCd'");
    }
    
?>