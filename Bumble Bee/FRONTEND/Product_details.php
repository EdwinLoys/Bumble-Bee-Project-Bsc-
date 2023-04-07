<?php
 	include '../Includes/connection.php';
  session_start();
 ?>

 <?php if (isset($_GET['view'])):

 	$imgPath= "../images/Product_Images/";

 				$pid = $_GET['productid'];
 				$size = $_GET['size'];

 				$product_dt= "SELECT * FROM shirts_tbl WHERE product_id=".$pid;
 				$res= mysqli_query($conn, $product_dt);
 				while ($row= mysqli_fetch_array($res)) {
 						$product_details = array(
 							'name' => $row['ProductName'],
 							'desc' => $row['Description'],
 							'brand' => $row['Brand'],
 							'type' => $row['ProductType']
 						);
 				}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $product_details[	'name'] ?></title>
	<link type="text/css" rel="stylesheet" href="../CSS/product_details.css">



<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


<!-- Icons -->
<link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../assets/css/argon.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="../Libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.css">

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../JavaScript/add_to_cart.js">

  </script>

	</head>
<body>

<?php
	echo '<form class="container" action="" method="post">';
	$sql= "SELECT * FROM shirt_details WHERE PID=".$pid." AND  Size='".$size."'";
	$res= mysqli_query($conn, $sql);
	while ($row= mysqli_fetch_array($res)) {

		?>
	<div class="product-details">
		<div class="products">

			<div class="product-image">

				<div class="img-wrap">

					<img src="<?php echo $imgPath.''.$row['ProductImage']; ?>">

				</div>

			</div>


			<div class="product-name-heading">
				<h1><?php echo ucfirst($product_details['name']) ?></h1>
				


				<div class="accordian-div">
					<p><?php echo ucfirst($product_details['desc']) ?></p>
					<h3>Rs
						<?php echo number_format($row['Price'], 2);?>
					</h3>
				</div>

				<div class="button-move">
					<button type="button" class="button" name="add-cart" id="add-cart">Add to cart</button>
				</div>
				<?php

					echo '<input type="hidden" name="quantity" value="1" min="1">
					<input type="hidden" id="id" value="'.$pid.'">
					<input type="hidden" id="img" value="'.$row['ProductImage'].'">
					<input type="hidden" id="name" value="'.$product_details['name'].'">
					
					<input type="hidden" id="size" value="'.$size.'">
					<input type="hidden" id="quantity" value="1">
					<input type="hidden" id="price" value="'.$row['Price'].'">';
					echo '</form>'

				 ?>

			</div>

		</div>
	</div>


	<div class="related-products-tab">

		<div class="related-products-heading">

			<center>
				<h1>Related Products</h1> <span><hr></span>
			</center>

		</div>

		<div class="carousal-tab">
			<div class="move-carousal">
				<div class="owl-carousel owl-theme">
					<?php
					$brand= $product_details['brand'];
					$ptype= $product_details['type'];
					$related_products="SELECT * FROM shirt_details INNER JOIN shirts_tbl ON shirt_details.PID = shirts_tbl.Product_id WHERE  ProductType='$ptype' LIMIT 10";
					$output=mysqli_query($conn, $related_products);
					while ($get = mysqli_fetch_array($output)) {

						echo '<div class="image-carousal-wrap">
            <img src="'.$imgPath.''.$get['ProductImage'].'">
            <center>
						 <a class="product_link" href="Product_details.php?view&productid='.$get['PID']."&size=".$get['Size'].'" class="title">
               '.ucfirst($get['ProductName']).'</a>
               </center>
               </div>';
					}
					 ?>

				</div>

			</div>
		</div>

	</div>
	<?php


} endif; ?>
			     <!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../assets/js/argon.min.js"></script>
<script src="../Libraries/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>


	<script>
	$(document).ready(function(){
		$('.owl-carousel').owlCarousel(
			{


				loop:true,
				items:3,
				margin:10,
				responsive:{
					600:{
						items:4
					}
				}
			}

		);
	});
	</script>

</body>
</html>
