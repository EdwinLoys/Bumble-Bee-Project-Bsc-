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
          </div>


        </figcaption>
      </figure>
    </div>

    <?php
  }

  ?>
