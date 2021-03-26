<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    include_once("connect.php");
    function LSPList($conn,$selectedValue){
        $sql="SELECT lsp_ma,lsp_ten FROM loaisanpham";
        $result=$conn->query($sql);
        echo "<select class='form-control' name='slLSP' id='slLSP'>
            	<option value='0'>Chọn loại bánh</option>";
            	while ($row = $result->fetch_assoc()) {
                    if($row['lsp_ma']==$selectedValue) echo "<option value='".$row['lsp_ma']."' selected>".$row['lsp_ten']."</option>";
                    else echo "<option value='".$row['lsp_ma']."'>".$row['lsp_ten']."</option>";
            	}
        echo "</select>";
    }

    //Xu ly cap nhat
    if(isset($_GET['masp'])){
        $masp=$_GET['masp'];
        $sqlSL="SELECT sp_ten,sp_gia,sp_chitiet,sp_soluong,sp_hinhanh,lsp_ma FROM sanpham WHERE sp_ma='$masp'";
        $resultSL=$conn->query($sqlSL);
        $row=$resultSL->fetch_assoc();
    }else{
        // echo '<meta http-equiv="refresh" content="0;URL=?key=quanly_sp"/>';
    }
    if(isset($_POST['btnCapNhat'])){
        $tensp=$_POST['txtTenSP'];
        $lsp=$_POST['slLSP'];
        $mota=$_POST['txtMoTa'];
        $gia=$_POST['txtGia'];
        $sl=$_POST['txtSoLuong'];
        $hinhsp="hinhsanpham/".$_FILES['fileHinhAnh']['name'];

        $sql="UPDATE sanpham SET sp_ten='$tensp',
                                 sp_gia='$gia',
                                 sp_chitiet='$mota',
                                 sp_ngaycapnhat='".date('Y-m-d H:i:s')."',
                                 sp_soluong='$sl',
                                 sp_hinhanh='$hinhsp',
                                 lsp_ma='$lsp'
                            WHERE sp_ma=$masp";
        $conn->query($sql);
        move_uploaded_file($_FILES['fileHinhAnh']['tmp_name'],$hinhsp);
        echo '<meta http-equiv="refresh" content="0;URL=index.php?key=quanly_sp"/>';
    }
?>

<h2 style="text-align: center;color: rgb(214, 13, 107);font-weight: bold;">Cập nhật bánh</h2>
<form id="formThemSP" name="formThemSP" method="post" action=""role="form" enctype="multipart/form-data" onsubmit="return kiemTraHopLe();"> <!--enctype su dung khi upload file lên form-->
    <div class="row">
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="row form-group">				    
                <label for="txtTen" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Tên bánh : </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtTenSP" id="txtTenSP" class="form-control" placeholder="Nhập tên bánh" value="<?php echo $row['sp_ten']?>"/>
                </div>  
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="tensp" class="error"></i>
                </div>
            </div> 
        
            <div class="row form-group">   
                <label for="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Loại bánh : </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php LSPList($conn,$row['lsp_ma']); ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="lsp" class="error"></i>
                </div>
           </div> 
        
            <div class="row form-group"> 
                <label for="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Mô tả bánh :</label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" name="txtMoTa" id="txtMoTa" class="form-control" placeholder="Nhập mô tả bánh " value="<?php echo $row['sp_chitiet'] ?>"/>
                </div>
           </div>  
        
           <div class="row form-group">                               
                <label for="lblHoten" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Giá : </label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="number" min="1000" name="txtGia" id="txtGia" value="<?php echo $row['sp_gia']?>" class="form-control" placeholder="Nhập giá"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="gia" class="error"></i>
                </div>
           </div>   
                               
            <div class="row form-group">   
                <label for="lblDiaChi" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Số lượng :</label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="number" min="0" name="txtSoLuong" id="txtSoLuong" value="<?php echo $row['sp_soluong']?>" class="form-control" placeholder="Nhập số lượng"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <i id="sl" class="error"></i>
                </div>
            </div>  

            <div class="row form-group">   
                <label for="lblDiaChi" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Hình ảnh :</label>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="file" name="fileHinhAnh" id="fileHinhAnh" class="form-control"/>
                </div>
                
                <div class="col-sm-12 col-md-12 col-lg-12">
                <br>
                    <img width="100px" src="<?php echo $row['sp_hinhanh'] ?>" alt="">
                </div>
                
            </div>                         
        
            <div class="row form-group">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                    <input type="submit"  class="btn btn-warning" name="btnCapNhat" id="btnCapNhat" value="Cập nhật"/>
                    
                    <input type="button" value="Quay lại" class="btn btn-basic" onclick="window.location='index.php?key=quanly_sp'">
                    
                </div>
            </div>
        </div>
                    
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
    </div>	
</form>
<script>
    function kiemTraHopLe(){
        
        var hl=true;
        var tensp=$('#txtTenSP').val();
        var lsp=$('#slLSP').val();
        var gia=$('#txtGia').val();
        var sluong=$('#txtSoLuong').val();
        if(tensp==""){
            $("#tensp").html("Hãy nhập tên bánh!");
            $('#tensp').css('display','block');
			hl=false;
		}else{
			$('#tensp').css('display','none');
		}
        if(lsp=='0'){
            $("#lsp").html("Hãy chọn loại bánh!");
            $('#lsp').css('display','block');
			hl=false;
		}else{
			$('#lsp').css('display','none');
		}
        if(gia==""){
            $("#gia").html("Hãy nhập giá!");
            $('#gia').css('display','block');
			hl=false;
		}else{
			$('#gia').css('display','none');
		}
        if(sluong==""){
            $("#sl").html("Hãy nhập số lượng bánh!");
            $('#sl').css('display','block');
			hl=false;
		}else{
			$('#sl').css('display','none');
		}
        return hl;
    }
</script>