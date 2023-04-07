

		<?php
		      session_start();

		      $total_price = 0;
			  $total_item = 0;
			 
			
			  if(isset($_SESSION['customer_id'] )== 0) {
				echo '</div><div class="order">
									<p><B>NOTE:</B> You must login </p>	
									</div>';
			
			
								}	

		      if(!empty($_SESSION['cart']))
		      {
						echo '<div class="products" >';
		        foreach($_SESSION['cart'] as $keys => $values)
		        {
							echo '
							<div class="product-image">
							<img src="../images/Product_Images/'.$values['p_img'].'" alt="">
							</div>
							<div class="details">
							<div class="product-details">

							<h3 class="P-name">'.ucfirst($values["p_name"]).'</h3>
							<p>'.$values["p_size"].'  </p>

							</div>
							<div class="buttons">

							<button type="submit" class="add" name="add" id="'. $values['pid'].'" > +</button>
							<p class="quantity">'.$values["p_quantity"].'</p>
							<button type="submit" class="remove" name="remove" id="'. $values['pid'].'"> -</button><br>
							<button name="delete" class="delete" id="'. $values["pid"].'">D</button><br>

							</div>
							<h3 id="subTotal">Rs '.number_format((int)$values["p_quantity"] * (int)$values["p_price"], 2).'</h3>

							</div>


							<input type="hidden" id="img'. $values["pid"].'" value="'.$values['p_img'].'">
							<input type="hidden" id="name'. $values["pid"].'" value="'.$values['p_name'].'">
							
							<input type="hidden" id="size'. $values["pid"].'" value="'.$values['p_size'].'">
							<input type="hidden" id="price'. $values["pid"].'" value="'.$values['p_price'].'">
							<input type="hidden" id="quantity'. $values["pid"].'" value="'.$values['p_quantity'].'">';
							$total_price = $total_price + ((int)$values["p_quantity"] * (int)$values["p_price"]);
							$total_item = $total_item + 1;
						}

						echo '</div><div class="order">
						<h3 id="total">Total : Rs '.number_format($total_price, 2).'</h3>
						<button type="submit" name="checkout" id="checkout-btn" disabled="disabled">Checkout</button>
						</div>
						';
					}


		
else {


	echo '</div><div class="order">
						<p><B>NOTE:</B> You must have atleast 1 product in your cart in order to place an order</p>	
						</div>';


		
}


?>
