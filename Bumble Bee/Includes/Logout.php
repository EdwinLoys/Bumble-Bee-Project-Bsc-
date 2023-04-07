<?php

if (isset($_POST['admin-logout'])) {
  session_start();
 unset($_SESSION['admin_']);

 header("Location:../FRONTEND/ADMIN/index.php");
}
elseif(isset($_POST['action']) && $_POST['action']=="logout") {

  session_start();
  unset($_SESSION['customer_id']);
// echo 'hi';
 // header("Location:../FRONTEND/HomePage.php?Logged-out");
}


 ?>
