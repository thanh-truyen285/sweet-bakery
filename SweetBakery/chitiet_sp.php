<?php
    include_once('connect.php');
    if(isset($_GET['ma_sp'])){

        $masp=$_GET['ma_sp'];
        $sql="SELECT sp_ten,sp_gia,sp_chitiet,sp_ngaycapnhat,sp_hinhanh,lsp_ten 
              FROM sanpham s JOIN loaisanpham l ON s.lsp_ma=l.lsp_ma
              WHERE sp_ma=$masp";
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc()){
            $tensp=$row['sp_ten'];
            $giasp=$row['sp_gia'];
            $hinhsp=$row['sp_hinhanh'];
            $motasp=$row['sp_chitiet'];
            $ngaycapnhatsp=$row['sp_ngaycapnhat'];
            $tenlsp=$row['lsp_ten'];
        }
        if(isset($_POST['btnAddCart'])){
            $sqlSoLuong="SELECT sp_soluong FROM sanpham WHERE sp_ma='$masp'";//Số lượng có trong kho sản phẩm
            $resultSoLuong=$conn->query($sqlSoLuong);
            $SoLuong=$resultSoLuong->fetch_assoc();
            if($SoLuong['sp_soluong']>= $_POST['slMua']){
                // $exist=false;
                // foreach($_SESSION['giohang'] as $idx =>$rowGH){
                //     if($idx==$masp){
                //         $_SESSION['giohang'][$idx]['soluong']+=$_POST['slMua'];
                //         $exist=true;
                //     }
                // }
                // if(!$exist){
                    $dathang = array(
                        "tensp" => $tensp,
                        "giasp" => $giasp,
                        "soluong" => $_POST['slMua'],
                        "hinhsp" => $hinhsp);
                    $_SESSION['giohang'][$masp]=$dathang;
                // }
                echo "<script language='javascript'>
				       alert('Sản phẩm đã được thêm vào giỏ hàng, truy cập giỏ hàng để xem!'); 
					  window.location=window.location; 
					   </script>";
                // echo "<script language='javascript'>alert('Sản phẩm đã được thêm vào giỏ hàng!');</script>";
                echo '<meta http-equiv="refresh" content="0;URL=?key=chitiet_sp"/>';
            }else{
                echo "<script>alert('Số lượng bạn đặt vượt quá số lượng chúng tôi hiện có!');</script>";
            }
        }
    } 
    
?>
<div class="row">

    <div class="col-sm-2 col-md-2 col-lg-2">
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3">
        <img src="<?php echo $hinhsp ?>" class="img-responsive" alt="Image">
        
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6">
        <h1 style="margin-top:0px;"><?php echo $tensp  ?></h1>
        <h3>Giá: <?php echo number_format($giasp) ?> VND</h3>
        <br>
        <p>Mô tả: <?php echo $motasp  ?></p>
        <p> Ngày cập nhật: <?php echo $ngaycapnhatsp ?></p>
        <p> Loại sản phẩm: <?php echo $tenlsp ?></p><br>
        <form action="" method="post" name="formDH">
            Số lượng: <input type="number" name="slMua" id="slMua" min="1" max="999" size="3" value="1"
                style="text-align:center"> <br><br>
            
                <input type="submit" class="btn btn-danger" name="btnAddCart" value="Thêm vào giỏ hàng">
            
        </form>
    </div>

</div>