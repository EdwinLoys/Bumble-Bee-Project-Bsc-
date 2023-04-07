<?php
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../CSS/navigationBar1.css">
		<link rel="stylesheet" href="../CSS/cartstyle.css">
		<link href="../Libraries/Hover-master/Hover-master/css/hover.css"   rel="stylesheet" media="all">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >

	</head>
	<body>
		<!-- naviagation bar -->
									<?php
							if (isset($_SESSION['customer_id'])) {
								echo '
								<div class="navigation">
									<ul>
										<li  ><a class="hvr-underline-from-center" href="../FRONTEND/index.php" >Home</a></li>
										<li  ><a class="hvr-underline-from-center" href="../FRONTEND/products_page.php" >Shirts</a></li>
										<li  ><a class="hvr-underline-from-center" href="../FRONTEND/trouser_page.php" >Trousers</a></li>
										<li  ><a class="hvr-underline-from-center" href="../FRONTEND/Contactpage.php" >Contact us</a></li>
										<li  ><button class="button-cart"><i class="fas fa-shopping-cart" width="25" height="25" alt=""></i></button></li>
										<li>   <a href="../FRONTEND/profile_page.php?action=view&id='.$_SESSION['customer_id'].'" >My Account</a></li>
									</ul>
								</div>
									';

							}
								else {
									echo '

									<div class="navigation">
										<ul>
											<li  ><a class="hvr-underline-from-center" href="../FRONTEND/index.php" >Home</a></li>
											<li  ><a class="hvr-underline-from-center" href="../FRONTEND/products_page.php" >Shirts</a></li>
											<li  ><a class="hvr-underline-from-center" href="../FRONTEND/trouser_page.php" >Trousers</a></li>	
											<li  ><a class="hvr-underline-from-center" href="../FRONTEND/Contactpage.php" >Contact us</a></li>
											<li  ><button class="button-cart"><i class="fas fa-shopping-cart" width="25" height="25" alt=""></i></button></li>
											<li ><a class="hvr-underline-from-center" href="../FRONTEND/LoginandRegister.php" >Login or Register</a></li>
										</ul>

									</div>

										';
								}


									?>

<?php
require 'shopping_cart.php';
 ?>



	</body>
</html>
