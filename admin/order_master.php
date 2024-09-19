<?php
require('top.inc.php');

$sql="select * from users order by id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Lista porudžbina</h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">ID porudžbine</th>
									<th class="product-name"><span class="nobr">Datum porudžbine</span></th>
									<th class="product-price"><span class="nobr">Adresa</span></th>
									<th class="product-stock-stauts"><span class="nobr">Tip plaćanja</span></th>
									<th class="product-stock-stauts"><span class="nobr">Status plaćanja</span></th>
								
								</tr>
							</thead>
							<tbody>
							<?php
                            // prikazi sve porudbine kome je status 1 (pending order)
							 $res = mysqli_query($con, "SELECT * FROM `order` WHERE 1");
								while($row=mysqli_fetch_assoc($res)){
								?>
								<tr>
									<td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $row['id']?>"> <?php echo $row['id']?> - Pogledaj detalje</a>  </td>
									<td class="product-name"><?php echo $row['added_on']?></td>
									<td class="product-name">
									<?php echo $row['address']?><br/>
									<?php echo $row['city']?><br/>
									<?php echo $row['pincode']?>
									</td>
									<td class="product-name"><?php echo $row['payment_type']?></td>
									<td class="product-name"><?php echo $row['payment_status']?></td>
								
									
								</tr>
								<?php } ?>
							</tbody>
							
						</table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>