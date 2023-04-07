<?php
    require '../../Includes/connection.php';

      if (isset($_POST['btnAddproduct'])) {

        $productname = mysqli_real_escape_string($conn,$_POST['productName']);
        $brand= mysqli_real_escape_string($conn,$_POST['productBrand']);
        $type = mysqli_real_escape_string($conn,$_POST['productType']);
        $desc = mysqli_real_escape_string($conn,$_POST['productDesc']);

        /*Details*/
        $pprice= $_POST['productPrice'];
        $pquantity= $_POST['productQuantity'];
        $psize= $_POST['productSize'];
        $image_name= $_FILES['PimgSelector']['name'];
        $image_temp= $_FILES['PimgSelector']['tmp_name'];
        $image_type= $_FILES['PimgSelector']['type'];
        $image_size= $_FILES['PimgSelector']['size'];
        $image_error= $_FILES['PimgSelector']['error'];

          if (empty($productname)) {
            header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=product-name&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
            exit();
          }
          elseif (empty($brand)) {
            header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=Brand&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
            exit();
          }
          elseif (empty($type)) {
            header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=Product-type&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
            exit();
          }
          elseif (empty($desc)) {
            header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=Description&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
            exit();
          }
          elseif (empty($pprice)) {
            header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=price&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
            exit();
          }
          elseif(empty($psize)) {
            header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=size&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
            exit();
          }
          elseif(empty($pquantity)) {
            header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=quantity&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
            exit();
          }
          elseif(!file_exists($image_temp)) {
              header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=file-empty&pname=".$productname."&flavour=".$flavour."&desc=".$desc."&quantity=".$pquantity."&price=".$pprice);
              exit();
          }

          else {
            $check="SELECT * FROM shirts_tbl WHERE ProductName=? ;";
            //prepared statement
            $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$check)) {
                      echo "Error requesting database";
                }else {
                  mysqli_stmt_bind_param($stmt, "s", $productname);
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);
                  $row= mysqli_fetch_assoc($result);
                  if ($row>1) {
                    header("Location:../../FRONTEND/ADMIN/manage-products.php?error=product-already-exists");
                    exit();
                  }
                else {
                  $products= "INSERT INTO shirts_tbl(productName, Brand ,ProductType, Description)
                  VALUES (?,?,?,?)";

                      $stmt=mysqli_stmt_init($conn);

                          if (!mysqli_stmt_prepare($stmt,$products)) {
                              header("Location:../../FRONTEND/ADMIN/manage-products.php?error");
                                exit();
                          }else {
                            mysqli_stmt_bind_param($stmt, "siis", $productname,$brand,$type,$desc);

                            if(!mysqli_stmt_execute($stmt)){

                              header("Location:../../FRONTEND/ADMIN/manage-products.php?error=failed-to-add");
                              exit();
                              echo "Error inserting data: ".mysqli_error($conn);

                              }
                              else{

                               $last_id = mysqli_insert_id($conn);
                                $imgExt=explode('.',$image_name);
                                $imgActualExt=strtolower(end($imgExt));
                                $allowedExt='png';



                                  if ($imgActualExt!=$allowedExt) {
                                    header("Location:../../FRONTEND/ADMIN/manage-products.php?error=invalid-file-type");
                                    exit();
                                  }else {

                                      $imageFullName= $productname."-".$psize."-".uniqid("",true).".".$imgActualExt;
                                      $imgPath="../../images/Product_Images/".$imageFullName;

                                      $product_details="INSERT INTO shirt_details( `PID`, `Size`, `Price`, `ProductImage`, `Quantity`)
                                       VALUES (?,?,?,?,?)";

                                       $stmt=mysqli_stmt_init($conn);

                                           if (!mysqli_stmt_prepare($stmt,$product_details)) {
                                               header("Location:../../FRONTEND/ADMIN/manage-products.php?error");
                                                 exit();
                                           }else {
                                             mysqli_stmt_bind_param($stmt, "isdsd", $last_id, $psize,$pprice,$imageFullName,$pquantity);

                                             if(!mysqli_stmt_execute($stmt)){

                                               header("Location:../../FRONTEND/ADMIN/manage-products.php?error=failed-to-add");
                                               exit();
                                               echo "Error inserting data: ".mysqli_error($conn);

                                             }else {
                                               move_uploaded_file($image_temp,$imgPath);
                                               header("Location:../../FRONTEND/ADMIN/manage-products.php?added-successfully&id=".$productname);
                                               exit();
                                             }

                                        }
                                    }



                                }
                              }
                }
          }

          }
              mysqli_close($conn);
       }

     ?>
