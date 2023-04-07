<?php
include '../../Includes/connection.php';
session_start();

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../CSS/Snackbar.css">
    <link rel="stylesheet" href="../../CSS/ADMIN/login.admin.css">
  </head>
  <body>
    <div id="snackbar">Some text some message..</div>

    <div class="main">
      <form class="login-form" method="post">
        <h2>ADMIN LOGIN</h2>
        <input type="text" placeholder="Username" name="username_admin" id="username_admin">
        <input type="password" placeholder="Password" name="pwd_admin" id="pwd_admin">
        <center><button name="Login">Login</button></center>
        
      </form>

    </div>

    <?php

    if (isset($_POST['Login'])) {
      $username=  $_POST['username_admin'];
      $pwd=  $_POST['pwd_admin'];
        if (empty($username) ) {
        echo '<script> var x = document.getElementById("snackbar");
            x.className = "show";
            x.innerHTML = "Please enter your Username";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            </script>';
        }
        if ( empty($pwd)) {
        echo '<script> var x = document.getElementById("snackbar");
            x.className = "show";
            x.innerHTML = "Please enter your password";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            </script>';
        }

        else {
          $sql = "SELECT * FROM admin_tbl WHERE AdminID=?";
          $stmt=mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "Error requesting database";
              }else {

                mysqli_stmt_bind_param($stmt, "s", $username);

                mysqli_stmt_execute($stmt);

                $check = mysqli_stmt_get_result($stmt);

                $row= mysqli_fetch_assoc($check);

                print_r($row);
          if ($row<0) {
            echo '<script> var x = document.getElementById("snackbar");
                x.className = "show";
                x.innerHTML = "Invalid Username";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

                document.getElementById("pwd_admin").style.borderColor="red";</script>';

            exit();
          }
          else {

              $deHashpwd = password_verify($pwd,$row['Password']);
                if ($deHashpwd==false) {
                  echo '<script> var x = document.getElementById("snackbar");
                      x.className = "show";
                      x.innerHTML = "Invalid password";
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

                      document.getElementById("pwd_admin").style.borderColor="red";</script>';

                  exit();
                }elseif ($deHashpwd==true) {
                  $DATE= date('Y-m-d H:i:s');
                    $sql = "UPDATE admin_tbl SET LastLogDate='$DATE' WHERE AdminID='$username'";
                    mysqli_query($conn,$sql);
                   $_SESSION['admin_']=$row['AdminID'];
                  header("Location:manage-products.php?Logged-in");

                }
              }
        }
    }
  }
      ?>
  </body>
</html>
