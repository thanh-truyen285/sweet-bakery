<div class="row slideshow">
    <!--slideshow-->
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div id="carousel-id" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-id" data-slide-to="1" class=""></li>
                <li data-target="#carousel-id" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img alt="First slide" src="hinhsanpham/024.jpg">
                    <div class="contain">
                        <div class="carousel-caption">
                            <h1></h1>
                            <h3>Adding a bit of sweet is to add gladness</h3>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img width="100%" alt="Second slide" src="hinhsanpham/021.jpg">
                    <div class="contain">
                        <div class="carousel-caption">
                            <h1></h1>
                            <h3>Adding a little bittersweet for life</h3>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img alt="Third slide" src="hinhsanpham/020.jpg">
                    <div class="contain">
                        <div class="carousel-caption">
                            <h1></h1>
                            <h3>Tasting a new flavor to enrich your experiences</h3>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span
                    class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#carousel-id" data-slide="next"><span
                    class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
    </div>
</div>
<!--/slideshow-->
<div class="container-fluid">
<div class="row content">
    <!--content-->

    <div class="col-sm-12 col-md-12 col-lg-12">
        <hr>
        <h3>CÁC LOẠI BÁNH MỚI</h3>
    </div>
    <?php 
        include_once('cOnnect.php');
        $sql="SELECT sp_ma,sp_ten,sp_gia,sp_hinhanh FROM sanpham ORDER BY sp_ma DESC LIMIT 4";
        $rs=$conn->query($sql);
        while($row=$rs->fetch_assoc())
        {
    ?>
    <div class="col-sm-3 col-md-3 col-lg-3 sp">
        <a href="?key=chitiet_sp&ma_sp=<?php echo $row['sp_ma']  ?>"><img width="100%" src="<?php echo $row['sp_hinhanh'] ?>" class="img-responsive" alt="Image"></a>
        <h3 class="namecake" style=""><?php echo $row['sp_ten'] ?></h3>
        <p class="price"><?php echo number_format($row['sp_gia']) ?> VND</p>
    </div>

    <?php }?>

</div>
<!--/content-->
</div>
