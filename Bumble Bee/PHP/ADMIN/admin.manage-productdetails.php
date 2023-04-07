<?php
    require '../../Includes/connection.php';
              if (isset($_POST['add-psizes'])) {
                $pid= $_POST['productName'];
                $pprice= $_POST['productPrice'];
                $pquantity= $_POST['productQuantity'];
                $psize= $_POST['productSize'];
                $image_name= $_FILES['PimgSelector']['name'];
                $image_temp= $_FILES['PimgSelector']['tmp_name'];
                $image_type= $_FILES['PimgSelector']['type'];
                $image_size= $_FILES['PimgSelector']['size'];
                $image_error= $_FILES['PimgSelector']['error'];


                if (empty($pid)) {
                  header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=ID");
                  exit();
                }
                if(empty($psize)) {
                  header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=size");
                  exit();
                }
                elseif(empty($pquantity)) {
                  header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=quantity");
                  exit();
                }
                elseif(empty($pprice)) {
                  header("Location:../../FRONTEND/ADMIN/manage-products.php?empty=price");
                  exit();
                }
                  else {

                    $sql= "SELECT * FROM products_tbl WHERE Product_id=".$pid.";";
                    $records= mysqli_query($conn, $sql);

                   if($row= mysqli_fetch_array($records)){
                     $imgExt=explode('.',$image_name);
                     $imgActualExt=strtolower(end($imgExt));
                     $allowedExt='png';
                    $imageFullName= $row['ProductName']."-".$row['Flavour']."-".$psize."-".uniqid("",true).".".$imgActualExt;
                    $imgPath="../../images/Product_Images/".$imageFullName;

                      $check_ifexists="SELECT * FROM products_details WHERE PID=".$pid." AND Size='".$psize."'";

                      $records=mysqli_query($conn,$check_ifexists);

                        $results=mysqli_fetch_array($records);


                        if ($results>1){
                            header("Location:../../FRONTEND/ADMIN/manage-products.php?error=product-already-exists");
                            exit();
                          }else {
                                if ($imgActualExt!=$allowedExt) {
                                  header("Location:../../FRONTEND/ADMIN/manage-products.php?error=invalid-file-type");
                                  exit();
                                }else {
                                  $product_details="INSERT INTO products_details( `PID`, `Size`, `Price`, `ProductImage`, `Quantity`)
                                   VALUES (?,?,?,?,?)";

                                   $stmt=mysqli_stmt_init($conn);

                                       if (!mysqli_stmt_prepare($stmt,$product_details)) {
                                           header("Location:../../FRONTEND/ADMIN/manage-products.php?error");
                                             exit();
                                       }else {
                                         mysqli_stmt_bind_param($stmt, "isdsd", $pid, $psize,$pprice,$imageFullName,$pquantity);

                                         if(!mysqli_stmt_execute($stmt)){

                                           header("Location:../../FRONTEND/ADMIN/manage-products.php?failed-to-add");
                                           exit();
                                           echo "Error inserting data: ".mysqli_error($conn);

                                         }else {
                                           move_uploaded_file($image_temp,$imgPath);
                                           header("Location:../../FRONTEND/ADMIN/manage-products.php?products-added-successfully");
                                           exit();
                                         }

                                    }
                                }
                    }
                  }
                  }

            }
?>
