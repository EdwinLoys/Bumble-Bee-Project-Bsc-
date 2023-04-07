<?php
require '../../Includes/connection.php' ;

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Trousers | Admin</title>
  </head>
  <!-- Favicon -->
<link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../../assets/css/argon.css" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <body>
    <?php

      if (isset($_GET['action'])) {
        if ($_GET['action']=="edit") {
          $product_id =$_GET['productid'];
          $product_size =$_GET['size'];

?>
        <div class="row">
          <div class="col">
            <h1>Edit products</h1>
            <a class="back-link" href="manage-trouser.php">Back</a>
          </div>

        </div>
        <div class="container">
          <div class="card card-stats mb-4 mb-lg-0">
            <div class="card-body">
              <?php
              echo '<form  action="edit-trousers.php?action=edit&productid='.$product_id.'&size='.$product_size.'" method="post" enctype="multipart/form-data"> ';
              ?>
              <div class="row">
                <?php
                $sql="SELECT * FROM trouser_tbl WHERE Trouser_id=".$product_id.";";

                $result=mysqli_query($conn, $sql);

                while ($row= mysqli_fetch_array($result)) {

                  ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      echo 'Name:<input type="text"   class="form-control form-control-alternative"  id="exampleFormControlInput2" name="pname_" value="'.$row['TrouserName'].'">';
                      ?>
                    </div>
                  </div>
                
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      echo  'Description<textarea   class="form-control form-control-alternative" rows="3"  id="exampleFormControlInput2" name="pdesc_" >'.$row['Description'].'</textarea>';

                      ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">

                      <?php
                      echo  '<input type="hidden" name="pid_" value="'.$product_id.'">';
                      echo  '<input type="hidden" name="psize_" value="'.$product_size.'">';
                      echo 'Product Type<select name="productType_"  class="form-control form-control-alternative"  id="exampleFormControlInput2" >';

                        $ptype= "SELECT * FROM trouser_type WHERE PTID= ".$row['TrouserType'].";";
                        $product_tp_rec= mysqli_query($conn, $ptype);
                        if ($product_type_row= mysqli_fetch_array($product_tp_rec)) {
                          echo '<option value="'.$product_type_row['PTID'].'">'.$product_type_row['TrouserType'].'</option>';

                        }


                        $ptype= "SELECT * FROM trouser_type;";
                        $product_tp_rec= mysqli_query($conn, $ptype);
                        while ($product_type_row= mysqli_fetch_array($product_tp_rec)) {
                          echo '<option value="'.$product_type_row['PTID'].'">'.$product_type_row['TrouserType'].'</option>';

                        }
                        echo '</select>';

                        ?>

                      </div>
                    </div>

                </div>
                <div class="row">


                    <div class="col-md-6">
                      <div class="form-group">
                        <?php
                        echo 'Product Brand<select name="productBrand_"  class="form-control form-control-alternative"  id="exampleFormControlInput2" >';

                          $pbrands= "SELECT * FROM product_brands WHERE BrandID=".$row['Brand'].";";
                          $product_br_rec= mysqli_query($conn, $pbrands);
                          if ($product_brand_row= mysqli_fetch_array($product_br_rec)) {
                            echo  '<option value="'.$product_brand_row['BrandID'].'">'.$product_brand_row['BrandName'].'</option>';


                          }

                          $pbrands= "SELECT * FROM product_brands;";
                          $product_br_rec= mysqli_query($conn, $pbrands);
                          while ($product_brand_row= mysqli_fetch_array($product_br_rec)) {
                            echo  '<option value="'.$product_brand_row['BrandID'].'">'.$product_brand_row['BrandName'].'</option>';


                          }
                          echo '</select>';
                          ?>
                        </div>
                      </div>

                            <?php

                            $pdetails= "SELECT * FROM Trouser_details WHERE TID=".$product_id." AND Size='".$product_size."';";
                            $product_dt_rec= mysqli_query($conn, $pdetails);
                            $imgPath="../../images/Product_Images";
                            if ($product_dt_row= mysqli_fetch_array($product_dt_rec)) {
                              echo  '<input type="hidden"   class="form-control form-control-alternative"  id="exampleFormControlInput2" name="pimg_" value="'.$imgPath."/".$product_dt_row['ProductImage'].'">';

                              ?>
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php
                          echo  'Quantity<input type="number"   class="form-control form-control-alternative"  id="exampleFormControlInput2" name="pquantity_" value="'.$product_dt_row['Quantity'].'">';

                          ?>

                        </div>
                      </div>

                    </div>



                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <?php
                            echo  'Price<input type="number"  class="form-control form-control-alternative"  id="exampleFormControlInput2"  name="pprice_" value="'.$product_dt_row['Price'].'">';


                            ?>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <?php

                            echo '<input type="file" name="newImage"  class="form-control form-control-alternative"  id="exampleFormControlInput2 >';
                            ?>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <?php

                            echo  '<br>Image<br> <img name="pimg" src="'.$imgPath."/".$product_dt_row['ProductImage'].'" width=auto height=150px>';
                            ?>
                          </div>
                        </div>
                      </div>

                    <?php } ?>

                    <?php

                  }
                  ?>

                  <div class="col-md-6">
                    <div class="form-group">
                      <button type="submit" class="btn btn-warning" name="update-products">Save changes</button>
                    </div>
                  </div>

                </div>

              </div>
            </form>
          </div>
        </div>


<?php
        }
        //delete the product
        elseif ($_GET['action']=="delete") {
            $product_id =$_GET['productid'];
            $product_size =$_GET['size'];

            $pdetails= "SELECT * FROM trouser_details WHERE TID=".$product_id." AND Size='".$product_size."';";
            $product_dt_rec= mysqli_query($conn, $pdetails);
            $imgPath="../../images/Product_Images/";
            if ($product_dt_row= mysqli_fetch_array($product_dt_rec)) {
              $imageDel= $product_dt_row['ProductImage'];
            }

            $sql="SELECT * FROM trouser_details WHERE TID=".$product_id;
            if($islast=mysqli_query($conn,$sql)){
              $rowcount=mysqli_num_rows($islast);
            }else {
              echo "Error";
            }

            if ($rowcount==1) {

              $deletePr="DELETE FROM trouser_tbl WHERE Trouser_id=".$product_id;
              if(!mysqli_query($conn, $deletePr)){
               
                echo "Error deleting data: ".mysqli_error($conn);
                exit();
              }else{
                if(file_exists($imgPath.$imageDel)){
                  unlink($imgPath.$imageDel);
                }else {
                 echo "file is not present";
                }
                header("Location:manage-trouser.php?deleted&id=".$product_id);


              }
            }else {

              $delete="DELETE FROM trouser_details WHERE TID=".$product_id." AND Size='".$product_size."'";
              if(!mysqli_query($conn, $delete)){
                
                echo "Error deleting data: ".mysqli_error($conn);
                exit();
              }else{
                if(file_exists($imgPath.$imageDel)){
                  unlink($imgPath.$imageDel);
                }else {
                 echo "file is not present";
                }
                header("Location:manage-trouser.php?Product_deleted&id=".$product_id."&size=".$product_size);


              }
            }




        }
      }

     ?>

<!-- update php code -->
     <?php

       if (isset($_POST['update-products'])) {
      $pid  = $_POST['pid_'];
      $psize  = mysqli_real_escape_string($conn,$_POST['psize_']);
      $pdesc  = mysqli_real_escape_string($conn,$_POST['pdesc_']);
      $pname  = mysqli_real_escape_string($conn,$_POST['pname_']);
      $ptype  = mysqli_real_escape_string($conn,$_POST['productType_']);
      $pbrand  = mysqli_real_escape_string($conn,$_POST['productBrand_']);
      $pquantity  = mysqli_real_escape_string($conn,$_POST['pquantity_']);
      $oldImage  = mysqli_real_escape_string($conn,$_POST['pimg_']);
      $pprice  = mysqli_real_escape_string($conn,$_POST['pprice_']);

      $newImage= $_FILES['newImage']['name'];
      $image_temp= $_FILES['newImage']['tmp_name'];
      $image_type= $_FILES['newImage']['type'];
      $image_size= $_FILES['newImage']['size'];
      $image_error= $_FILES['newImage']['error'];

          if (empty($pname)) {
            echo '<script>
            swal({
              title: "Update",
              text: "Error: Product name is empty",
              icon: "warning",
            });
            </script>
            ';
            exit();
          }
         elseif (empty($pdesc)) {
           echo '<script>
           swal({
             title: "Update",
             text: "Error: Description is empty",
             icon: "warning",
           });
           </script>
           ';
           exit();
         }
      

         else {

              $update= "UPDATE trouser_tbl SET TrouserName=?,Description=?,TrouserType=?,Brand=? WHERE Trouser_id=?";
              $stmt=mysqli_stmt_init($conn);

                  if (!mysqli_stmt_prepare($stmt,$update)) {
                        echo "Error requesting database";
                  }else {
                    mysqli_stmt_bind_param($stmt, "ssiii", $pname,$pdesc,$ptype,$pbrand,$pid);
                    if(!mysqli_stmt_execute($stmt)){

                      header("Location:edit-trousers.php?Error-updating");
                      exit();
                      echo "Error updating data: ".mysqli_error($conn);
                      }
                      else{
                        //checks if a new image is selected
                        if (file_exists($image_temp)) {


                          $imgExt=explode('.',$newImage);
                          $imgActualExt=strtolower(end($imgExt));
                          $allowedExt='png';
                        if ($imgActualExt!=$allowedExt) {
                          echo '<script>
                          swal({
                            title: "Update",
                            text: "Error: The image type you chose was invalid",
                            icon: "warning",
                          });
                          </script>
                          ';
                          exit();
                        }else {
                          $imageFullName= $pname."-".$psize."-".uniqid("",true).".".$imgActualExt;

                          $update_details="UPDATE trouser_details SET Size=?,Price=?,Quantity=?,ProductImage=? WHERE TID=? AND Size=?";
                          $stmt=mysqli_stmt_init($conn);
                          if (!mysqli_stmt_prepare($stmt,$update_details)) {
                                echo "Error requesting database";
                          }else {
                            mysqli_stmt_bind_param($stmt, "sddsis", $psize,$pprice,$pquantity, $imageFullName,$pid,$psize);
                            if(!mysqli_stmt_execute($stmt)){
                              echo '<script>
                              swal({
                                title: "Update",
                                text: "Error:There was an error updating. Please try again",
                                icon: "warning",
                              });
                              </script>
                              ';
                              exit();
                              echo "Error updating data: ".mysqli_error($conn);
                            }else {
                               
                                  if(file_exists($oldImage)){
                                    unlink($oldImage);
                                  }else {
                                   echo "file is not present";
                                  }
                                  
                                  $imgPath="../../images/Product_Images/";
                                   move_uploaded_file($image_temp,$imgPath.$imageFullName);


                                   echo '<script>
                                   swal({
                                     title: "Update",
                                     text: "Updated successfully",
                                     icon: "success",
                                   });
                                   </script>
                                   ';
                                   exit();
                            }
                        }

                        }
                      }else{

                                $update_details="UPDATE trouser_details SET Size=?,Price=?,Quantity=? WHERE TID=? AND Size=?";
                                $stmt=mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt,$update_details)) {
                                      echo "Error requesting database";
                                }else {
                                  mysqli_stmt_bind_param($stmt, "sddis", $psize,$pprice,$pquantity,$pid,$psize);
                                  if(!mysqli_stmt_execute($stmt)){
                                    echo '<p id="error">Error updating</p>';
                                    exit();
                                    echo "Error updating data: ".mysqli_error($conn);
                                  }else {
                                       echo '<script>
                                       swal({
                                         title: "Update",
                                         text: "Updated successfully",
                                         icon: "success",

                                       });
                                       </script>

                                       ';
                                  }

                          }
                        }
                      }
                    }
                }
       }

      ?>


  </body>
</html>
