<?php 
require('top.php'); // Uključivanje osnovnih postavki i zaglavlja sajta

// Preuzimanje i čišćenje parametra 'str' iz URL-a kako bi se sprečile SQL injekcije
$str = mysqli_real_escape_string($con, $_GET['str']);

// Provera da li je parametar 'str' prazan
if($str != ''){
    // Ako nije prazan, dohvata proizvode na osnovu pretrage
    $get_product = get_product($con, '', '', '', $str);
}else{
    // Ako je prazan, preusmerava korisnika na početnu stranicu
    ?>
    <script>
    window.location.href='index.php';
    </script>
    <?php
}                                       
?>
<div class="body__overlay"></div>
        
<!-- Početak oblasti za breadcrumb navigaciju -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('https://web-prodavnica.milossturanovic.com/images/bg/background.jpg') no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Kraj oblasti za breadcrumb navigaciju -->

<!-- Početak oblasti sa prikazom proizvoda -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
            <!-- Provjera da li postoje proizvodi za prikaz -->
            <?php if(count($get_product) > 0){ ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="htc__product__rightidebar">
                    <!-- Početak prikaza proizvoda -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <?php
                                // Petlja kroz sve proizvode dobijene iz funkcije get_product
                                foreach($get_product as $list){
                                ?>
                                <!-- Početak pojedinačne kategorije proizvoda -->
                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="category">
                                        <!-- Prikaz slike proizvoda -->
                                        <div class="ht__cat__thumb">
                                            <a href="product.php?id=<?php echo $list['id']; ?>">
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image']; ?>" alt="product images">
                                            </a>
                                        </div>
                                        
                                        <!-- Detalji proizvoda -->
                                        <div class="fr__product__inner">
                                            <!-- Naziv proizvoda -->
                                            <h4><a href="product-details.html"><?php echo $list['name']; ?></a></h4>
                                            <!-- Prikaz cene proizvoda -->
                                            <ul class="fr__pro__prize">
                                                <li class="old__prize"><?php echo $list['mrp']; ?></li>
                                                <li><?php echo $list['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Kraj pojedinačne kategorije proizvoda -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- Kraj prikaza proizvoda -->
                </div>
            </div>
            <?php } else { 
                // Ako nema proizvoda za prikaz, ispisuje poruku
                echo "Nema podataka za prikaz";
            } ?>
        
        </div>
    </div>
</section>
<!-- Kraj oblasti sa prikazom proizvoda -->

<?php require('footer.php'); // Uključivanje footer fajla ?>
