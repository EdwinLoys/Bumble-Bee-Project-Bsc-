<?php
 	include '../Includes/connection.php';
 // require '../Includes/navbar.php';

 ?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Products page </title>
<!-- Bootstrap4 files-->
<script src="../assets_3/js/bootstrap.bundle.min.js" type="text/javascript"></script>
 <link href="../assets_3/css/bootstrap.css" rel="stylesheet" type="text/css"/>

<!-- custom style -->
<link href="../assets_3/css/ui.css" rel="stylesheet" type="text/css"/> 
<link href="../assets_3/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
	<link type="text/css" href="../assets/css/argon.css" rel="stylesheet">

<!-- custom javascript -->
<!-- <script src="../assets_3/js/script.js" type="text/javascript"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
    <input type="text" id="search" >

    <div class="w-100">

    </div>
    <section class="section-content">
      <div class="container">


        <div class="row-sm" id="results">
          <?php

          $sql= "SELECT * FROM products_details INNER JOIN products_tbl ON products_details.PID = products_tbl.product_id LIMIT 10";
          $res= mysqli_query($conn, $sql);
          $imgPath= "../images/Product_Images/";
          while ($row= mysqli_fetch_array($res)) {
            ?>


            <div class="col-md-3 col-sm-6">
              <figure class="card card-product">
                <div class="img-wrap"> <img src="<?php echo $imgPath.''.$row['ProductImage']; ?>"></div>
                <figcaption class="info-wrap">

                  <a href="productdetails.php?view&productid=<?php echo $row['PID']."&size=".$row['Size'];?>" class="title">
                    <?php echo ucfirst($row['ProductName']).' '.ucfirst($row['Flavour']); ?></a>

                    <div class="price-wrap">
                      <p class="productnames"> Rs. <?php echo $row['Price']; ?></p>
                      <p class="productnames"> <?php if($row['Quantity']>0) echo "In stock : ".$row['Quantity']; ?></p>

                    </div>


                  </figcaption>
                </figure>
              </div>

              <?php
            }

            ?>
        </div>

      </section>


<script>

$(document).ready(function(){
  $("#search").keyup(function(){
    var x = $("#search").val();
    // if (x.length>0) {
      $.ajax({
        type:'GET',
        url:'../PHP/search_products.php',
        data:'q='+x,
        success:function(data){

              $("#results").html(data);
          //
          // console.log(data);
        }
      });
    // }
  });


});

</script>
<!-- <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/nouislider/distribute/nouislider.min.js"></script>
  <!- Argon JS -->
  <!-- <script src="../assets/js/argon.js"></script> -->
</body>
</html>
