<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="myStyle.css"/>

<?php
    include_once("connect.php");
    if(isset($_POST['btnThem'])){
        $tenloai=$_POST['txtTenLSP'];
        $mota=$_POST['txtMoTa'];
        $sql="INSERT INTO loaisanpham (lsp_ten,lsp_mota) VALUES ('$tenloai','$mota')";
        $conn->query($sql);
        echo "<script>alert('Bạn đã thêm thành công!')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=?key=quanly_lsp"/>';

    }
?>
<h2 style="text-align: center;color: rgb(214, 13, 107);font-weight: bold;">Thêm loại bánh mới</h2>
<form id="formThemSP" name="formThemSP" method="post" action="" class="" role="form" enctype="multipart/form-data" onsubmit="return kiemTraHopLe()"> <!--enctype su dung khi upload file lên form-->
    <div class="row">
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="row form-group">				    
                <label for="txtTen" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Tên loại bánh : </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtTenLSP" id="txtTenLSP" class="form-control" placeholder="Nhập tên loại bánh" value=""/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="tenlsp" class="error"></i>
                </div>
                            
            </div> 
        
            <div class="row form-group"> 
                <label for="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Mô tả :</label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtMoTa" id="txtMoTa" class="form-control" placeholder="Nhập mô tả"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="mota" class="error"></i>
                </div>
           </div>  
        
            <div class="row form-group">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                    <input type="submit"  class="btn btn-warning" name="btnThem" id="btnThem" value="Thêm mới"/>
                    
                    <input type="button" value="Quay lại" class="btn btn-basic" onclick="window.location='?key=quanly_lsp'">
                    
                </div>
            </div>
        </div>
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
    </div>	
</form>

<script>
    function kiemTraHopLe(){
        hl=true;
        var tenlsp=$('#txtTenLSP').val();
        var mota=$('#txtMoTa').val();
        if(tenlsp==""){
            $("#tenlsp").html("Hãy nhập tên loại bánh!");
            $('#tenlsp').css('display','block');
			hl=false;
		}else{
			$('#tenlsp').css('display','none');
		}
        if(mota==""){
            $("#mota").html("Hãy nhập mô tả loại bánh!");
            $('#mota').css('display','block');
			hl=false;
		}else{
			$('#mota').css('display','none');
		}
        return hl;
    }
</script>