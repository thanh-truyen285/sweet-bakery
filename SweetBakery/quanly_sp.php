
<?php
  include_once('connect.php');
  //Xoa nhieu muc san pham
    if(isset($_POST['btnXoaNhieu'])  && isset($_POST['chkXoa'])){
        for($i = 0; $i < count($_POST['chkXoa']);  $i++){
            $masp=$_POST['chkXoa'][$i];
            $sql="DELETE FROM sanpham WHERE sp_ma='$masp'";
            $conn->query($sql);
            echo '<meta http-equiv="refresh" content="0;URL=?key=quanly_sp"/>';
        }
    }
?>

<div class="container">
<form action="" method="post">
	<h2 style="text-align: center;color:rgb(214, 13, 107);font-weight: bold;">Quản lý sản phẩm</h2>
	<br><br>
    <div class="table-responsive">          
        <table id="bangSP" class="table table-hover" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên bánh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Loại bánh</th>
                    <th>Hình ảnh</th><!--làm popover(rê chuột vào hiện ra hình ảnh -->
                    <th>Cập nhật</th> 
		            <th>Xóa</th>
		            <th>Chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT sp_ma,sp_ten,sp_gia,sp_soluong,lsp_ten,sp_hinhanh FROM sanpham s JOIN loaisanpham l ON s.lsp_ma=l.lsp_ma
                          ORDER BY sp_ma";
                    $result=$conn->query($sql);
                    $stt=0;
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $stt++;
                ?>
                <tr>
                    <td><?php echo $stt; ?></td>
                    <td><?php echo $row['sp_ten']?></td>
                    <td><?php echo $row['sp_gia'] ?> VND</td>
                    <td><?php echo $row['sp_soluong'] ?></td>
                    <td><?php echo $row['lsp_ten'] ?></td>
                    <td> <img src="<?php  echo $row['sp_hinhanh']?>" alt="images" width="75px"></td>
                    <td><a href="?key=capnhat_sp&masp=<?php echo $row['sp_ma'] ?>"><img src="images/update.png" alt=""></a></td>
		            <td><a onclick="return deleteConfirm()" href="xoa_sp.php?masp=<?php echo $row['sp_ma']?>"><img src="images/del.png" alt=""></a></td>
		            <td><input type="checkbox" name="chkXoa[]" id="chkXoa[]" value="<?php echo $row['sp_ma'] ?>"></td>
                </tr>
                    <?php } ?>
            </tbody>
	    </table>
        <p style="text-align: right;">
            <input type="submit" name="btnXoaNhieu" id="btnXoaNhieu" onclick="return deleteConfirm()" class="btn btn warning" value="Xóa nhiều">
        </p>
	    <p style="text-align: right;">
            <a href="?key=them_sp" style="color:rgb(10, 64, 80);text-decoration:none;"><img src="images/add.png" alt=""> Thêm bánh mới</a>
            
        </p>
    </div>
</form>
<a href="index.php" style="text-align:center"> << Quay lại trang chủ </a>
</div>
                    
<!--datatable-->
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
  <script language="javascript">
    function deleteConfirm(){
      	if(confirm("Bạn có chắc chắn muốn xóa!")){
            return true;
	    }else{
            return false;
        }
    }
	$(document).ready(function() {
		var table = $('#bangSP').DataTable( {
            responsive: true,
			"language": {
                "lengthMenu": "Hiển thị _MENU_ dòng dữ liệu",
                "info": "Hiển thị _START_ trong tổng số _TOTAL_ dòng",
                "infoEmpty": "Dữ liệu rỗng",
                "emptyTable": "Chưa có dữ liệu nào",
                "processing": "Đang xử lý...",
                "search": "Tìm kiếm:",
                "paginate": {
                    "first": "|<",
                    "last": ">|",
                    "next": ">>",
                    "previous": "<<"
                }
            },
            "lengthMenu": [[2, 10, 15, 20, 25, 30, -1], [5, 10, 15, 20, 25, 30, "Tất cả"]]
    } );
} );		
    </script>