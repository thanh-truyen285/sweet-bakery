<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="myStyle.css"/>

<?php
    include_once('connect.php');
    if(isset($_GET['malsp'])){
        $ma=$_GET['malsp'];
        $sqlSL="SELECT * FROM loaisanpham WHERE lsp_ma='$ma'";
        $resultSL=$conn->query($sqlSL);
        $row=mysqli_fetch_array($resultSL,MYSQLI_ASSOC);
    }
    else{
        // echo '<meta http-equiv="refresh" content="0;URL=index.php?key=quanly_lsp"/>';
    }
    if(isset($_POST['btnCapNhat'])){
        $tenlsp=$_POST['txtTenLSP'];
        $mota=$_POST['txtMoTa'];

        $sql="UPDATE loaisanpham SET lsp_ten='$tenlsp',
                                     lsp_mota='$mota'
                                WHERE lsp_ma='$ma'";
        $conn->query($sql);
        echo '<meta http-equiv="refresh" content="0;URL=?key=quanly_lsp"/>';
    }
?>
<h2 style="text-align: center;color: rgb(214, 13, 107);font-weight: bold;">Cập nhật loại bánh</h2>
<form id="formThemSP" name="formThemSP" method="post" action="" class="" role="form" enctype="multipart/form-data" onsubmit="return kiemTraHopLe()"> <!--enctype su dung khi upload file lên form-->
    <div class="row">
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="row form-group">				    
                <label for="txtTen" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Tên loại bánh : </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtTenLSP" id="txtTenLSP" class="form-control" placeholder="Nhập tên loại bánh" value="<?php echo $row['lsp_ten'] ?>"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="tenlsp" class="error"></i>
                </div>
                            
            </div> 
        
            <div class="row form-group"> 
                <label for="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Mô tả :</label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtMoTa" id="txtMoTa" class="form-control" placeholder="Nhập mô tả" value="<?php echo $row['lsp_mota'] ?>"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="mota" class="error"></i>
                </div>
           </div>  
        
            <div class="row form-group">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                    <input type="submit"  class="btn btn-warning" name="btnCapNhat" id="btnCapNhat" value="Cập nhật"/>
                    
                    <input type="button" value="Quay lại" class="btn btn-basic" onclick="window.location='?key=quanly_lsp'">
                    
                </div>
            </div>
        </div>
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
    </div>	
</form>

<script>
    function kiemTraHopLe(){
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