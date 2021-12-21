<?php

include 'header.php';

if (isset($_GET['sef'])) {
    $kategorisor = $db->prepare("SELECT * FROM kategori WHERE kategori_seourl=:seo");
    $kategorisor->execute(array(
        'seo' => $_GET["sef"]
    ));
    $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);

    $kategori_id = $kategoricek['kategori_id'];

    $urunsor = $db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id");
    $urunsor->execute(array(
        'kategori_id' => $kategori_id
    ));

} else {

    $urunsor = $db->prepare("SELECT * FROM urun");
    $urunsor->execute();
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <!--Main content-->
            <div class="title-bg">
                <div class="title">Ürünler</div>
            </div>
            <div class="row prdct">
                <!--Products-->

                <?php
                $say = $urunsor->rowCount();
                if ($say==0) {
                    echo "Bu katagoride Ürün bulunamadı";
                }
                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

                    <div class="col-md-4">
                        <div class="productwrap">
                            <div class="pr-img">
                                <div class="hot"></div>
                                <a href="product.htm"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
                                <div class="pricetag on-sale">
                                    <div class="inner on-sale"><span class="onsale"><span class="oldprice"></span><?php echo $uruncek['urun_fiyat']; ?>TL</span></div>
                                </div>
                            </div>
                            <span class="smalltitle"><a href="#"><?php echo $uruncek['urun_ad']; ?></a></span>
                            <span class="smalldesc">Stok Sayısı: <?php echo $uruncek['urun_stok']; ?></span>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
            <!--Products-->
            <ul class="pagination shop-pag">
                <!--pagination
                <li><a href="#"><i class="fa fa-caret-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#"><i class="fa fa-caret-right"></i></a></li>
            </ul>
            pagination-->
        </div>
        
    </div>
    <div class="spacer"><?php include "sidebar.php"; ?></div>
</div>

<?php include 'footer.php'; ?>