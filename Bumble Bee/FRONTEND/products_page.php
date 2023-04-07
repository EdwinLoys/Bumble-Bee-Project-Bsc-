<?php
 	include '../Includes/connection.php';
  require '../Includes/navbar1.php';

 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Shirts</title>
	<link type="text/css" rel="stylesheet" href="../CSS/products.css">

  <link rel="stylesheet" type="text/css" href="../CSS/footer.css">


<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<!-- Icons -->
<link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../assets/css/argon.css" rel="stylesheet">
	<link type="text/css" href="../Libraries/UI-Accordion-master/UI-Accordion-master/accordion.css">

</head>

<body>



<center>
    <div class="full">



    		<div class="filter-bar">
    				<div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
    					<h1>Filter by: </h1>
                  <button class="accordion">Shirts Brands</button>
                    <div class="panel">

    									<?php

    									$query = "SELECT * FROM product_brands";
    									$statement = mysqli_query($conn, $query);


    									while(  $row = mysqli_fetch_array($statement))
    									{
    									?>
    								<div class="list-group-item checkbox custom-checkbox">
    									<label><input type="checkbox" class="common_selector brand" value="<?php echo $row['BrandID']; ?>"  > <?php echo $row['BrandName']; ?></label>
    								</div>
    								<?php
    							}

    							?>

    					</div>
              <button class="accordion">Type</button>
                <div class="panel">

    						<?php

    						$query = "
    						SELECT * FROM shirt_type
    						";
    						$statement = mysqli_query($conn,$query);

    						while($row = mysqli_fetch_array($statement))
    						{
    						?>
    						<div class="list-group-item checkbox">
    						<label><input type="checkbox" class="common_selector type" value="<?php echo $row['PTID']; ?>" > <?php echo $row['ProductType']; ?></label>
    					</div>
    					<?php
    				}

    				?>


    		</div>
    </div>
    </div>



    <div class="search-bar">

      <input type="text" class="search" id="search" placeholder="Search" >

    </div>


    <center>

          <div class="heading">

      				<h1>
						  shirts
					  </h1> <span><hr></span>
      		</div>

    </div>
  </center>
<center>
			<div class="products filter_data">
<!-- products come here -->
			</div>
</center>





		     <!-- Core -->
<script src="../Bootsrap/argon-dashboard-master/argon-dashboard-master/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../Bootsrap/argon-dashboard-master/argon-dashboard-master/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../Bootsrap/argon-dashboard-master/argon-dashboard-master/assets/js/argon.min.js"></script>

<script src="../JavaScript/add_to_cart.js"></script>

	<script src="../Libraries/UI-Accordion-master/UI-Accordion-master/accordion.js"></script>
	<script src="../Libraries/UI-Accordion-master/UI-Accordion-master/index.js"></script>
	<script src="../Libraries/UI-Accordion-master/UI-Accordion-master/package.js">
	</script>

	<script>

	$(document).ready(function(){
	  $("#search").keyup(function(){
	    var x = $("#search").val();

	      $.ajax({
	        type:'GET',
	        url:'../PHP/search_products.php',
	        data:'q='+x,
	        success:function(data){

	              $(".filter_data").html(data);

	        }
	      });

	  });


	});

	</script>

	<script>
	$(document).ready(function(){

	    filter_data();

	    function filter_data()
	    {
	        $('.filter_data').html('<div id="loading" style="" ></div>');
	        var action = 'fetch_data';
	        var minimum_price = $('#hidden_minimum_price').val();
	        var maximum_price = $('#hidden_maximum_price').val();
	        var brand = get_filter('brand');
	        var type = get_filter('type');
	        $.ajax({
	            url:"../PHP/fetch_products.php",
	            method:"POST",
	            data:{action:action,
	              minimum_price:minimum_price,
	               maximum_price:maximum_price,
	               brand:brand,
	               type:type, },
	            success:function(data){
	                $('.filter_data').html(data);
	            }
	        });
	    }

	    function get_filter(class_name)
	     {
	         var filter = [];
	         $('.'+class_name+':checked').each(function(){
	             filter.push($(this).val());
	         });
	         return filter;
	     }

	     $('.common_selector').click(function(){
	         filter_data();
	     });


	    $('#price_range').slider({
	        range:true,
	        min:200,
	        max:5000,
	        values:[200, 5000],
	        step:500,
	        stop:function(event, ui)
	        {
	            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
	            $('#hidden_minimum_price').val(ui.values[0]);
	            $('#hidden_maximum_price').val(ui.values[1]);
	            filter_data();
	        }
	    });

	});
	</script>

  <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
<?php require '../Includes/footer.php'; ?>
</body>
</html>
