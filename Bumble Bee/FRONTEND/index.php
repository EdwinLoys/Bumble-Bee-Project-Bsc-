<?php
 	include '../Includes/connection.php';

 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home page</title>
	<link rel="stylesheet" type="text/css" href="../CSS/newhomepagestyle.css">
	<link rel="stylesheet" type="text/css" href="../CSS/footer.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<!-- Icons -->
<link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../assets/css/argon.css" rel="stylesheet">
<style>
  



.text1 {
  color: white;
  font-size: 100px;
  font-weight: bold;
  padding: 8px 12px;
  position: absolute;
  bottom: 2px;
  width: 100%;
  text-align: center;
  
}













</style>
</head>

<body>
	<?php
	 	require '../Includes/navbar1.php';
	 ?>

   <div class="home-contain">
     <div class="photo-div">	 
		  <div class="video">
 

 
  <img src="../images/banner images/ba00d55e39e2773d86955b71f6c0b72c.jpg" width="100%"   >
  <div class="text1">Bumble Bee</div>
<


</div>


  </div>
		 
		 
		 
     </div>


     <div class="services">
     
		 <div class="container">
		 
		 <div class="box">
			 
			 <div class="icon"><i class="fas fa-user"></i></div>
			 <div class="content">
				 <h3>Create Your account</h3>
				 <p>Create Your account and register to purchase the wide range of products available! </p>
				 <a href="LoginandRegister.php">Create Your Account!</a>
			 </div>
			 
			 
			 </div>
			 
			  <div class="box">
			 
			 <div class="icon"><i class="fas fa-shopping-basket"></i></div>
			 <div class="content">
				 <h3>Products</h3>
				 <p>From the first stitches to the last button there’s genuine work behind every single dress shirt and trousers we produce, with only you in mind.</p>
				 <a href="products_page.php">Go to products page</a>
			 </div>
			 
			 
			 </div>
			 
			 
			 
			  <div class="box">
			 
			 <div class="icon"><i class="fas fa-dollar-sign"></i></div>
			 <div class="content">
				 <h3>Unbeatable Price</h3>
				 <p>we take pride in offering our customers superior quality dress shirts at unbeatable prices</p>
				 <a href="trouser_page.php">Go to products  page</a>
			 </div>
			 
			 
			 </div>
		 
		 </div>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
     </div>

     <div class="section-4">
       <div class="text">
         <h1>Vision</h1>
         <p>Our vision is to be earth's most customer centric company; to build a place where people can come to find and discover anything they might want to buy online.</p>
         </div>
         <div class="text">
           <h1>Mission</h1>
           <p>Our Mission is to provide society with superior products and services, matched with affordable prices through the development of both local and international brands. We also strive to improve the lifestyles of our customers through our clothing. </p>
           </div>
         </div>
         <center>
           <div class="maps">
             <h1>We are here</h1>
             <div class="mapouter">
               <div class="gmap_canvas">
                 <iframe width="1080" height="336" id="gmap_canvas" src="https://maps.google.com/maps?q=AIzaSyBPHHFYNj0-uYQgr_hXviPYhxlI5B31m1I&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                 </div>
               </div>
             </div>
        </center>
   </div>

<?php require '../Includes/footer.php'; ?>


<!-- <script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script> -->


	    <!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../assets/js/argon.min.js"></script>
</body>
</html>
