<?php session_start(); ?>
<?php
        include("../Includes/connection.php");

      // if (isset($_POST['btn-login'])) {
        $email= mysqli_real_escape_string($conn,$_POST['cust-email']);
        $pwd= mysqli_real_escape_string($conn,$_POST['cust-password']);

        if (empty($email)) {
          echo 'Please enter your email';
          exit();
        }elseif (empty($pwd)) {
          echo 'Please enter your password';
          exit();

        }else {
          $sql = "SELECT * FROM customers_tbl WHERE Email=?";
          $stmt=mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "Error requesting database";
              }else {

                mysqli_stmt_bind_param($stmt, "s", $email);

                mysqli_stmt_execute($stmt);

                $check = mysqli_stmt_get_result($stmt);

                $row= mysqli_fetch_assoc($check);
                $num_rows= mysqli_num_rows($check);
          if ($num_rows<=0) {
            // header("Location:../FRONTEND/LoginandRegister.html?invalid-email");
            echo 'The email you entered is invalid';
            exit();
          }
          else {

                $deHashpwd = password_verify($pwd,$row['Password']);
                if ($deHashpwd==false) {
                  // header("Location:../FRONTEND/LoginandRegister.html?invalid-password");
                  echo 'The password you entered is invalid';
                  exit();
                }elseif ($deHashpwd==true) {
                   
                    $_SESSION['customer_id']=$row['CustomerID'];
                    // header("Location:../FRONTEND/HomePage.php?Logged-in");
                    echo 'log in success';

                }
                mysqli_close($conn);
              }
            }
        }
        // }


 ?>
