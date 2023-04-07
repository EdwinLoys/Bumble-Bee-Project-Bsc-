<?php
require '../../Includes/connection.php';

if (isset($_POST['process-order'])) {
  $order_id=  $_POST['order_id'];
  $sql="UPDATE orders_tbl SET OrderStatus='Processed' WHERE Order_id=".$order_id;

  if(mysqli_query($conn, $sql)){
    header("Location:../../FRONTEND/ADMIN/ManageOrders.php?Order=processed");
  }else {
    echo mysqli_error($conn);
  }


}
