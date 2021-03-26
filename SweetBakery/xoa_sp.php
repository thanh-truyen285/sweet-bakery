<?php
include_once('connect.php');
    if(isset($_GET['masp'])){
        $ma=$_GET['masp'];
        $sql="DELETE FROM sanpham WHERE sp_ma='$ma'";
        $conn->query($sql);
        echo '<meta http-equiv="refresh" content="0;URL=index.php?key=quanly_sp"/>';
    }
?>