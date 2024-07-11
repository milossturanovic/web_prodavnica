<?php 
require('top.php');

if(!isset($_GET['id']) || $_GET['id']==''){
    ?>
    <script>
    window.location.href='index.php';
    </script>
    <?php
    exit();
}

$cat_id = mysqli_real_escape_string($con, $_GET['id']);

$category_name = '';
$sql = "SELECT categories FROM categories WHERE id='$cat_id'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $category_name = $row['categories'];
} else {
    ?>
    <script>
    window.location.href='index.php';
    </script>
    <?php
    exit();
}

$price_high_selected = "";
$price_low_selected = "";
$new_selected = "";
$old_selected = "";
$sort_order = "";

if(isset($_GET['sort'])){
    $sort = mysqli_real_escape_string($con, $_GET['sort']);
    if($sort == "price_high"){
        $sort_order = " ORDER BY product.price DESC ";
        $price_high_selected = "selected";    
    }
    if($sort == "price_low"){
        $sort_order = " ORDER BY product.price ASC ";
        $price_low_selected = "selected";
    }
    if($sort == "new"){
        $sort_order = " ORDER BY product.id DESC ";
        $new_selected = "selected";
    }
    if($sort == "old"){
        $sort_order = " ORDER BY product.id ASC ";
        $old_selected = "selected";
    }
}

if($cat_id > 0){
    $get_product = get_product($con, '', $cat_id, '', '', $sort_order);
} else {
    ?>
    <script>
    window.location.href='index.php';
    </script>
    <?php
    exit();
}                                       
?>
<div class="body__overlay"></div>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('https://web-prodavnica.milossturanovic.com/images/bg/background.jpg') no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Početna</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active"><?php echo htmlspecialchars($category_name); ?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
					<?php if(count($get_product)>0){?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                        <option value="">Sortiranje</option>
                                        <option value="price_low" <?php echo $price_low_selected?>>Najniza-najveca</option>
                                        <option value="price_high" <?php echo $price_high_selected?>>najveca-najniza</option>
                                        <option value="new" <?php echo $new_selected?>>novije</option>
										<option value="old" <?php echo $old_selected?>>starije</option>
                                    </select>
                                </div>
                               
                            </div>
                            <!-- prikaz proizvoda u svojim kategorijama -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                        <?php
										foreach($get_product as $list){
										?>
										<!-- prikaz slike -->
										<div class="col-12 col-md-4">
											<div class="category">
												<div class="ht__cat__thumb">
													<a href="product.php?id=<?php echo $list['id']?>">
														<img src="<?php echo 'https://web-prodavnica.milossturanovic.com/media/product/'.$list['image']?>" alt="product images">
													</a>
												</div>
												<!-- prikaz cijene -->
												<div class="fr__product__inner">
													<h4><a href="product-details.html"><?php echo $list['name']?></a></h4>
													<ul class="fr__pro__prize">
														<p>Cijena:</p><li><?php echo $list['price']?></li>
													</ul>
												</div>
											</div>
										</div>
										<?php } ?>
                                    </div>
							   </div>
                            </div>
                        </div>
                    </div>
					<?php } else { 
						echo "Proizvodi nisu nadjeni";
					} ?>
                
				</div>
            </div>
        </section>
 
<?php require('footer.php')?>        


<style>


.ht__bradcaump__area{
    height: 300px !important;
    display: flex;
    align-items: center;
    justify-content: center;
}


.breadcrumb-item{
    font-family: 'Inter', sans-serif;
    font-size: 2rem;
    font-weight: 600;
    color: white;
}

.breadcrumb-item:active{
    font-family: 'Inter', sans-serif;
    font-size: 2rem;
    font-weight: 600;
    color: whitesmoke;
}

.zmdi-chevron-right::before {
  content: '\f2fb';
  font-size: 2rem;
  margin: 0rem 15px;
  color: white;
}

</style>