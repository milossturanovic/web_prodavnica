<?php
class add_to_cart{
	function addProduct($pid,$qty){
		$_SESSION['cart'][$pid]['qty']=$qty;
	}
	

       // cekira ako postoji taj proizvod pod specificnim id-jem i azurira mu kvantitet (broj)
	function updateProduct($pid,$qty){
		if(isset($_SESSION['cart'][$pid])){
			$_SESSION['cart'][$pid]['qty']=$qty;
		}
	}
	

    // cekira ako postoji taj proizvod pod specificnim id-jem i uklanja ga
	function removeProduct($pid){
		if(isset($_SESSION['cart'][$pid])){
			unset($_SESSION['cart'][$pid]);
		}
	}
	
          // isprazni cijelu korpu
	function emptyProduct(){
		unset($_SESSION['cart']);
	}



      // vrace totalni broj proizvoda koji se nalazi u korpu
	
	function totalProduct(){
		if(isset($_SESSION['cart'])){
			return count($_SESSION['cart']);
		}else{
			return 0;
		}
		
	}

}
?>