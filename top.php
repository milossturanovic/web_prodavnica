<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');


// Prikaz kategorija koje su aktivne (status 1)
// Izvršava SQL upit za dobijanje svih kategorija sa statusom 1, sortiranih po nazivu kategorije
$cat_res = mysqli_query($con, "SELECT * FROM categories WHERE status=1 ORDER BY categories ASC");

// Inicijalizacija praznog niza za čuvanje kategorija
$cat_arr = array();

// Petlja koja prolazi kroz rezultate upita i dodaje svaku kategoriju u niz $cat_arr
while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
}

// Kreiranje novog objekta klase add_to_cart za rukovanje korpom
$obj = new add_to_cart();

// Pozivanje metode totalProduct() iz objekta $obj za dobijanje ukupnog broja proizvoda u korpi
$totalProduct = $obj->totalProduct();

?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>


    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.php"><img src="images/logo/nike-logo.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-5 col-xs-3">

                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <?php
                                        foreach ($cat_arr as $list) {
                                        ?>
                                            <li><a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a></li>
                                        <?php
                                        }
                                        ?>

                                        <li><a href="contact.html"></a></li>

                                    </ul>
                                </nav>
                            </div>


                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                    <?php
                                    // Provera da li je korisnik prijavljen, proveravajući da li je setovana sesija 'USER_LOGIN'
                                    if (isset($_SESSION['USER_LOGIN'])) {
                                        // Ako je korisnik prijavljen, prikazuje linkove za odjavu i pregled njegovih porudžbina
                                        echo '<a href="logout.php">Odjavi se</a><a href="my_order.php">Moje porudžbine</a>';
                                    } else {
                                        // Ako korisnik nije prijavljen, prikazuje link za prijavu ili registraciju
                                        echo '<a href="login.php">Prijava/Registracija</a>';
                                    }
                                    ?>

                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <div class="body__overlay"></div>
        <div class="offset__wrapper">
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Pretraga " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .header__account a {
                font-size: 13px !important;
                font-family: 'Inter', sans-serif !important;
                font-weight: 300;
            }

            .htc__shopping__cart a span.htc__qua {
                font-family: 'Inter', sans-serif;
            }

            h4,
            a {
                font-family: 'Inter', sans-serif !important;
            }
        </style>