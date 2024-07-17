<?php 
require('top.php');
?>

 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('https://web-prodavnica.milossturanovic.com/images/bg/background.jpg') no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Početna</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Korpa</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Proizvodi</th>
                                            <th class="product-name">Naziv proizvoda</th>
                                            <th class="product-price">Cijena</th>
                                            <th class="product-quantity">Količina</th>
                                            <th class="product-subtotal">Ukupno</th>
                                            <th class="product-remove">Ukloni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
											$productArr=get_product($con,'','',$key);
											$pname=$productArr[0]['name'];

											$price=$productArr[0]['price'];
											$image=$productArr[0]['image'];
											$qty=$val['qty'];
											?>
											<tr>
												<td class="product-thumbnail"><a href="#"><img src="<?php echo 'https://web-prodavnica.milossturanovic.com/media/product/'.$image?>"  /></a></td>
												<td class="product-name"><a href="#"><?php echo $pname?></a>
												
												</td>
												<td class="product-price"><span class="amount"><?php echo $price?> €</span></td>
												<td class="product-quantity"><input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>" />
												<br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">ažuriraj</a>
												</td>
												<td class="product-subtotal"><?php echo $qty*$price?></td>
												<td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a></td>
											</tr>
											<?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="<?php echo SITE_PATH?>">Nastavi sa kupovinom</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="">Nastavi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>


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
										
<?php require('footer.php')?>        