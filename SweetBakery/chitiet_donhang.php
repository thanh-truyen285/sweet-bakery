
<?php
  include_once('connect.php');
    $ma=$_GET['mahd'];
?>

<div class="container">
<form action="" method="post">
	<h2 style="text-align: center;color:rgb(214, 13, 107);font-weight: bold;">Chi tiết đơn hàng</h2>
	<br><br>
    <div class="table-responsive">          
        <table id="bangSP" class="table table-hover" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Hình sản phẩm</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sqlct="SELECT s.sp_ten, c.cthd_soluong, c.cthd_dongia, s.sp_hinhanh
                          FROM sanpham s JOIN chitiethoadon c ON s.sp_ma=c.sp_ma JOIN hoadon h ON c.hd_ma=h.hd_ma
                          WHERE c.hd_ma=$ma";
                    $resultct=$conn->query($sqlct);
                    /* Bắt lỗi
                     if($resultct === false){
                        throw new Exception(mysqli_error($conn));
                    }*/
                    $stt=0;
                    $tong=0;
                    while($row=mysqli_fetch_array($resultct,MYSQLI_ASSOC)){
                        
                        $stt++;
                ?>
                <tr>
                    <td><?php echo $stt; ?></td>
                    <td><?php echo $row['sp_ten']?></td>
                    <td><?php echo $row['cthd_soluong'] ?></td>
                    <td><?php echo $row['cthd_dongia'] ?></td>
                    <td><img src="<?php  echo $row['sp_hinhanh']?>" alt="images" width="75px"></td>
                </tr>
                    <?php  $tong+=$row['cthd_soluong']*$row['cthd_dongia']; }
                     ?>
                
            </tbody>
	    </table>
        <h4 style="color:red;text-align:right;font-weight:bold;">Tổng tiền : <?php  echo number_format($tong); ?> VND</h4>
    </div>
</form>
<a href="index.php?key=quanly_donhang" style="text-align:center"> << Quay lại </a>
</div>