<?php
 	include '../Includes/connection.php';

$search= $_GET['q'];


$sql= " SELECT * FROM trouser_details INNER JOIN trouser_tbl ON trouser_details.TID = trouser_tbl.Trouser_id WHERE TrouserName  LIKE '%$search%'";
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
             <a href="Trousers_details.php?view&productid='.$row['TID']."&size=".$row['Size'].'" class="title">
               '.ucfirst($row['TrouserName']).'</a></p1>
               
           </center>
           <center>
           <p1> Rs '.ucfirst($row['Price']).'</p1>
           </center>
         </figcaption>
         <div class="buttons-position">
         <input type="hidden" name="quantity" value="1" min="1">
           <input type="hidden" id="id'.$row['TID'].'" value="'.$row['TID'].'">
           <input type="hidden" id="img'.$row['TID'].'" value="'.$row['ProductImage'].'">
           <input type="hidden" id="name'.$row['TID'].'" value="'.$row['TrouserName'].'">
           <input type="hidden" id="size'.$row['TID'].'" value="'.$row['Size'].'">
           <input type="hidden" id="quantity" value="1">
           <input type="hidden" id="price'.$row['TID'].'" value="'.$row['Price'].'">

           <center>
             <button type="button" class="dir_addtocart" id="'.$row['TID'].'">Add to cart</button>
           </center>

         </div>

       </div>
     </div>';
  }
  echo '  </div>

  </div>';
}else {
echo 'Sorry no results were found';
}
