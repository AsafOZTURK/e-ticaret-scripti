<?php

include "header.php";

$urunsor = $db->prepare("SELECT * FROM urun WHERE urun_id=:id");
$urunsor->execute(array(
    'id' => $_GET["urun_id"]
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

if ($urunsor->rowCount() == 0) {
    Header("Location:index.php?durum=izinsizmudahele");
    exit;
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <!--Main content-->
            <div class="title-bg">
                <div class="title"><?php echo $uruncek['urun_ad']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="dt-img">
                        <div class="detpricetag">
                            <div class="inner"><?php echo $uruncek['urun_fiyat']; ?></div>
                        </div>
                        <a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
                    </div>
                    <div class="thumb-img">
                        <a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
                    </div>
                    <div class="thumb-img">
                        <a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt="" class="img-responsive"></a>
                    </div>
                    <div class="thumb-img">
                        <a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-md-6 det-desc">
                    <div class="productdata">
                        <div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id']; ?></span></div>
                        <div class="infospan">Stok Sayısı<span>

                                <?php
                                if ($uruncek['urun_stok'] > 0) {
                                    echo $uruncek['urun_stok'];
                                } else {
                                    echo "Ürün Kalmadı";
                                }
                                ?>
                        </div>
                        <div class="average">
                        </div>
                        <form class="form-horizontal ava" role="form">

                            <div class="clearfix"></div>

                            <div class="form-group">
                                <label for="qty" class="col-sm-2 control-label">Adet</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="urun_adet" value="1">
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-default btn-red btn-sm"><span class="addchart">Sepete Ekle </span></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                        <div class="sharing">
                            <div class="avatock"><span></span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-review">
                <ul id="myTab" class="nav nav-tabs shop-tab">
                    <li class="active"><a href="#desc" data-toggle="tab">Ürün Detay</a></li>
                    <li class=""><a href="#rev" data-toggle="tab">Yorumlar(0)</a></li>
                    <li class=""><a href="#vid" data-toggle="tab">Ürün Video</a></li>
                </ul>
                <div id="myTabContent" class="tab-content shop-tab-ct">
                    <div class="tab-pane fade active in" id="desc">
                        <p>
                            <?php echo $uruncek['urun_detay']; ?>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="vid">
                        <p>

                        <?php 

                        if (strlen($uruncek['urun_video']) > 0) { ?>
                            <iframe width="500" height="250" src="<?php echo $uruncek['urun_video']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?php } else { 
                            echo "Bu ürüne video eklenmemiş";
                        }
                        ?>
                        
                        </p>
                    </div>
                    <div class="tab-pane fade" id="rev">


                        <p class="dash">
                            <span>Jhon Doe</span> (11/25/2012)<br><br>
                            Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
                        </p>


                        <h4>Yorum Yaz</h4>

                        <?php 
                        if (isset($_SESSION['userkullanici_mail'])) { ?>

                            <form role="form">
                            <div class="form-group">
                                <textarea placeholder="Lütfen yorumunuzu yazınız" class="form-control" id="text"></textarea>
                            </div>
                            
                            <button type="submit" name=""   class="btn btn-default btn-red btn-sm">Gönder</button>
                        </form>

                        <?php } else { ?>
                           Yorum yapmak için <a href="register.php">kayıt</a> olmalı yada giriş yapmalısınız.
                        <?php }
                        ?>

                    </div>
                </div>
            </div>

            <div id="title-bg">
                <div class="title">Benzer Ürünler</div>
            </div>
            <div class="row prdct">
                <!--Products-->
                <?php
                $kategori_id = $uruncek['kategori_id'];

                $urunsor = $db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id ORDER BY RAND()  LIMIT 3");
                $urunsor->execute(array(
                    'kategori_id' => $kategori_id
                ));
                
                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

                <div class="col-md-4">
                        <div class="productwrap">
                        <div class="pr-img">
                            <div class="hot"></div>
                            <a href="product.htm"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
                            <div class="pricetag on-sale">
                                <div class="inner on-sale"><span class="onsale"><span class="oldprice"></span><?php echo $uruncek['urun_fiyat']; ?></span></div>
                            </div>
                        </div>
                        <span class="smalltitle"><a href="product.htm"><?php echo $uruncek['urun_ad']; ?></a></span>
                        <span class="smalldesc">Stok Sayısı: <?php echo $uruncek['urun_stok ']; ?></span>
                    </div>
                </div>

            <?php }        
            ?>

            </div>
            <!--Products-->
            <div class="spacer"></div>
        </div>
        <!--Main content-->
        <?php include "sidebar.php"; ?>
    </div>
</div>

<?php include "footer.php"; ?>