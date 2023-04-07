<?php

//fetch_data.php

require '../Includes/connection.php';

if(isset($_POST["action"]))
{
 $query = "
  SELECT * FROM trouser_details INNER JOIN trouser_tbl ON trouser_details.TID = trouser_tbl.Trouser_id  
  ";

 if(isset($_POST["brand"]))
 {
  $brand_filter =implode("','", $_POST["brand"]);
  $query .= "
   AND Brand  IN ('".$brand_filter."')
  ";
 }
 if(isset($_POST["type"]))
 {
  $type_filter =  implode("','", $_POST["type"]);
  $query .= "
   AND TrouserType IN('".$type_filter."')
  ";
 }
$res= mysqli_query($conn, $query);
if(mysqli_num_rows($res)>=1){
  $imgPath= "../images/Product_Images/";
  echo '<div class="container">
    <div class="row ">

  ';
  while($row =mysqli_fetch_array($res)) {
     echo   '
     <div class="col-sm">
       <div class="img-wrap">
       <Center>
         <img src="'.$imgPath.''.$row['ProductImage'].'">
         </center>
         <figcaption>
           <center>
             <p1 data-toggle="tooltip" data-placement="right" title="Click to View more">
             <a href="Trousers_details.php?view&productid='.$row['TID']."&size=".$row['Size'].'" class="title">
               '.ucfirst($row['TrouserName']).'</a></p1>
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
              <p>Price Rs:'.$row['Price'].'</p>
             <button type="submit" class="dir_addtocart" id="'.$row['TID'].'">Add to cart</button>
           </center>

           
          

         </div>

       </div>
     </div>';
  }
  echo '  </div>

  </div>';
}
else{
  echo 'Sorry we couldnt find any products for that quary';
  // $output= 'Sorry but we dont have any ';
  // $sql ="SELECT * FROM product_brands WHERE Brandid=".$brand_filter;
  // $res=mysqli_query($conn,$sql);
  // if ($row= mysqli_fetch_array($res)) {
  //   $output .=$row['BrandName'].' Brand ';
  // }
  //
  // $sql1 ="SELECT * FROM product_type WHERE PTID=".$type_filter;
  // $res1=mysqli_query($conn,$sql1);
  // if ($row1= mysqli_fetch_array($res1)) {
  //   $output .=$row1['ProductType'];
  // }
  //
  // echo $output;

}



}
