<?php
  require '../../Includes/connection.php';
  if (isset($_POST['add-ptype'])) {
      $ptype=mysqli_real_escape_string($conn,$_POST['product-type']);

      if (empty($ptype)) {
        
          header("Location:../../FRONTEND/ADMIN/manage-products.php?error=empty-text");
          exit();
          
        }else {
              $sql = "SELECT * FROM shirt_type WHERE ProductType=?";
             
              $stmt=mysqli_stmt_init($conn);
              
                  if (!mysqli_stmt_prepare($stmt,$sql)) {
                        echo "Error requesting database";
                  }else {
                      
                    mysqli_stmt_bind_param($stmt, "s", $ptype);
                      
                    mysqli_stmt_execute($stmt);
                    $check = mysqli_stmt_get_result($stmt);
                    $row= mysqli_fetch_assoc($check);
                    if ($row>1) {
                      header("Location:../../FRONTEND/ADMIN/manage-products.php?error=type-already-exists");
                      exit();
                    }else {
                    $sql= "INSERT INTO shirt_type (ProductType) VALUES (?)";
                    $stmt = mysqli_stmt_init($conn);
                    $stmt=mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                          echo "Error SQL";
                    }else {
                      mysqli_stmt_bind_param($stmt, "s", $ptype);


                      if(!mysqli_stmt_execute($stmt)){
                        header("Location:../../FRONTEND/ADMIN/manage-products.php?error=failed-to-add");

                        exit();
                        echo "Error inserting data: ".mysqli_error($conn);
                        }else{
                            header("Location:../../FRONTEND/ADMIN/manage-products.php?added&type=".$ptype);
                        }
                    }

                  mysqli_close($conn);
              }
          }
        }
      }
   


 ?>
