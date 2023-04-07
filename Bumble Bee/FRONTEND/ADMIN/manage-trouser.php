<?php
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

    <title>Manage Trouser</title>
<head>
    <link href="https://fonts.googleapis.com/css?family=Arimo|Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat|Kaushan+Script" rel="stylesheet">

</head>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="../../assets/css/argon.css" rel="stylesheet">

    <style >
            .error {
          background: #fdcdcd;
          border: #ecc0c1 1px solid;
        }

        .success {
          background: #c5f3c3;
          border: #bbe6ba 1px solid;
        }


        .col {

          margin-left: 60px;
        }

        .col h1 {
          margin-left: 80px;
        }
    </style>
<body>
  <?php
  require '../../Includes/connection.php' ;

  ?>
<?php if (isset($_SESSION['admin_'])) {
  require '../../Includes/admin.navbar.php';

  ?>


  <div class="container">
    <div class="row">
      <div class="col"><h1>CircleM Admin | Manage Trouser Details</h1>

<center>

          <?php if (isset($_GET['error'])) {
            echo '<div class="col error">';
            if($_GET['error']=="type-already-exists"){

            echo '<p style="margin-top:20px">Error: The product type you entered already exists</p>';

          }elseif ($_GET['error']=="invalid-text") {
              echo '<p style="margin-top:20px">Error: Please use only text ( A - Z )</p>';
            }
          elseif ($_GET['error']=="empty-field") {
              echo '<p style="margin-top:20px">Error: Please fill in all the fields</p>';
            }
          elseif ($_GET['error']=="product-already-exists") {
              echo '<p style="margin-top:20px"> Warning : The product you entered already exists in the database</p>';
            }
          elseif ($_GET['error']=="invalid-file-type") {
              echo '<p style="margin-top:20px"> Warning : The selected file has to be a .PNG image</p>';
            }
            elseif ($_GET['error']=="brand-exists") {
              echo '<p style="margin-top:20px"> Error : The brand you entered already exists in the database</p>';

            }
            elseif ($_GET['error']=="product-already-exists") {
              echo '<p style="margin-top:20px"> Error : The Product you entered already exists in the database</p>';

            }
            echo '</div>';
           }

         ?>

         <?php

         if (isset($_GET['added'])) {
             echo '<div class="col success">';
             echo '<p style="margin-top:20px">New product type ( '.$_GET['type'].' ) added</p>';
             echo '</div>';

           }
         if (isset($_GET['added-brand'])) {
             echo '<div class="col success">';
             echo '<p style="margin-top:20px">New brand ( '.$_GET['brand'].' ) added</p>';
             echo '</div>';

           }
         if (isset($_GET['added-successfully'])) {
             echo '<div class="col success">';
             echo '<p style="margin-top:20px">New product  ( '.$_GET['id'].' ) added</p>';
             echo '</div>';

           }
         if (isset($_GET['products-added-successfully'])) {
             echo '<div class="col success">';
             echo '<p style="margin-top:20px">New product added</p>';
             echo '</div>';

           }

           if (isset($_GET['empty'])) {
             echo '<div class="col error">';
             if ($_GET['empty']=="product-name") {
               echo '<p style="margin-top:20px"> Error : Please fill out the product name </p>';

             }
             elseif ($_GET['empty']=="Flavour") {
               echo '<p style="margin-top:20px"> Error : Please fill out the product flavour </p>';

             }
             elseif ($_GET['empty']=="Brand") {
               echo '<p style="margin-top:20px"> Error : Please select a  product brand </p>';

             }
             elseif ($_GET['empty']=="Product-type") {
               echo '<p style="margin-top:20px"> Error : Please select a  product type </p>';

             }
             elseif ($_GET['empty']=="Description") {
               echo '<p style="margin-top:20px"> Error : Please fill out the product description </p>';

             }
             elseif ($_GET['empty']=="price") {
               echo '<p style="margin-top:20px"> Error : Please fill out the  product price </p>';

             }
             elseif ($_GET['empty']=="size") {
               echo '<p style="margin-top:20px"> Error : Please select a  product size </p>';

             }
             elseif ($_GET['empty']=="quantity") {
               echo '<p style="margin-top:20px"> Error : Please fill out the  product quantity  </p>';

             }
             elseif ($_GET['empty']=="file-empty") {
               echo '<p style="margin-top:20px"> Error : Please select an image </p>';

             }
             elseif ($_GET['empty']=="brandname") {
               echo '<p style="margin-top:20px"> Error : Please fill out the brand name </p>';

             }
             elseif ($_GET['empty']=="ptype") {
               echo '<p style="margin-top:20px"> Error : Please fill out the product type </p>';

             }
             elseif ($_GET['empty']=="ID") {
               echo '<p style="margin-top:20px"> Error : Please select a product </p>';

             }


             echo '</div>';
           }
          ?>
          <div class="w-100"><div id="Logmessage">

          </div></div>
          <div class="col error">
          </div>
</center>


      <div class="w-100"></div>
      <div class="col">

          <div class="nav-wrapper">
          <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2">
                  </i>Add new Trouser</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-badge mr-2">
                  </i>Add new brands</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-ungroup mr-2">
                  </i>Add new Trouser types</a>
              </li>
              

          </ul>
        </div>


        <!--add new trouser -->
        <div class="card shadow">
          <div class="card-body">
            <div class="tab-content" id="myTabContent">

              <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                <form  class="" method="post" action="../../PHP/ADMIN/admin.add-trouser.php" enctype="multipart/form-data" id="Addproduct-form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="productName" placeholder="Trouser name..." class="form-control form-control-alternative" id="exampleFormControlInput1">

                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <textarea name="productDesc" placeholder="Trouser Description..." class="form-control form-control-alternative" id="exampleFormControlInput1"></textarea>

                      </div>

                    </div>



                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="productType" class="form-control form-control-alternative" id="exampleFormControlInput1">
                          <option value=0>Select Trouser type:</option>
                          <?php
                          $sql= "SELECT * FROM trouser_type";
                          $records= mysqli_query($conn, $sql);

                          while($row= mysqli_fetch_array($records))
                          {
                            echo '<option value="'.$row['PTID'].'">'.$row['TrouserType'].'</option>';
                          }

                          ?>

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">

                        <select name="productBrand" class="form-control form-control-alternative" id="exampleFormControlInput1">
                          <option value=0>Select Trouser brand:</option>

                          <?php
                          $sql= "SELECT * FROM product_brands";
                          $records= mysqli_query($conn, $sql);

                          while($row= mysqli_fetch_array($records))
                          {
                            echo '<option value="'.$row['BrandID'].'">'.$row['BrandName'].'</option>';
                          }

                          ?>

                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="productSize" class="form-control " id="exampleFormControlInput1">
                          <option value="Small">Small</option>
                          <option value="Medium">Medium</option>
                          <option value="Large">Large</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">

                        <input type="number" name="productPrice"  placeholder="Price" min="1" class="form-control form-control-alternative" id="exampleFormControlInput1">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="number" name="productQuantity"  placeholder="Quantity" min="1" class="form-control form-control-alternative" id="exampleFormControlInput1">


                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <input type="file" name="PimgSelector" class="form-control"><br>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-success" name="btnAddproduct" id="btnAddproduct">Add</button>
                    </div>
                  </div>
                </form>

<div class="col">
  <div class="col-md-6">
    <?php
    $num_of_products="SELECT * FROM trouser_tbl";
    $result = mysqli_query($conn,$num_of_products);
    echo '<h3>'.mysqli_num_rows($result). ' Products avaiable</h3>';
    ?>
  </div>
  <div class="table-responsive" style="max-height:80vh; overflow:scroll;">
    <table class="table align-items-center table-dark" style="position:relative;">
      <thead class="thead-dark" >
        <tr style="position:sticky;">
          <th scope="col">Trouser Name</th>
          <th scope="col">Type</th>
          <th scope="col">Brand</th>
          <th scope="col">Details</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php

        $products= "SELECT * FROM trouser_tbl";

        $records= mysqli_query($conn, $products);

        while($row= mysqli_fetch_array($records))
        {

          ?>
          <tr>
            <td scope="row">
              <div class="media-body">
                <?php
                echo '<form action="edit-products.php" method="post" >';
                echo '<span class="mb-0 text-sm">'.$row['TrouserName'].'</span>';
                echo "<input type=hidden name=pname_ value='".$row['TrouserName']."'>";
                echo "<input type=hidden name=pid_ value='".$row['Trouser_id']."'>";

                ?>
              </div>
            </td>
            <td>
              <?php

              $ptype= "SELECT * FROM trouser_type WHERE PTID= ".$row['TrouserType'].";";
              $product_tp_rec= mysqli_query($conn, $ptype);
              if ($product_type_row= mysqli_fetch_array($product_tp_rec)) {
                echo '<span class="mb-0 text-sm">'.$product_type_row['TrouserType'].'</span>';
                echo "<input type=hidden name=ptype_ value='".$product_type_row['TrouserType']."'>";

              }
              ?>

            </td>
            <td>
              <?php

              $pbrands= "SELECT * FROM product_brands WHERE BrandID=".$row['Brand'].";";
              $product_br_rec= mysqli_query($conn, $pbrands);
              if ($product_brand_row= mysqli_fetch_array($product_br_rec)) {
                echo '<span class="mb-0 text-sm">'.$product_brand_row['BrandName'].'</span>';
                echo "<input type=hidden name=pbrand_ value='".$product_brand_row['BrandName']."'>";


              }
              ?>

            </td>
            <td>
              <div class="d-flex align-items-center">
                <?php
                echo "<table>";
                  $product_details= "SELECT * FROM Trouser_details WHERE TID=".$row['Trouser_id'].";";
                  $product_dt_rec= mysqli_query($conn, $product_details);
                  while ($product_details_row= mysqli_fetch_array($product_dt_rec)) {
                    $imgPath="../../images/Product_Images/";
                    echo '<td><span class="mb-0 text-sm">'.$product_details_row['Size'].'</span></td>';
                    // echo '<td><img src="../../images/Product_Images/'.$product_details_row['ProductImage'].'" width="auto" height="100px"></td>';
                    echo "<input type=hidden name=pimage_ value='".$product_details_row['ProductImage']."'>";
                    echo "<input type=hidden name=psize_ value='".$product_details_row['Size']."'>";

                    ?>

                  </div>
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?php
                      echo '<a class="dropdown-item" name="edit_products" href="edit-trousers.php?action=edit&productid='.$row['Trouser_id'].'&size='.$product_details_row['Size'].'">Edit</a>';
                      echo '<a class="dropdown-item" name="delete_products" href="edit-trousers.php?action=delete&productid='.$row['Trouser_id'].'&size='.$product_details_row['Size'].'">Delete</a>';



                    }
                    echo "</table>";

                    ?>

                  </div>
                </div>
              </td>
              <?php

              echo "</form>";
            }

            ?>
          </tr>

        </tbody>
      </table>
    </div>
  </div>

</div>



<!--add brands --->
      <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
        <form class="" action="../../PHP/admin.add-brands.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="brand-name" placeholder="Enter brand name.." class="form-control " id="exampleFormControlInput1">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="file" name="imgSelector"  class="form-control form-control-alternative" id="exampleFormControlInput1">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <button type="submit"  class="btn btn-success" name="new-brand-btn">Add</button>
              </div>
            </div>
          </form>
</div>
</div>


<!--add trouser type --->
      <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
        <form class="" action="../../PHP/ADMIN/admin.add-ttypes.php" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="product-type" placeholder="Enter catorgory.." class="form-control form-control-alternative" id="exampleFormControlInput1">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <button type="submit" class="btn btn-success" name="add-ptype">Add</button>
              </div>
            </div>
          </form>

        </div>
      </div>


    




</div>


</div>
</div>
</div>
</div>
</div>
</div>
</div>

    <!-- Core -->
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS -->
<script src="../../assets/js/argon.min.js"></script>

<?php }
elseif (!isset($_SESSION['admin_'])) {

  header("location:index.php");
}

   ?>



  </body>
</html>
