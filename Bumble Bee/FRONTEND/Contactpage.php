<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact page</title>
	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >
	<link rel="stylesheet" type="text/css" href="../CSS/footer.css">
	<!-- Css links -->
	<link type="text/css" rel="stylesheet" href="../CSS/contactStyle.css">
	<link rel="stylesheet" type="text/css" href="../CSS/footer.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){

				$("#send-message").click(function(event){
					event.preventDefault();
					var firstname= $("#fname").val();
					var lasttname= $("#lname").val();
					var email= $("#mail").val();
					var message= $("#sender_msg").val();
					var action='send_message';
					$.ajax({
						url: "../PHP/send_message.php",
						method: "POST",
						data: {
							firstname:firstname,
							lastname:lasttname,
							email:email,
							message:message,
							action:action
						},
						success:function(result){
							console.log(result);
							clear();			

								var x= JSON.parse(result);
								swal({
									title: x.title,
									text: x.message,
									icon: x.response,
								});

						}
					});

				});
				});


			function clear(){ 
            document.getElementById('fname').value=''; 
            document.getElementById('lname').value=''; 
			document.getElementById('mail').value=''; 
            document.getElementById('sender_msg').value=''; 
            
            } 
</script>


</head>

<body>

<?php
 	require '../Includes/navbar1.php';
 ?>


<canvas id="canvas-basic"></canvas>

	<div class="text-section">

			<section class="slogan">
						<h1>Drop by now and again</h1>
						
			</section>

			<section class="placeholder">
			<div class="icon"><i class="fas fa-address-card" style="margin:10px;"></i><p2>Address </p2></div>
						<p>40 Main St, Colombo 01100</p>
			</section>

			<section class="placeholder">
			<div class="icon"><i class="fas fa-phone" style="margin:10px;"></i><p2>Phone<br></p2></div>		
						<p>077 765 9876</p>
			</section>

			<section class="placeholder">
			<div class="icon"><i class="fas fa-question-circle" style="margin:10px;"></i><p2>General support<br></p2></div>
						<p>supportfashionboys@gmail.com</p>
			</section>


	</div>

	<section class="form-section">
	
	
		<form class="form" id="feedback-form" method="post">

						

				<input class="hvr-glow" type="text" name="firstname" id="fname" placeholder="First name">
				<input class="hvr-glow" type="text" name="lastname"  id="lname" placeholder="Last name">
				<input class="hvr-glow" type="text" name="email" id="mail" placeholder="Email">
				<textarea class="hvr-glow" placeholder="Message" id="sender_msg" name="sender-msg" width="100px"></textarea>
			<button type="submit" name="send-msg" id="send-message">Send</button>
		</form>

		<div class="social-media">
			<i href="https://www.instagram.com/sajid.___.haniff/?hl=en" class="fab fa-instagram"></i>
			<i class="fab fa-facebook-f"></i>
			<i class="fab fa-whatsapp"></i>
		</div>
	</section>

	<!-- <?php require '../Includes/footer.php'; ?> -->


	<!-- script links -->
<script type="application/javascript" src="../Libraries/granim.js-2.0.0/granim.js-2.0.0/dist/granim.js"></script>
     <!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../assets/js/argon.min.js"></script>

<script>

	var granimInstance = new Granim({
    element: '#canvas-basic',
    direction: 'diagonal',
    isPausedWhenNotInView: true,
    states : {
        "default-state": {
            gradients: [
				['#000080', '#000080']
            ]
        }
    }
});

	</script>

</body>
</html>
