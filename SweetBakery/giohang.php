

<?php
    include_once("connect.php");

    if(isset($_GET['action'])){
        if($_GET['action']=='xoa'){
            $indx=$_GET['idx'];
            unset($_SESSION['giohang'][$indx]);
            echo '<meta http-equiv="refresh" content="0;URL=?key=giohang"/>';
        }
    }
    if(isset($_POST['btnThanhToan'])){
        if(isset($_SESSION['txtTenDangNhap'])){
            foreach($_SESSION['giohang'][$idx] as $index => $row){
                $_SESSION['giohang'][$index]['soluong']=$_POST['SP' . $index];
            }
            echo "<script>window.location='?key=thanhtoan';</script>";
        }else{
            echo "<script>alert('Vui lòng đăng nhập trước khi thanh toán!');</script>";
            echo "<script>window.location='?key=dangnhap';</script>";
        }
    }
?>
<div class="">
<form action="" method="post">
    <h1 style="text-align:left;color: rgb(214, 13, 107)">Giỏ hàng</h1>
    <div class="row">
        
        <div class="col-sm-8 col-md-8 col-lg-8">
            <?php
            if($_SESSION['giohang']!= null)
            {
                $tongTien=0;
                foreach($_SESSION["giohang"] as $idx => $row)
                {
            
            ?>
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <a href="index.php?key=chitiet_sp&ma_sp=<?php echo $idx?>"><img src="<?php echo $row['hinhsp'] ?>" class="img-responsive" alt="Image"></a>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <h3><?php echo $row['tensp'] ?></h3>
                    <p>Giá: <?php echo number_format($row['giasp']) ?></p>
                    <p> Số lượng: <?php echo $row['soluong'] ?></p>
                    <a href="?key=giohang&action=xoa&idx=<?php echo $idx ?>" onclick="return deleteConfirm()">
                        Xóa
                    </a>
                </div>
            </div>
            <hr>    
            <?php
                $tongTien+=$row['giasp']*$row['soluong'];
            }
            ?>
        </div>
            
        <div class="col-sm-4 col-md-4 col-lg-4">
            
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    Thành tiền
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <?php echo number_format($tongTien) ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <hr>
                    <input class="btn btn-success" type="submit" value="Tiến hành thanh toán" name="btnThanhToan" id="" >
                </div>
            </div>
        </div>
        <?php
        }else
        {
        ?>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <h4 align="center">Giỏ hàng của bạn đang trống!</h4>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12" align="center">
        <a  class="btn btn-warning" href="?key=sanpham">Tiếp tục mua hàng</a>
    </div>
        <?php }?>
</form>
</div>
<script>
function deleteConfirm() {
    if (confirm("Bạn có chắc chắn muốn xóa!")) {
        return true;
    } else {
        return false;
    }
}
</script>