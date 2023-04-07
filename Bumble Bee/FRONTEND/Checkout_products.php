<?php

session_start();
include '../Includes/connection.php';

if (isset($_SESSION['customer_id'])) {
  $sql="SELECT * FROM customers_tbl WHERE CustomerID=".$_SESSION['customer_id'];
  $res= mysqli_query($conn, $sql);
  $user_details=[];
  while ($row= mysqli_fetch_assoc($res)) {
    $user_details = array(
		
      'fname' =>  $row['Firstname'],
      'lname' => $row['Lastname'],
      'email' =>  $row['Email'],
      'city' =>  $row['City'],
      'address' => $row['StreetAddress']
   );

  }
}



 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Checkout</title>
	<link type="text/css" rel="stylesheet" href="../CSS/checoutstylev2.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../assets/css/argon.css" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
			 $(document).ready(function(){


				 $(document).on('click', '#place-order', function(event){
					 event.preventDefault();
					 var c_fname=$("#fname").val();
					 var c_lname=$("#lname").val();
					 var c_city=$("#city").val();
					 var c_address=$("#address").val();
					 var c_appartment=$("#appartment").val();
					 var c_ctc=$("#ctc_number").val();
					 var card_no=$("#card_no").val();
					 var card_ccv=$("#card_ccv").val();
					 var card_holder=$("#card_holder").val();
					 var card_expiry=$("#card_expiry").val();
					 var action = 'place-order';

						 $.ajax({
							 url:"../PHP/checkout.php",
							 method:"POST",
							 data:{
								 fname:c_fname,
								 lname:c_lname,
								 city:c_city,
								 address:c_address,
								 appartment:c_appartment,
								 contact_num:c_ctc,
								 card_no:card_no,
								 card_holder:card_holder,
								 card_ccv:card_ccv,
								 card_expiry:card_expiry,
								 action:action
							 },
							 success:function(result)
							 {
                 var output=JSON.parse(result);
                  console.log(result);
                 if (output.response=="success") {
                   swal({
                     title: output.title,
                     text: output.message,
                     icon: output.response

                   }).then(function(){
                     window.location.href = "../FRONTEND/products_page.php";
                 });
                }else {
                 swal({
                   title: output.title,
                   text: output.message,
                   icon: output.response

                 });
                }
							 }
						 })

				 });

			 });
</script>
</head>

<body>

	<div class="heading-tab">
		<center>
			<h1>Checkout</h1> <hr>
		</center>
	</div>

	<div class="billing-form">
		<div class="billing-details-form">
			<h1>Billing Details</h1>
			<form id="Checkout-form" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" id="fname" placeholder="Enter First Name" value="<?php echo $user_details['fname']; ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" id="lname" aria-describedby="name" placeholder="Enter Last name" value="<?php echo $user_details['lname']; ?>">
						</div>
					</div>
				</div>

		</div>
		<div class="street-address-form">
			<h1>Delivery Address</h1>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<textarea class="form-control" id="address" placeholder="Home Number and Street name"><?php echo $user_details['address']; ?></textarea>
						</div>
					</div>
				</div>
				<div class="row"> <div class="col-md-6">
					<div class="form-group">
<input type="text" class="form-control" id="city" placeholder="Town/City*" value="<?php echo $user_details['city']; ?>">

					</div>

				</div></div>
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<input type="text" class="form-control" id="appartment" aria-describedby="name" placeholder="Apartment, Suite, unit (optional)">
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<input type="text" class="form-control" id="ctc_number" placeholder="Phone Number (optional)">
						</div>
					</div>
				</div>

		</div>

		<div class="payment-details-form">
			<h1>Payment Credentials</h1>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control"   placeholder="Card Holder" id="card_holder" >
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control input" id="card_ccv"  placeholder="CVC">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control input"   placeholder="Card Number" id="card_no" >
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control input" id="card_expiry" name="expiry-data"    placeholder="00 / 00" >
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>




	<div class="table-form">

	<div class="table-placement">

		<div class="table-responsive">
    <table class="table align-items-center table-dark">
    <thead class="thead-dark">
    <tr>
						<th scope="col"></th>
            <th scope="col">Products</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Subtotal</th>
        </tr>


    </thead>
    <tbody>
			<?php

						$total_price = 0;
						$total_item = 0;
			if(!empty($_SESSION['cart']))
			{
				foreach($_SESSION['cart'] as $keys => $values)
				{
					echo '
					<tr>
					<td><div class="td_image"><img src="../images/Product_Images/'.$values["p_img"].'" width="50"></div></td>
					
					<td align="right">Rs '.$values["p_price"].'</td>
					<td>'.$values["p_quantity"].'</td>
					<td align="right">Rs'.number_format((int)$values["p_quantity"] * (int)$values["p_price"], 2).'</td>

					</tr>
					';
					$total_price = $total_price + ((int)$values["p_quantity"] * (int)$values["p_price"]);
					$total_item = $total_item + 1;
				}

			}
			 ?>
			<tr>
			<td colspan="3" align="right">Total</td>
			<td align="right">  Rs <?php echo number_format($total_price, 2); ?></td>
			</tr>

    </tbody>
</table>

</div>


		</div>



		<div class="button-placement">

			<button type="submit" class="btn btn-primary" id="place-order">Place your order</button>
			<a href="javascript:history.go(-1)" class="btn btn-danger" id="cancel">Cancel</a>

		</div>

	</div>










	    <!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../assets/js/argon.min.js"></script>
</body>
</html>
