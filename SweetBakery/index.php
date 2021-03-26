<?php session_start();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="bánh ngọt,cupcake,bánh kem, các loại bánh" />
    <!--Từ khòa tìm kiếm tren google-->
    <meta name="description" content="" />
    <!--Mô tả bài viết-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--thiet dat che do xem trang phu hop voi thiet bi-->

    <title>Cửa hàng bánh ngọt - Sweet Bakery</title>
    <link rel="stylesheet" type="text/css" href="myStyle.css"/>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--them favicon vao website (bieu tuong cho website)-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <?php
    include_once("connect.php");
    
    if(!isset($_SESSION['giohang'])){
        $_SESSION['giohang'] = array();// Tạo giỏ hàng rỗng khi vừa truy cập
    }
?>
    <div class="container-fluid">
        <div class="row banner">
            <!--banner-->
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 logo">
                <img src="images/symboll.png" class="" alt="Image">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 namestore">
                <a href="index.php">
                    <h1>SWEET BAKERY</h1>
                </a>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 search">
                <!-- <form> -->
                    <input class="form-control" type="text" placeholder="Tìm kiếm" onkeyup="timkiem(this.value)"/>
                    <p  style="text-align:left;background:white;" id="livesearch"></p>
                <!-- </form> -->

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

        </div>
        <!--/banner-->
        <div class="row menungang">
            <!--menungang-->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <nav class="navbar navbar-default row" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="?key=giohang">
                            <img src="images/basket.png" alt="">
                        </a>
                        <span class="badge" style="margin:15px -6px;" ><?php if(isset($_SESSION['giohang']) && count($_SESSION['giohang'])>0) echo count($_SESSION['giohang']); else echo '';?></span>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li class=""><a href="index.php">Trang Chủ</a></li>
                            <li><a href="?key=gioithieu">Giới Thiệu</a></li>
                            <li><a href="?key=sanpham">Sản Phẩm</a></li>
                        </ul>
                        <div class="nav navbar-nav navbar-right">
                            <?php 
                            if(isset($_SESSION['txtTenDangNhap']) && $_SESSION['txtTenDangNhap'] != "") {
                            ?>

                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="margin :7px;">
                                    <i style="color:rgb(248, 112, 70);font-weight:bold"><?php echo $_SESSION['txtTenDangNhap'] ?></i>
                                    <span class="caret"></span>
                                </button>
                                <?php
                                    if($_SESSION['txtTenDangNhap']=="admin"){
                                ?>
                                <ul class="dropdown-menu">
                                    <li><a href="?key=quanly_donhang">Quản lý đơn hàng</a></li>
                                    <li><a href="?key=quanly_sp">Quản lý sản phẩm</a></li>
                                    <li><a href="?key=quanly_lsp">Quản lý loại sản phẩm</a></li>
                                    <li><a href="?key=dangxuat">Đăng xuất</a></li>
                                </ul>
                                <?php 
                                    }else{
                                        echo "<ul class='dropdown-menu'><li><a href='?key=dangxuat'>Đăng xuất</a></li></ul>";
                                    }
                                ?>
                            </div>
                            <?php }else {?>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="?key=dangnhap" target="_self" class="logsign"><img src="" /> Đăng nhập</a></li>
                                <li><a href="?key=dangky" target="_self" class="logsign"><img src=""/> Đăng ký &nbsp;</a></li>                                  
                            </ul>
                            <?php }?>
                        </div>

                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <!--/menungang-->

        <?php
         if(isset($_GET['key'])){
             $key=$_GET['key'];
             if($key=='dangnhap') include_once('dangnhap.php');
             elseif($key=='dangky') include_once('dangky.php');
             elseif($key=='dangxuat') include_once('dangxuat.php');
             elseif($key=='sanpham') include_once('sanpham.php');
             elseif($key=='giohang') include_once('giohang.php');
             elseif($key=='thanhtoan') include_once('thanhtoan.php');
             elseif($key=='quanly_sp') include_once('quanly_sp.php');
             elseif($key=='quanly_lsp') include_once('quanly_lsp.php');
             elseif($key=='chitiet_sp') include_once('chitiet_sp.php');
             elseif($key=='them_sp') include_once('them_sp.php');
             elseif($key=='capnhat_sp') include_once('capnhat_sp.php');
             elseif($key=='them_lsp') include_once('them_lsp.php');
             elseif($key=='capnhat_lsp') include_once('capnhat_lsp.php');
             elseif($key=='gioithieu') include_once('gioithieu.html');
             elseif($key=='quanly_donhang') include_once('quanly_donhang.php');
             elseif($key=='chitiet_donhang') include_once('chitiet_donhang.php');

            }else include_once('content.php');
        ?>
        
        <div class="row">
            <br>
        </div>
        <div class="row footer">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>Liên hệ</h3>
                <p>Email: truyenb1706660@student.ctu.edu.vn</p>
                <p>Số điện thoại: 0200200200</p>
                <p>Facebook:www.facebook.com/sweetbakery</p>
                <p>Địa chỉ: đường 3/2, phường Hưng Lợi, quận Ninh Kiều, TP Cần Thơ</p>
            </div>
        </div>
        <!--footer-->

    </div>
    <!--/container-->
    <script>
        function timkiem(str){
            var xmlhttp;
            if(str==""){
                document.getElementById("livesearch").style.display="none" ;
                return;
            }
            if(window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if(this.readyState ==4 && this.status == 200){
                    document.getElementById("livesearch").innerHTML=this.responseText;
                    document.getElementById("livesearch").style.display="block";
                }
            };
            xmlhttp.open("GET","timkiem.php?str="+str,true);
            xmlhttp.send();
        }
    </script>
</body>
</html>