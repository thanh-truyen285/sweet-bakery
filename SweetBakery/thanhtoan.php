
<?php
include_once('connect.php');

    function HTTTList($conn) 
    {
         $query = "select httt_ma, httt_ten from hinhthucthanhtoan";
         $result = $conn->query($query);
         echo "<select name='slHttt'>";
         while ($row =$result->fetch_assoc()) 
         {
               echo "<option value='" . $row['httt_ma'] . "'>" . $row['httt_ten'] . "</option>";
         }
         echo "</select>";
     }

     if(isset($_POST['btnCapNhat'])){
         $noigiao=$_POST['txtNoiGiaoHang'];
         $ngaygiao=$_POST['txtNgayGiaoHang'];
         $httt=$_POST['slHttt'];
         $sql="INSERT INTO hoadon (hd_ngaylap,hd_ngaygiao,hd_noigiao,hd_trangthaithanhtoan,httt_ma,tv_tendangnhap)
               VALUES (now(),'$ngaygiao','$noigiao',0,'$httt','".$_SESSION['txtTenDangNhap']."')";
        $conn->query($sql);
        //Lấy mã hóa đơn vừa insert vào
        $mahd=mysqli_insert_id($conn);
        //Lấy từng sản phẩm trong giỏ hàng đưa vào csdl( chitiethoadon)
        foreach($_SESSION['giohang'] as $idx => $row){
            $sql="INSERT INTO chitiethoadon (hd_ma,sp_ma,cthd_soluong,cthd_dongia)
                  VALUES (".$mahd.",".$idx.",".$row['soluong'].",".$row['giasp'].")";
            $conn->query($sql);
            //Update so luong trong kho
            $sqlUpdateSL="UPDATE sanpham SET sp_soluong=sp_soluong-".$row['soluong']." WHERE sp_ma=".$idx;
            $conn->query($sqlUpdateSL);
        }
        //Xoa sản phẩm ra giỏ hàng sau khi thêm vào csdl
        unset($_SESSION["giohang"]);
        //Thông báo đã ghi nhận đơn hàng thành công
        echo "<script>alert('Đơn hàng đã được ghi nhận, chúng tôi sẽ sớm xác nhận thanh toán với bạn!');</script>";
		echo "<script>window.location='index.php';</script>";
     }
    $tendn=$_SESSION['txtTenDangNhap'];
    $sqlSelect="SELECT tv_diachi FROM thanhvien WHERE tv_tendangnhap='$tendn'";
    $rsSelect=$conn->query($sqlSelect) or die($conn->error);
    while($rowSelect=$rsSelect->fetch_assoc()){
        $diachi=$rowSelect['tv_diachi'];
    }
?>
<div class="container">
    <form action="" method="post" name="formThanhToan">
        <h1>Thanh toán giỏ hàng</h1>
        <div class="form-group">
            <label for="lblNoiGiaoHang" class="col-sm-2 control-label">Nơi giao hàng: </label>
            <div class="col-sm-10">
                <input type="text" name="txtNoiGiaoHang" id="txtNoiGiaoHang" class="form-control"
                    placeholder="Nhập nơi giao hàng ....." value="<?php echo $diachi?>" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="lblNgayGiaoHang" class="col-sm-2 control-label">Ngày giao hàng: </label>
            <div class="col-sm-10">
                <input name="txtNgayGiaoHang" id="txtNgayGiaoHang" type='date' class="form-control" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="lblHinhThucThanhToan" class="col-sm-2 control-label">Hình thức thanh toán: </label>
            <div class="col-sm-10">
                <?php HTTTList($conn) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <br><input type="submit" name="btnCapNhat" class="btn btn-warning" id="btnCapNhat" value="Thanh toán" />
                <input name="btnBoQua" type="button" class="btn btn-default" id="btnBoQua" value="Bỏ qua"
                    onclick="window.location='index.php?key=giohang'" /> <br>
                
            </div>
        </div>
    </form>
</div>