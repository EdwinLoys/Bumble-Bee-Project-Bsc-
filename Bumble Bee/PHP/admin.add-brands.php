<?php
require '../Includes/connection.php';

  if (isset($_POST['new-brand-btn'])) {

      $brandname=mysqli_real_escape_string($conn, $_POST['brand-name']);

      $file=$_FILES['imgSelector'];
      $imgName=$file['name'];
      $imgType=$file['type'];
      $imgSize=$file['size'];
      $imgTempName=$file['tmp_name'];
      $imgError=$file['error'];

      $imgExt=explode('.',$imgName);
      $imgActualExt=strtolower(end($imgExt));
      $allowedExt='png';

      $imageFullName= $brandname.".".$imgActualExt;

      $imgPath="../images/Brand_Images/".$imageFullName;



      if (!empty($brandname)) {
        if(!file_exists($imgTempName)) {
            header("Location:../FRONTEND/ADMIN/manage-products.php?empty=file-empty");
            exit();
        }
            else {
              $imgExt=explode('.',$imgName);
              $imgActualExt=strtolower(end($imgExt));
              $allowedExt='png';
            if ($imgActualExt!=$allowedExt) {
              header("Location:../FRONTEND/ADMIN/manage-products.php?error=file-invalid");
              exit();
            }else {
              $sql = "SELECT * FROM product_brands WHERE BrandName=?";
              //prepared statement
              $stmt=mysqli_stmt_init($conn);
              //prepare the prepared PDOStatement
                  if (!mysqli_stmt_prepare($stmt,$sql)) {
                        echo "Error requesting database";
                  }else {
                    mysqli_stmt_bind_param($stmt, "s", $brandname);
                    mysqli_stmt_execute($stmt);
                    $check = mysqli_stmt_get_result($stmt);
                    $row= mysqli_fetch_assoc($check);
                    if ($row>1) {
                      header("Location:../FRONTEND/ADMIN/manage-products.php?error=brand-exists");
                      exit();
                    }else {
                       $uploads="INSERT INTO product_brands (BrandName,BrandImage)
                       VALUES('$brandname','$imageFullName')";
                       if(!mysqli_query($conn, $uploads)){
                         header("Location:../FRONTEND/ADMIN/manage-products.php?error=failed-to-add");

                         echo "Error inserting data: ".mysqli_error($conn);
                         }else{
                             move_uploaded_file($imgTempName,$imgPath);
                             header("Location:../FRONTEND/ADMIN/manage-products.php?added-brand&brand=".$brandname);
                             exit();
                           }

                       mysqli_close($conn);
                     }

                   }

            }

            }
  }else{
    header("Location:../FRONTEND/ADMIN/manage-products.php?empty=brandname");
}

}
 ?>
