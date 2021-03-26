<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
    include_once('connect.php');
    // session_start();
    
    if(isset($_POST['btnLogin'])){
        $user=$_POST['txtTenDangNhap'];
        $pass=md5($_POST['txtMatKhau']);
    
        $sql="SELECT * FROM thanhvien where tv_tendangnhap = '$user' and tv_matkhau = '$pass'";
	    $result=$conn->query($sql);
	    if($result->num_rows==1){
		    $row=$result->fetch_assoc();
		    $_SESSION['txtTenDangNhap']=$user;
		    $_SESSION['txtMatKhau']=$pass;
            echo "<script language='javascript'>window.location='index.php'</script>";
        }else{
            echo "<script> alert('Tên đăng nhập hoặc mật khẩu không hợp lệ.Vui lòng đăng nhập lại!')</script>";
            echo "<script language='javascript'>window.location='?key=dangnhap'</script>";

        }
    }
	// $conn->close();
?>
<link rel="stylesheet" type="text/css" href="style.css"/>
<h1 style="text-align: center;">Đăng nhập</h1>
<form id="formDangNhap" name="formDangNhap" method="POST" action="">
    
	<div class="row">
        
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="row form-group">
                <label for="txtTenDangNhap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Tên đăng nhập:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtTenDangNhap" id="txtTenDangNhap" class="form-control" placeholder="Tên đăng nhập" value="" required/>
                </div>
            </div>  
    
            <div class="row form-group">
                <label for="txtMatKhau" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Mật khẩu:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="password" name="txtMatKhau" id="txtMatKhau" class="form-control" placeholder="Mật khẩu" value="" required/>
                </div>
            </div> 
    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p><a href="#" >Quên mật khẩu?</a></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                    <input type="submit" name="btnLogin"  class="btn btn-warning" id="btnLogin" value="Đăng nhập"/>
                </div>
            </div> 
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>   
    </div>
</form>
