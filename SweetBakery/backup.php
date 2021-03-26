<div class="">
<form action="" method="post">
    <h1 style="text-align:left;color: rgb(214, 13, 107)">Giỏ hàng</h1>
    <div class="row">
        <?php
        if($_SESSION['giohang']!= null)
        {
            $tongTien=0;
            foreach($_SESSION["giohang"] as $idx => $row)
            {
            
        ?>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <img src="<?php echo $row['hinhsp'] ?>" class="img-responsive" alt="Image">
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
            <!-- <hr width="100%"> -->
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4">
            <?php
                $tongTien+=$row['giasp']*$row['soluong'];
            }
            ?>
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
                    <input class="btn btn-success" type="button" value="Tiến hành thanh toán" name="btnThanhToan" id="" >
                </div>
            </div>
        </div>
        <?php
        }else
        {
        ?>
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 align="center">Giỏ hàng của bạn đang trống!</h4>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12" align="center">
            <a  class="btn btn-warning" href="index.php">Tiếp tục mua hàng</a>
        </div>
        <?php }?>
        
    </div>
</form>
</div>

<!-- chitiet_sp.php -->
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
                $exist=false;
                foreach($_SESSION['giohang'] as $idx =>$rowGH){
                    if($idx==$masp){
                        $_SESSION['giohang'][$idx]['soluong']+=$_POST['slMua'];
                        $exist=true;
                    }
                }
                if(!$exist){
                    $dathang = array(
                        "tensp" => $tensp,
                        "giasp" => $giasp,
                        "soluong" => $_POST['slMua'],
                        "hinhsp" => $hinhsp);
                    $_SESSION['giohang'][$masp]=$dathang;
                }
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

<!-- sanpham.php -->

<link rel="stylesheet" type="text/css" href="myStyle.css"/>

<?php
    include_once("connect.php");
    $sql_LSP="SELECT lsp_ma,lsp_ten FROM loaisanpham";
    $result_LSP=$conn->query($sql_LSP);

    function dathang($masp,$conn){
        $masp=$_GET['masp'];
        $sqlDH="SELECT * FROM sanpham WHERE sp_ma='$masp'";
        $resultDH=$conn->query($sqlDH);
        $rowDH=$resultDH->fetch_assoc();
        if($rowDH['sp_ma']>=1){// $rowDH[0] la sp_ma
            $exist=false;
            foreach($_SESSION['giohang'] as $idx =>$rowGH){
                if($idx==$masp){
                    $_SESSION['giohang'][$idx]['soluong']+=1;
                    $exist=true;
                }
            }
            if(!$exist){
                $tensp=$rowDH['sp_ten'];
                $giasp=$rowDH['sp_gia'];
                $hinhsp=$rowDH['sp_hinhanh'];

                $dathang = array(
                    "tensp" => $tensp,
                    "giasp" => $giasp,
                    "soluong" => 1,
                    "hinhsp" => $hinhsp);
                $_SESSION['giohang'][$masp]=$dathang;
                
            }
            echo "<script language='javascript'>alert('Sản phẩm đã được thêm vào giỏ hàng!');</script>";
            echo '<meta http-equiv="refresh" content="0;URL=?key=sanpham"/>';
        }
    }
    if(isset($_GET['func']) && isset($_GET['masp'])){
        $masp=$_GET['masp'];
        dathang($masp,$conn);
    }
?>
<div class="container">
    <div class="row">
        <div class=" col-sm-2 col-md-2 col-lg-2">
            <h4 class="tenDanhMucSP">CÁC DÒNG BÁNH</h4>
            <ul class="danhMucSP" style="list-style-type:none;">
            <?php
                while($row_LSP=$result_LSP->fetch_assoc()){
            ?>
                <li><a href="?key=sanpham&ma_lsp=<?php echo $row_LSP['lsp_ma']?>"> <?php echo $row_LSP['lsp_ten']?></a></li>
            <?php } ?>
            </ul>
        </div>
        
        <div class=" col-sm-10 col-md-10 col-lg-10">
            
            <div class="row">
                <?php
                    if(isset($_GET['ma_lsp'])){
                        $lsp=$_GET['ma_lsp'];
                        $sql_filter="SELECT sp_ma,sp_ten,sp_gia,sp_hinhanh FROM sanpham WHERE lsp_ma=$lsp";
                        $result_filter=$conn->query($sql_filter);
                        while($row_filter=$result_filter->fetch_assoc())
                        {
                    
                ?>
                <div class=" col-sm-3 col-md-3 col-lg-3 card" >
                    <a href="?key=chitiet_sp&ma_sp=<?php echo $row_filter['sp_ma']?>"><img width="100%" src="<?php echo $row_filter['sp_hinhanh'] ?>" alt="image"></a>
                    <h3 class="namecake"><?php echo $row_filter['sp_ten'] ?></h3>
                    <p class="price" ><?php echo number_format($row_filter['sp_gia']) ?> VND</p>
                    <a href="?func=dathang&masp=<?php echo $row_filter['sp_ma'] ?>"><button width="100%" >Thêm vào giỏ hàng</button></a>
                    
                </div>

                <?php 
                        }
                    }else{
                        $sql="SELECT sp_ma,sp_ten,sp_gia,sp_hinhanh FROM sanpham";
                        $result=$conn->query($sql);
                        while($row=$result->fetch_assoc())
                        {
                    
                 ?>

                <div class=" col-sm-3 col-md-3 col-lg-3 card" >
                    <a href="?key=chitiet_sp&ma_sp=<?php echo $row['sp_ma']?>"><img width="100%" src="<?php echo $row['sp_hinhanh'] ?>" alt="image"></a>
                    <h3 class="namecake"><?php echo $row['sp_ten'] ?></h3>
                    <p class="price" ><?php echo number_format($row['sp_gia']) ?> VND</p>
                    <a href="?key=sanpham&func=dathang&masp=<?php echo $row['sp_ma'] ?>"><button width="100%" >Thêm vào giỏ hàng</button></a>
                    <!--neu lsp_ma =# thì-->
                </div>
                <?php }}?>
            </div>   
        </div>
        
    </div>
</div>
