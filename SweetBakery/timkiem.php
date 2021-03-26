<?php
    include_once('connect.php');
    session_start();
    $str=$_REQUEST['str'];
    if($str!=""){
        $sql=" SELECT * FROM sanpham WHERE INSTR(sp_ten,'$str')>0";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<a href='index.php?key=chitiet_sp&ma_sp=".$row['sp_ma']."' 
                        style='text-decoration:none;color:rgb(248, 112, 70);'>".$row['sp_ten']." </a><span style='color:grey'>/</span> ";
            }
        }
    }
    
    
?>