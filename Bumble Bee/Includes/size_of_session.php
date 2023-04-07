<?php
session_start();
$session_size=null;
$loggedIn='false';
if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $key => $value) {
    $value['p_quantity'] =
    $value['p_quantity'] +   $value['p_quantity'] ;
  if($value['p_quantity']>=1){
    $session_size="true";
  }else {
    $session_size="false";
  }
  }
}


    if (isset($_SESSION['customer_id'])) {
      $loggedIn="true";
    }
    echo json_encode(array(
        'size' => $session_size,
        'status' => $loggedIn,
    ));
?>
