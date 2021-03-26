
<?php
  include_once('connect.php');
?>
<div class="container">
    <h2 style="text-align: center;color:rgb(214, 13, 107);font-weight: bold;">Quản lý loại sản phẩm</h2>
    <br><br>
    <div class="table-responsive">
        <table id="bangSP" class="table table-hover" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên loại bánh</th>
                    <th>Mô tả</th>
                    <th>Cập nhật</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql="SELECT * FROM loaisanpham ORDER BY lsp_ma ";
                $result=$conn->query($sql);
                $i=0;
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['lsp_ten']?></td>
                    <td><?php echo $row['lsp_mota']?></td>
                    <td><a href="?key=capnhat_lsp&malsp=<?php echo $row['lsp_ma']?>"><img src="images/update.png" alt=""></a></td>
                    <td><a onclick="return deleteConfirm()" href="xoa_lsp.php?ma_lsp=<?php echo $row['lsp_ma']?>"><img src="images/del.png" alt=""></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <p style="text-align: right;"><a href="?key=them_lsp" style="color:rgb(10, 64, 80);text-decoration:none;"><img
                    src="images/add.png" alt=""> Thêm loại bánh mới</a></p>
    </div>
</div>
<!--datatable-->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script language="javascript">
function deleteConfirm() {
    if (confirm("Bạn có chắc chắn muốn xóa!")) {
        return true;
    } else {
        return false;
    }
}
$(document).ready(function() {
    var table = $('#bangSP').DataTable({
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
        "lengthMenu": [
            [3, 10, 15, 20, 25, 30, -1],
            [5, 10, 15, 20, 25, 30, "Tất cả"]
        ]
    });
});
</script>