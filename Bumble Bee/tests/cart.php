<?php session_start(); $conn=mysqli_connect("localhost","root","","test");

 if (isset($_POST['add-cart'])) {

     if (isset($_SESSION['cart'])) {
       //get the existing cart id's
       $cart_array_id = array_column($_SESSION['cart'],'pid');

       //check if the new product is in the cart already
           if (!in_array($_GET['id'],$cart_array_id)) {
             $cart_array= array(
               'pid' => $_GET['id'],
               'p_name' => $_POST['name'],
               'p_price' => $_POST['price'],
               'p_quantity' => $_POST['quantity'],
               'p_img' => $_POST['img']
             );
            array_push($_SESSION['cart'],  $cart_array);
           }
           else {
                 // foreach ($_SESSION['cart'] as $keys => $value) {
                 //   if ($value['pid']==$_GET['id']) {
                 //
                 //     $cart_array= array(
                 //       'pid' => $_GET['id'],
                 //       'p_name' => $_POST['name'],
                 //       'p_price' => $_POST['price'],
                 //       'p_quantity' => $_POST['quantity'],
                 //        'p_img' => $_POST['img']
                 //     );
                 //     //print_r ($_SESSION['cart'][$keys]);
                 //     //print_r ($cart_array);
                 //
                 //    unset($_SESSION['cart'][$keys]);
                 //    array_push($_SESSION['cart'],  $cart_array);

              // }
            // }
           }
     }
  // if there is no  cart then this happens
     else {
       $cart_array= array(
         'pid' => $_GET['id'],
         'p_name' => $_POST['name'],
         'p_price' => $_POST['price'],
         'p_quantity' => $_POST['quantity'],
          'p_img' => $_POST['img']
       );

        $_SESSION['cart'][0]=  $cart_array;
     }
 }

//delete a product from the cart
 if (isset($_GET['action'])) {
   if ($_GET['action']=="delete") {
     foreach ($_SESSION['cart'] as $keys => $value) {
       if ($value['pid']==$_GET['id']) {
         unset($_SESSION['cart'][$keys]);
         header("Location:cart.php?action=deleted&id=".$_GET['id']."");
       }
     }
   }elseif ($_GET['action']=="inc") {
     foreach ($_SESSION['cart'] as $key => $value) {
      if ($value['pid']==$_GET['id']) {
        $arr=$_SESSION['cart'][$key];

        $qinc=$arr['p_quantity']+1;
        $cart_array= array(
          'pid' => $_GET['id'],
          'p_name' =>$arr['p_name'],
          'p_price' => $arr['p_price'],
          'p_quantity' => $qinc,
           'p_img' => $arr['p_img']
        );
        $_SESSION['cart'][$key]=$cart_array;
      }
     }
   }elseif ($_GET['action']=="remove") {
     foreach ($_SESSION['cart'] as $key => $value) {
      if ($value['pid']==$_GET['id']) {
        $arr=$_SESSION['cart'][$key];

        if ($arr['p_quantity']>=2) {
            $qinc=$arr['p_quantity']-1;

            $cart_array= array(
              'pid' => $_GET['id'],
              'p_name' =>$arr['p_name'],
              'p_price' => $arr['p_price'],
              'p_quantity' => $qinc,
               'p_img' => $arr['p_img']
            );
            $_SESSION['cart'][$key]=$cart_array;
        }else{
          unset($_SESSION['cart'][$key]);
        }


      }
     }
   }
 }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <link rel="stylesheet" href="css.css">
  <body>
      <div class="container">
        <?php
            $sql= "select * from products";
            $res=mysqli_query($conn,$sql);
              if (mysqli_num_rows($res)>0) {
                while($row=mysqli_fetch_assoc($res)){
                  echo '<div class="products">
                            <form class="" action="cart.php?action=add&id='.$row["product_id"].'" method="post">
                                <img src="'.$row['product_image'].'" alt="">
                                <h3>'.$row['product_name'].'</h3>
                                <h3> Rs.'.$row['product_price'].'</h3>
                                <input type="hidden" name="quantity" value="1" min="1">
                                <input type="hidden" name="id" value="'.$row['product_id'].'">
                                <input type="hidden" name="img" value="'.$row['product_image'].'">
                                <input type="hidden" name="name" value="'.$row['product_name'].'">
                                <input type="hidden" name="price" value="'.$row['product_price'].'">
                                <button type="submit" name="add-cart"> ADD TO CART</button>
                            </form>
                        </div>';
                }
              }
         ?>
      </div>

      <div class="cart">
          <table>
            <tr>
              <th></th>
              <th>Name</th>
              <th></th>
              <th>Quantity</th>
              <th></th>
              <th>Price</th>
              <th>Total</th>
              <th>action</th>
            </tr>
            <form class="" action="checkout.php?action=checkout" method="post">
            <tr>
              <?php
                if (!empty($_SESSION['cart'])) {
                  $tot=0;
                  foreach ($_SESSION['cart'] as $keys => $value) {
                    echo '<td><img src="'.$value['p_img'].'" alt=""></td>';
                  echo '<td>'.$value['p_name'].'</td>';
                  echo '<td><a href="cart.php?action=inc&id='.$value['pid'].'">+</a></td>';
                  echo '<td>'.$value['p_quantity'].'</td>';
                  echo '<td><a href="cart.php?action=remove&id='.$value['pid'].'">-</a></td>';
                  echo '<td>'.$value['p_price'].'</td>';
                  echo '<td>'.number_format($value['p_quantity']*$value['p_price'],2).'</td>';
                  echo '<td><a href="cart.php?action=delete&id='.$value['pid'].'">Delete</a></td>';
               ?>
               </tr>
               <tr>
                 <?php
                    $tot+=$value['p_quantity']*$value['p_price'];
                  }
                  ?>
                  <td>Total:</td>
                  <td>
                  <?php
                  echo "<td></td>";
                  echo "<td></td>";
                    echo '<td>'.number_format($tot,2).'</td>';
                    echo '<td><input type="hidden" name="tot" value="'.number_format($tot,2).'"</td>';
                  }
                  else {
                    echo '<p>Cart is empty</p>';
                  }
                  ?></td>
                  <td><input type="submit" value="submit" name="checkout"></td>

               </tr>
               </form>
          </table>
      </div>
  </body>
</html>
