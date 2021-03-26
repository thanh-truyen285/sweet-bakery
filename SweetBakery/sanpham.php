
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
        if($rowDH['sp_soluong'] >=1 ){// $rowDH[0] la sp_ma
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
        else{
            echo "<script language='javascript'>alert('Không đủ số lượng!');</script>";
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
                    <a href="?key=sanpham&func=dathang&masp=<?php echo $row_filter['sp_ma'] ?>"><button width="100%" >Thêm vào giỏ hàng</button></a>
                    
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
