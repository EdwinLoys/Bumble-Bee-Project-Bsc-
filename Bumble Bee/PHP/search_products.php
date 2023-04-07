<?php
 	include '../Includes/connection.php';

$search= $_GET['q'];


$sql= "SELECT * FROM shirts_tbl INNER JOIN shirt_details ON shirts_tbl.product_id = shirt_details.PID WHERE ProductName  LIKE '%$search%'";
if($res= mysqli_query($conn, $sql)){
  $imgPath= "../images/Product_Images/";
  echo '<div class="container">
    <div class="row ">

  ';
  while($row =mysqli_fetch_array($res)) {
     echo   '
     <div class="col-sm">
       <div class="img-wrap">
         <img src="'.$imgPath.''.$row['ProductImage'].'">
         <figcaption>
           <center>
             <p1 data-toggle="tooltip" data-placement="right" title="Click to View more">
             <a href="Product_details.php?view&productid='.$row['PID']."&size=".$row['Size'].'" class="title">
               '.ucfirst($row['ProductName']).'</a></p1>
           </center>
        
         </figcaption>
         <div class="buttons-position">
         <input type="hidden" name="quantity" value="1" min="1">
           <input type="hidden" id="id'.$row['PID'].'" value="'.$row['PID'].'">
           <input type="hidden" id="img'.$row['PID'].'" value="'.$row['ProductImage'].'">
           <input type="hidden" id="name'.$row['PID'].'" value="'.$row['ProductName'].'">
           <input type="hidden" id="size'.$row['PID'].'" value="'.$row['Size'].'">
           <input type="hidden" id="quantity" value="1">
           <input type="hidden" id="price'.$row['PID'].'" value="'.$row['Price'].'">

           <center>
           <p>Price Rs:'.$row['Price'].'</p>
             <button type="button" class="dir_addtocart" id="'.$row['PID'].'">Add to cart</button>
           </center>

         </div>

       </div>
     </div>';
  }
  echo '  </div>

  </div>';
}else {
  
  echo '
  <center>
  <p>Sorry no results were found</p>
    
  </center>';
}
