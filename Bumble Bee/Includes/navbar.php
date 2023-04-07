<?php
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../CSS/navigationBar.css">
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
										<ul>
												<li  ><a class="hvr-radial-out hvr-pop" href="../FRONTEND/newhomepage.php" >Home</a></li>
												<li  ><a class="hvr-radial-out2 hvr-pop" href="../FRONTEND/products_page.php" >Product</a></li>
												<li  ><a class="hvr-radial-out3 hvr-pop" href="../FRONTEND/Personalisepackage.php" >Personalise Order</a></li>
												<li  ><a class="hvr-radial-out4 hvr-pop" href="../FRONTEND/Contactpage.php" >Contact us</a></li>
												<li  ><button class="button-cart"><i class="fas fa-shopping-cart" width="25" height="25" alt=""></i>  </button></li>

												   <li>   <a href="../FRONTEND/profile_page.php?action=view&id='.$_SESSION['customer_id'].'" >My Account</a></li>

										 </ul>
									';
									#<li><a class="dropbtn hvr-radial-out3 hvr-pop " href="Logout.php" >My Account</a></li>

							}
								else {
									echo '

											<ul>
											<li  ><a class="hvr-radial-out hvr-pop" href="../FRONTEND/newhomepage.php" >Home</a></li>
											<li  ><a class="hvr-radial-out2 hvr-pop" href="../FRONTEND/products_page.php" >Product</a></li>
											<li  ><a class="hvr-radial-out3 hvr-pop" href="../FRONTEND/Personalisepackage.php" >Personalise Order</a></li>
											<li  ><a class="hvr-radial-out4 hvr-pop" href="../FRONTEND/Contactpage.php" >Contact us</a></li>
											 	<li  ><button class="button-cart"><img src="../CSS/Icons/basket-plus.png" width="25" height="25" alt=""/>  </button></li>
											 	<li ><a class="hvr-radial-out3 hvr-pop" href="../FRONTEND/LoginandRegister.php" >Login or Register</a></li>
										   </ul>

										';
								}


									?>

<?php
require 'shopping_cart.php';
 ?>


	</body>
</html>
