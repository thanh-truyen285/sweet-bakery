
<?php
  include_once('connect.php');
  //Xoa don hang
  if(isset($_GET['madh']))
    {
        $ma=$_GET['madh'];
        $sqlHD="DELETE FROM hoadon WHERE hd_ma='$ma'";
        $sqlCTHD="DELETE FROM chitiethoadon WHERE hd_ma='$ma'";
        $conn->query($sqlCTHD);
        $conn->query($sqlHD);
        
        echo '<meta http-equiv="refresh" content="0;URL=index.php?key=quanly_donhang"/>';
    }
    //Cap nhat trang thai don hang
        if(isset($_GET['ma']))
        {
            $ma=$_GET['ma'];
            $sqlDone="UPDATE hoadon SET hd_trangthaithanhtoan=1 WHERE hd_ma=$ma";
            $conn->query($sqlDone);
        } 
      
    
?>

<div class="container">
<form action="" method="post">
	<h2 style="text-align: center;color:rgb(214, 13, 107);font-weight: bold;">Quản lý đơn hàng</h2>
	<br><br>
    <div class="table-responsive">          
        <table id="bangSP" class="table table-hover" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Nơi giao</th>
                    <th>Trạng thái</th><!--làm popover(rê chuột vào hiện ra hình ảnh -->
                    <th>Chi tiết đơn hàng</th> 
		            <th>Hủy đơn</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT hd_ma, tv_hoten, hd_ngaylap, hd_ngaygiao, hd_noigiao, hd_trangthaithanhtoan
                          FROM hoadon h JOIN thanhvien t ON h.tv_tendangnhap=t.tv_tendangnhap
                          ORDER BY hd_ma";
                    $result=$conn->query($sql);
                    $stt=0;
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $stt++;
                        $ma=$row['hd_ma'];
                ?>
                <tr>
                    <td><?php echo $stt; ?></td>
                    <td><?php echo $row['tv_hoten']?></td>
                    <td><?php echo $row['hd_ngaylap'] ?></td>
                    <td><?php echo $row['hd_ngaygiao'] ?></td>
                    <td><?php echo $row['hd_noigiao'] ?></td>
                    <td><?php if($row['hd_trangthaithanhtoan']==1) echo "Đã thanh toán"; else echo "Chưa thanh toán" ?></td>
                    <td><a href="?key=chitiet_donhang&mahd=<?php echo $row['hd_ma'] ?>">Xem</a></td>
                    <td>
                        <a onclick="return deleteConfirm()" href="?key=quanly_donhang&madh=<?php echo $row['hd_ma']?>"><img src="images/del.png" alt=""></a>
                    </td>
                    <td>
                        <a href="?key=quanly_donhang&ma=<?php echo $row['hd_ma']?>">
                            <input type="button" class="btn <?php if($row['hd_trangthaithanhtoan']==1) echo 'btn-default'; else echo 'btn-success' ?>" value="Hoàn thành" name="btnFinish" <?php if($row['hd_trangthaithanhtoan']==1) echo 'disabled'; ?>>
                        </a>
                    </td>   
                </tr>
                    <?php  } ?>
            </tbody>
	    </table>
    </div>
</form>
<a href="index.php" style="text-align:center"> << Quay lại trang chủ </a>
</div>
                    
<!--datatable-->
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
  <script language="javascript">
        
    function deleteConfirm(){
      	if(confirm("Bạn có chắc chắn muốn hủy!")){
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
            "lengthMenu": [[5, 10, 15, 20, 25, 30, -1], [5, 10, 15, 20, 25, 30, "Tất cả"]]
    } );
} );		
    </script>