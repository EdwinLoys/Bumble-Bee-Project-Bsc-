<!-- includes -->
<?php
session_start();
require '../../Includes/connection.php';

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Feedbacks</title>
	<link type="text/css" rel="stylesheet" href="../../CSS/ADMIN/adminfeedbackstyle.css">


<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../../assets/css/argon.css" rel="stylesheet">

</head>

<body>

	 <?php
	
require '../../Includes/admin.navbar.php';


	 if (isset($_GET['message'])) {
	   if ($_GET['message']=="error") {
	     echo '<div class="main"><br>
	     <h1>error mail not sent</h1></div>';
	   }
	   if ($_GET['message']=="empty") {
	     echo '<div class="main"><br>
	     <h1>please type a reply</h1></div>';
	   }
	   if ($_GET['message']=="sent") {
	     echo '<div class="main"><br>
	     <h1>your reply has been sent</h1></div>';
	   }
	 }

	 $sql= "SELECT * FROM feedbacks_tbl WHERE status='pending'";
	 if ($records= mysqli_query($conn, $sql)) {
		$row= mysqli_fetch_array($records);
	 }
	 else {
		 echo "prbm";
	 }
	
	 ?>


	<div class="header">

	<h1>View Feedbacks</h1>

	</div>


	<div class="feedback-section">


		<?php
		 while($row= mysqli_fetch_array($records))
		 {
?>
			<div class="col">
				<div class="card shadow">
					<div class="card-body">
						<div >
							<div class="card-box" >
								<input type="hidden" name="qid_" value="<?php echo $row['QID'];  ?>">
								<p><?php echo ucfirst($row['SenderFname']).' '.$row['SenderLname'];  ?></p>

								<p1><?php echo $row['SenderMessage']; ?></p1>

							</div>
						</div>
					</div>

				</div>
			</div>

		<?php 	 }

		 ?>

  </div>















		    <!-- Core -->
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../../assets/js/argon.min.js"></script>
</body>
</html>
