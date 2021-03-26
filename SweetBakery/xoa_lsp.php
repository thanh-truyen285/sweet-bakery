<?php
include_once('connect.php');
    if(isset($_GET['ma_lsp'])){
        $ma=$_GET['ma_lsp'];

        $sqlSL="SELECT lsp_ma FROM sanpham WHERE lsp_ma=$ma";
        $resultSL=$conn->query($sqlSL);
        $rowSL=mysqli_fetch_array($resultSL,MYSQLI_ASSOC);
        if($ma==$rowSL['lsp_ma']){
            echo "<script>alert('Không thể xóa.Tồn tại sản phẩm thuộc loại sản phẩm này!')</script>";
            echo '<meta http-equiv="refresh" content="0;URL=index.php?key=quanly_lsp"/>';
        }else{
            $sql="DELETE FROM loaisanpham WHERE lsp_ma=$ma";
            $conn->query($sql);
            echo '<meta http-equiv="refresh" content="0;URL=index.php?key=quanly_lsp"/>';
        }
    }
?>