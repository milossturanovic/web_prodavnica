<?php
require('top.inc.php'); // Uključivanje početnih postavki i zaglavlja administrativnog dela sajta

// Dobijanje i čišćenje ID-a porudžbine iz GET parametara kako bi se sprečile potencijalne injekcije
$order_id = get_safe_value($con, $_GET['id']);

// Provera da li je forma za ažuriranje statusa porudžbine poslata
if (isset($_POST['update_order_status'])) {
    // Preuzimanje novog statusa porudžbine iz POST podataka
    $update_order_status = $_POST['update_order_status'];
    
    // Provera da li je novi status jednak '5' (verovatno označava da je porudžbina završena)
    if ($update_order_status == '5') {
        // Ako jeste, ažurira se status porudžbine i status plaćanja na 'Success'
        mysqli_query($con, "UPDATE `order` SET order_status='$update_order_status', payment_status='Success' WHERE id='$order_id'");
    } else {
        // Ako nije, ažurira se samo status porudžbine
        mysqli_query($con, "UPDATE `order` SET order_status='$update_order_status' WHERE id='$order_id'");
    }
}
?>
<div class="content pb-0">
    <div class="orders">
       <div class="row">
          <div class="col-xl-12">
             <div class="card">
                <div class="card-body">
                   <h4 class="box-title">Detalji porudžbine</h4> <!-- Naslov sekcije -->
                </div>
                <div class="card-body--">
                   <div class="table-stats order-table ov-h">
                      <!-- Početak tabele sa detaljima porudžbine -->
                      <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Ime proizvoda</th> <!-- Naziv proizvoda -->
                                        <th class="product-thumbnail">Slika proizvoda</th> <!-- Slika proizvoda -->
                                        <th class="product-name">Kvantitet</th> <!-- Količina -->
                                        <th class="product-price">Cijena</th> <!-- Cena po jedinici -->
                                        <th class="product-price">Totalna cijena</th> <!-- Ukupna cena za proizvod -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Izvršavanje SQL upita za dobijanje detalja porudžbine, uključujući informacije o proizvodu i adresi
                                    $res = mysqli_query($con, "SELECT DISTINCT(order_detail.id), order_detail.*, product.name, product.image, `order`.address, `order`.city, `order`.pincode FROM order_detail, product, `order` WHERE order_detail.order_id='$order_id' AND order_detail.product_id=product.id GROUP BY order_detail.id");
                                    
                                    $total_price = 0; // Inicijalizacija ukupne cene na 0
                                    
                                    // Dobijanje informacija o korisniku (adresa, grad, poštanski broj)
                                    $userInfo = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `order` WHERE id='$order_id'"));
                                    
                                    $address = $userInfo['address'];
                                    $city = $userInfo['city'];
                                    $pincode = $userInfo['pincode'];
                                    
                                    // Iteracija kroz sve stavke porudžbine
                                    while ($row = mysqli_fetch_assoc($res)) {
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
                                        <td class="product-name"><?php echo $row['price']; ?> €</td>
                                        
                                        <!-- Prikaz ukupne cene za ovu stavku (količina * cena) -->
                                        <td class="product-name"><?php echo $row['qty'] * $row['price']; ?> €</td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <!-- Prazne ćelije za poravnanje -->
                                        <td colspan="3"></td>
                                        
                                        <!-- Prikaz ukupne cene svih stavki -->
                                        <td class="product-name">Totalna cijena</td>
                                        <td class="product-name"><?php echo $total_price; ?> €</td>
                                    </tr>
                                </tbody>
                      </table>
                      <!-- Kraj tabele sa detaljima porudžbine -->
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<?php
require('footer.inc.php'); // Uključivanje footer fajla za administrativni deo sajta
?>
