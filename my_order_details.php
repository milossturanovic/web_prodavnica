<?php 
require('top.php'); // Uključivanje početnog fajla koji sadrži zaglavlje i inicijalne postavke

// Provera da li je korisnik prijavljen
if(!isset($_SESSION['USER_LOGIN'])){
    // Ako korisnik nije prijavljen, preusmerava ga na početnu stranicu
    ?>
    <script>
    window.location.href='index.php';
    </script>
    <?php
}

// Dobijanje i čišćenje ID-a porudžbine iz GET parametara
$order_id = get_safe_value($con, $_GET['id']);
?>

<!-- Početak oblasti za breadcrumb navigaciju -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('https://web-prodavnica.milossturanovic.com/images/bg/background.jpg') no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                  
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Početna</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Detalji porudžbine</span>
                        </nav>
                        <!-- Kraj breadcrumb navigacije -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Kraj oblasti za breadcrumb navigaciju -->


<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
           
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Ime proizvoda</th>
                                        <th class="product-thumbnail">Slike proizvoda</th>
                                        <th class="product-name">Količina</th>
                                        <th class="product-price">Cena</th>
                                        <th class="product-price">Ukupna cena</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Dobijanje ID-a korisnika iz sesije
                                    $uid = $_SESSION['USER_ID'];

                                    // Izvršavanje SQL upita za dobijanje detalja porudžbine
                                    $res = mysqli_query($con, "SELECT DISTINCT(order_detail.id), order_detail.*, product.name, product.image FROM order_detail, product, `order` WHERE order_detail.order_id='$order_id' AND `order`.user_id='$uid' AND order_detail.product_id=product.id");

                                    $total_price = 0; // Inicijalizacija ukupne cene na 0

                                    // Iteracija kroz sve stavke porudžbine
                                    while($row = mysqli_fetch_assoc($res)){
                                        // Ažuriranje ukupne cene
                                        $total_price += ($row['qty'] * $row['price']);
                                    ?>
                                    <tr>
                                        <!-- Prikaz naziva proizvoda -->
                                        <td class="product-name"><?php echo $row['name']; ?></td>

                                        <!-- Prikaz slike proizvoda -->
                                        <td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image']; ?>"></td>

                                        <!-- Prikaz količine kupljenog proizvoda -->
                                        <td class="product-name"><?php echo $row['qty']; ?></td>

                                        <!-- Prikaz cene po jedinici proizvoda -->
                                        <td class="product-name"><?php echo $row['price']; ?>€</td>

                                        <!-- Prikaz ukupne cene za ovu stavku (količina * cijena) -->
                                        <td class="product-name"><?php echo $row['qty'] * $row['price']; ?>€</td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <!-- Prazne ćelije za poravnanje -->
                                        <td colspan="3"></td>
                                        <!-- Prikaz ukupne cene svih stavki -->
                                        <td class="product-name">Ukupna cena</td>
                                        <td class="product-name"><?php echo $total_price; ?>€</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                    </form>
                </div>
            </div>
            <!-- Kraj sadržaja tabele sa detaljima porudžbine -->
        </div>
    </div>
</div>
<!-- Kraj glavne oblasti za detalje porudžbine -->

<?php require('footer.php'); // Uključivanje footer fajla ?>
