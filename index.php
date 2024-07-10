<?php require('top.php')?>
<div class="body__overlay"></div>
        
      
               
                <div class="hero">
    <div class="hero-content">
      <h2>Dobrodošli u</h2>
      <h1>Nike Store Outlet</h1>
    
    </div>
  </div>
                
                
                
                
                
                <style>
  
    .hero {
      height: 60vh;
      background: url('https://web-prodavnica.milossturanovic.com/images/wallpaper.jpg') no-repeat center center/cover;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
    }
    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }
    .hero-content {
      position: relative;
      z-index: 2;
    }
    .hero h2 {
      margin: 0;
      font-size: 2em;
      color:white;
    }
    .hero h1 {
      margin: 10px 0;
      font-size: 3em;
      font-weight: bold;
           color:white;
    }
    .hero button {
      margin-top: 20px;
      padding: 10px 20px;
      font-size: 1em;
      color: white;
      background-color: #e31837;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
      font-family: 'Inter' sans-serif;
    }
    .hero button:hover {
      background-color: #c21631;
    }
    @media (max-width: 768px) {
      .hero h2 {
        font-size: 1.5em;
      }
      .hero h1 {
        font-size: 2.5em;
      }
      .hero button {
        font-size: 0.9em;
      }
    }
  </style>
               


        <!-- KATEGORIJE -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Najnoviji proizvodi</h2>
                         
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
						<?php


/* Select 4 most recently added products */
$get_product = get_product($con, 8);
foreach ($get_product as $list) {
?>
    <!-- Display product details and images -->
    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
        <div class="category">
            <div class="ht__cat__thumb">
                <a href="product.php?id=<?php echo $list['id']?>">
                    <img src="https://web-prodavnica.milossturanovic.com/media/product/<?php echo $list['image']?>" alt="product images">
                </a>
            </div>
            <!-- Display product name, retail price, and sale price -->
            <div class="fr__product__inner">
                <h4><a href="product-details.html"><?php echo $list['name']?></a></h4>
                <ul class="fr__pro__prize">
                    <li><?php echo $list['price']?></li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php require('footer.php')?>                  