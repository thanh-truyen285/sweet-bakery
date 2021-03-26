<?php
    include_once('connect.php');
    if(isset($_POST['btnXoaNhieu'])  && isset($_POST['chkXoa'])){
        for($i = 0; $i < count($_POST['chkXoa']);  $i++){
            $masp=$_POST['chkXoa'][$i];
            $sql="DELETE FROM sanpham WHERE sp_ma='$masp'";
            $conn->query($sql);
            echo '<meta http-equiv="refresh" content="0;URL=quanly_sp.php"/>';
        }
    }
?>