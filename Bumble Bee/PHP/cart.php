<?php
include '../Includes/connection.php';
session_start();

 ?>

<?php

if (isset($_POST['action']) && $_POST['action']=="add-to-cart") {

    if (isset($_SESSION['cart'])) {
      //get the existing cart id's
      $cart_array_id = array_column($_SESSION['cart'],'pid');

      //check if the new product is in the cart already
          if (!in_array($_POST['id'],$cart_array_id)) {
            $cart_array= array(
              'pid' => $_POST['id'],
              'p_size' => $_POST['size'],
              'p_name' => $_POST['name'],
             
              'p_price' => $_POST['price'],
              'p_quantity' => $_POST['quantity'],
               'p_img' => $_POST['img']
            );
           array_push($_SESSION['cart'],  $cart_array);
          }
          else {
            foreach($_SESSION['cart'] as $keys => $values)
            {
              if($_SESSION['cart'][$keys]['pid'] == $_GET['id'])
              {
                $_SESSION['cart'][$keys]['p_quantity'] =
                $_SESSION['cart'][$keys]['p_quantity'] + $_POST["quantity"];
              }
            }
          }
        }

 // if there is no  cart then this happens
    else {
      $cart_array= array(
        'pid' => $_POST['id'],
        'p_size' => $_POST['size'],
        'p_name' => $_POST['name'],
        
        'p_price' => $_POST['price'],
        'p_quantity' => $_POST['quantity'],
         'p_img' => $_POST['img']
      );

        $_SESSION['cart'][0]=  $cart_array;
    }
}

//delete a product from the cart
if (isset($_POST['action'])) {
  if ($_POST['action']=="delete") {
    foreach ($_SESSION['cart'] as $keys => $value) {
      if ($value['pid']==$_POST['id']) {
        unset($_SESSION['cart'][$keys]);
        header("Location:cart.php?action=deleted&id=".$_POST['id']."");
      }
    }
  }
//increase a product in the cart
  elseif ($_POST['action']=="inc") {
    foreach ($_SESSION['cart'] as $key => $value) {
     if ($value['pid']==$_POST['id']) {
       $arr=$_SESSION['cart'][$key];
       // echo '<pre>';
       // print_r($arr);
       $qinc=$arr['p_quantity']+1;
       $cart_array= array(
         'pid' => $_POST['id'],
         'p_size' => $_POST['size'],
         'p_name' => $_POST['name'],
         
         'p_price' => (int)$_POST['price'],
         'p_quantity' => (int)$qinc,
          'p_img' => $_POST['img']
       );

       // echo '<pre>';
       // print_r($cart_array);
       $_SESSION['cart'][$key]=$cart_array;
     }
    }
  }
  //Removes a product in the cart

  elseif ($_POST['action']=="remove") {
    foreach ($_SESSION['cart'] as $key => $value) {
     if ($value['pid']==$_POST['id']) {
       $arr=$_SESSION['cart'][$key];

       if ($arr['p_quantity']>=2) {
           $qdec=$arr['p_quantity']-1;

           $cart_array= array(
             'pid' => $_POST['id'],
             'p_size' => $_POST['size'],
             'p_name' => $_POST['name'],
             'p_price' => $_POST['price'],
             'p_quantity' => $qdec,
              'p_img' => $_POST['img']
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
