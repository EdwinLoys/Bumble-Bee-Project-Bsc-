<?php
	session_start();
require '../../Includes/connection.php';
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Orders | Admin</title>
	<link type="text/css" rel="stylesheet" href="../../CSS/ADMIN/manageorderstyle.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../../assets/css/argon.css" rel="stylesheet">


</head>

<body>
	    <?php if (isset($_SESSION['admin_'])) {
      require '../../Includes/admin.navbar.php';

      ?>


	<div class="header">
	<h1>Manage Orders | Admin</h1>

	</div>

	<div class="pending-order-tab">


	<div class="pending-order-header">
			<h>Pending Orders</h>

		</div>
		<div class="pending-order-table">
<form class="" action="../../PHP/ADMIN/admin.process-orders.php" method="post">


		<div class="table-responsive">
    <table class="table align-items-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Customer Service</th>
            <th scope="col">Date Of Order</th>
            <th scope="col">Products</th>
            <th scope="col">Delivery Details</th>
			<th scope="col">Order Status</th>
			<th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

            <?php
              $order="SELECT * FROM orders_tbl where OrderStatus='Processing' ";
              $result= mysqli_query($conn,$order);


              while($row=mysqli_fetch_array($result)){

                $sql="SELECT * FROM customers_tbl WHERE CustomerID=".$row['CID'];
                $res= mysqli_query($conn, $sql);
                $fname ='';
                $lname='';
                while ($user_details= mysqli_fetch_assoc($res)) {
                  $fname= $user_details['Firstname'];
                  $lname=$user_details['Lastname'];
                }
            ?>
           <tr>
			    <input type="hidden" name="order_id" value="<?php echo $row['Order_id']; ?>">
                <td><?php echo $row['Order_id']; ?></td>
                <td><?php echo $fname.' '.$lname; ?></td>
                <td><?php echo $row['DateOfOrder']; ?></td>
                <td><button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#modal-default<?php echo $row['Order_id'];?>">Check</button></td>
 				<td><button type="button" class="btn btn-sm btn-info mb-3" data-toggle="modal" data-target="#modal-default1<?php echo $row['Order_id'];?>">Check</button></td>
				 <td>
                <span class="badge badge-dot mr-4">
                  <i class="bg-success"></i> pending
                </span>

            </td>
						<td>
							<button type="submit"  class="btn btn-sm btn-primary mb-3" name="process-order">Process order</button>
						</td>
        </tr>

      <?php }?>
    </tbody>
</table>

</div>
</form>

		</div>



	</div>


	<div class="placed-order-tab">

	<div class="placed-order-header">

			<h>Placed Orders</h>
			<div class="table-responsive">
	    <table class="table align-items-center">
	    <thead class="thead-light">
	        <tr>
	            <th scope="col">Order ID</th>
	            <th scope="col">Customer Service</th>
	            <th scope="col">Date Of Order</th>
	            <th scope="col">Products</th>
	            <th scope="col">Delivery Details</th>
				<th scope="col">Order Status</th>
				<th scope="col"></th>
	            <th scope="col"></th>
	        </tr>
	    </thead>
	    <tbody>

	            <?php
	              $order="SELECT * FROM orders_tbl where OrderStatus='Processed' ORDER BY Order_id DESC";
	              $result= mysqli_query($conn,$order);


	              while($row=mysqli_fetch_array($result)){

	                $sql="SELECT * FROM customers_tbl WHERE CustomerID=".$row['CID'];
	                $res= mysqli_query($conn, $sql);
	                $fname ='';
	                $lname='';
	                while ($user_details= mysqli_fetch_assoc($res)) {
	                  $fname= $user_details['Firstname'];
	                  $lname=$user_details['Lastname'];
	                }
	            ?>
	           <tr>
				    <input type="hidden" name="order_id" value="<?php echo $row['Order_id']; ?>">
	                <td><?php echo $row['Order_id']; ?></td>
	                <td><?php echo $fname.' '.$lname; ?></td>
	                <td><?php echo $row['DateOfOrder']; ?></td>
	                <td><button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#modal-default<?php echo $row['Order_id'];?>">Check</button></td>
	 				<td><button type="button" class="btn btn-sm btn-info mb-3" data-toggle="modal" data-target="#modal-default1<?php echo $row['Order_id'];?>">Check</button></td>
					 <td>
	                <span class="badge badge-dot mr-4">
	                  <i class="bg-success"></i> completed
	                </span>

	            </td>
	        </tr>

	      <?php }?>
	    </tbody>
	</table>

	</div>


		</div>


	</div>

<!-- products details modal -->
<?php
$sql2="SELECT * FROM orders_tbl";
$res2= mysqli_query($conn, $sql2);

while ($get= mysqli_fetch_assoc($res2)) {

 ?>

	 <div class="modal fade" id="modal-default<?php echo $get['Order_id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">


            <div class="modal-body">

			<div class="table-responsive">
					<table class="table align-items-center">
					<thead class="thead-light">
						<tr>
							<th scope="col">Product Name</th>
							<th scope="col">Quantity Ordered</th>

						</tr>
					</thead>
					<tbody>

						               <?php


				  $order_detail="SELECT * FROM  order_details WHERE Order_id=".$get['Order_id'];
				  
                  if($res1= mysqli_query($conn,$order_detail)){
                    while($row1=mysqli_fetch_array($res1)){
					  $size= $row1['p_size'];
					  $order_id = $row1['product_id'];
						if ($order_id <= 49){

							$products="SELECT * FROM shirt_details INNER JOIN shirts_tbl ON shirt_details.PID = shirts_tbl.product_id WHERE product_id=".$row1['product_id']." AND Size='$size'";
							$res= mysqli_query($conn,$products);
						  
	  
	  
							while($row2=mysqli_fetch_array($res)){
	  
							  echo   '<tr><td>'.$row2['ProductName'].' </td> ';
							   echo  '<td>  '.$row1['p_quantity'].'</td></tr>';
	  
	  
							}
						
						}

                     
					  else {



						$productss="SELECT * FROM trouser_details INNER JOIN trouser_tbl ON trouser_details.TID = trouser_tbl.Trouser_id WHERE Trouser_id=".$row1['product_id']." AND Size='$size'";
							$ress= mysqli_query($conn,$productss);
						  
	  
	  
							while($row4=mysqli_fetch_array($ress)){
	  
							  echo   '<tr><td>'.$row4['TrouserName'].' </td> ';
							   echo  '<td>  '.$row1['p_quantity'].'</td></tr>';
	  
	  
							}
						

					  }
					  


                    }

			
					  


				

                  }else {
                    echo mysqli_error($conn);
                  }


                   ?>
					</tbody>
				</table>
</div>
            </div>


        </div>
    </div>
</div>
<?php } ?>

<!-- //delivery details -->
<?php
$sql2="SELECT * FROM orders_tbl";
$res2= mysqli_query($conn, $sql2);

while ($get= mysqli_fetch_assoc($res2)) {

 ?>
	 <div class="modal fade" id="modal-default1<?php echo $get['Order_id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-body">
							<div class="table-responsive">
								<table class="table align-items-center">
									<thead class="thead-light">
										<tr>
											<th scope="col">City</th>
											<th scope="col">Address</th>
											<th scope="col">Apartment Number</th>
											<th scope="col">Ctc Number</th>
										</tr>
    </thead>
    <tbody>

        <tr>
<?php
$delivery_details="SELECT * FROM delivery_address WHERE order_id=".$get['Order_id'];
$res= mysqli_query($conn,$delivery_details);
while($row3=mysqli_fetch_array($res)){

	echo "<td>".$row3['city']."</td>";
	echo "<td>".$row3['address']."</td>";
	echo "<td>".$row3['appartment']."</td>";
	echo "<td>".$row3['ctc_number']."</td>";


}

 ?>
</tr>
</tbody>
</table>

</div>
</div>

</div>
</div>
</div>

<?php } ?>






	  <!-- Core -->
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../../assets/js/argon.min.js"></script>

	  <?php
}
    elseif (!isset($_SESSION['admin_'])) {
		header("location:index.php");
    }

       ?>
</body>
</html>
