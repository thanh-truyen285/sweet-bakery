<link rel="stylesheet" type="text/css" href="myStyle.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
    include_once("connect.php");
    if(isset($_POST['btnDangKy'])){
        $user=$_POST['txtTenDangNhap'];
        $pass=$_POST['txtMatKhau1'];
        $hoten=$_POST['txtHoTen'];
        $email=$_POST['txtEmail'];
        $diachi=$_POST['txtDiaChi'];
        $sdt=$_POST['dienThoai'];
        $sn=$_POST['sinhNhat'];
        
        $sql_select="SELECT * FROM thanhvien WHERE tv_tendangnhap='$user' OR tv_email='$email'";
        $result=$conn->query($sql_select);
        if($result->num_rows==0){
            $sql="INSERT INTO thanhvien (tv_tendangnhap,tv_matkhau,tv_hoten,tv_diachi,tv_dienthoai,tv_email,tv_namsinh,tv_quantri) 
                VALUES ('$user','".md5($pass)."','$hoten','$diachi','$sdt','$email','$sn',0)";
            $conn->query($sql);
            echo "<script>alert('Bạn đã đăng ký thành công.Hãy đăng nhập!')</script>";
            echo "<script language='javascript'>window.location='index.php?key=dangnhap'</script>";
        }else{
                echo "<script>alert('Tên đăng nhập đã tồn tại.Vui lòng chọn tên khác!')</script>"; 
            }          
    }
?>
<h2 style="text-align: center;">Đăng ký</h2>
<form id="formDangKy" name="formDangKy" method="post" action="" class="" role="form" enctype="multipart/form-data" onsubmit="return dangky()"> <!--enctype su dung khi upload file lên form-->
    <div class="row">
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="row form-group">				    
                <label for="txtTen" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Tên đăng nhập:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtTenDangNhap" id="txtTenDangNhap" class="form-control" placeholder="Tên đăng nhập" value="<?php if(isset($user)) echo $user?>"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="tendn" class="error"></i>
                </div>
                            
            </div> 
        
            <div class="row form-group">   
                <label for="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Mật khẩu:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="password" name="txtMatKhau1" id="txtMatKhau1" class="form-control"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="mk1" class="error"></i>
                </div>
           </div> 
        
            <div class="row form-group"> 
                <label for="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Nhập lại mật khẩu:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="password" name="txtMatKhau2" id="txtMatKhau2" class="form-control"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="mk2" class="error"></i>
                </div>
           </div>  
        
           <div class="row form-group">                               
                <label for="lblHoten" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Họ tên:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtHoTen" id="txtHoTen" value="<?php ?>" class="form-control" placeholder="Nhập họ tên"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="hoten" class="error"></i>
                </div>
           </div> 
        
            <div class="row form-group">      
                <label for="lblEmail" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Email:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="email" name="txtEmail" id="txtEmail" value="<?php ?>" class="form-control" placeholder="Email"/>
                </div>
          
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="email" class="error"></i>
                </div>
            </div>  
                               
            <div class="row form-group">   
                <label for="lblDiaChi" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Địa chỉ:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtDiaChi" id="txtDiaChi"  class="form-control" placeholder="Địa chỉ"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="diachi" class="error"></i>
                </div>
                </div>  
                                
            <div class="row form-group">  
                <label for="lblDienThoai" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Điện thoại:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="tel" name="dienThoai" id="dienThoai" pattern="[0-9]{10}"  class="form-control" placeholder="Điện thoại"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="sdt" class="error"></i>
                </div>
            </div> 
        
            <div class="row form-group"> 
                <label for="lblNgaySinh" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Ngày/tháng/năm sinh:  </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" class="input-group">
                    <input type="date" name="sinhNhat" id="sinhNhat">
                </div>	
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="sn" class="error"></i>
                </div>
            </div>	 
                                   
            <div class="row form-group">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                    <input type="submit"  class="btn btn-warning" name="btnDangKy" id="btnDangKy" value="Đăng ký"/>
                    
                    <input type="reset" value="Reset" class="btn btn-default">
                    
                </div>
            </div>
        </div>
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
    </div>	
</form>

<script type="text/javascript">
    function dangky(){
        var result=true;
        var tenDN=$('#txtTenDangNhap').val();
        var matKhau1=$('#txtMatKhau1').val();
        var matKhau2=$('#txtMatKhau2').val();
        var hoTen=$('#txtHoTen').val();
        var email=$('#txtEmail').val();
        var diaChi=$('#txtDiaChi').val();
        var sdt=$('#dienThoai').val();
        var sn=$('#sinhNhat').val();
                
        var pattern_user=/^[A-Za-z0-9]{5,20}$/;
		if(tenDN =="" || !pattern_user.test(tenDN)){
			$("#tendn").html("Tên đăng nhập không hợp lệ. Vui lòng chọn tên đăng nhập ít nhất 5 ký tự, có chữ cái và chữ số!");
            $('#tendn').css('display','block');
			result=false;
		}else{
			$('#tendn').css('display','none');
		}
	    var pattern_mk=/^[A-Za-z0-9]{6,15}$/;
		if(matKhau1=="" || !pattern_mk.test(matKhau1)){
			$("#mk1").html("Mật khẩu không hợp lệ.Vui lòng nhập mật khẩu ít nhất 6 ký tự và có chữ cái và chữ số!");
            $('#mk1').css('display','block');
			result=false;
		}else{
			$('#mk1').css('display','none');
		}	
		if(matKhau2!=matKhau1){
			$("#mk2").html("Tên đăng nhập không hợp lệ!");
            $('#mk2').css('display','block');
			result=false;
		}else{
			$('#mk2').css('display','none');
		}
        if(hoTen==""){
			$("#hoten").html("Vui lòng nhập họ tên!");
            $('#hoten').css('display','block');
			result=false;
		}else{
			$('#hoten').css('display','none');
		}
        if(diaChi==""){
			$("#diachi").html("Vui lòng nhập địa chỉ!");
            $('#diachi').css('display','block');
			result=false;
		}else{
			$('#diachi').css('display','none');
		}	
		if(email==""){
			$("#email").html("Vui lòng nhập email!");
            $('#email').css('display','block');
			result=false;
		}else{
			$('#email').css('display','none');
		}	
        if(sdt==""){
			$("#sdt").html("Vui lòng nhập số điện thoại!");
            $('#sdt').css('display','block');
			result=false;
		}else{
			$('#sdt').css('display','none');
		}
        if(sn==""){
			$("#sn").html("Vui lòng chọn ngày tháng năm sinh!");
            $('#sn').css('display','block');
			result=false;
		}else{
			$('#sn').css('display','none');
		}	
		return result;
    }
</script>

