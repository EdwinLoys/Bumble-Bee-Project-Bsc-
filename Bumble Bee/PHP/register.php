<?php
        include("../Includes/connection.php");
        session_start();
    // if (isset($_POST['btn-register'])) {
              $fname= mysqli_real_escape_string($conn,$_POST['customer-fname']);
              $lname= mysqli_real_escape_string($conn,$_POST['customer-lname']);
              $mail= mysqli_real_escape_string($conn,$_POST['customer-email']);
              $city= mysqli_real_escape_string($conn,$_POST['customer-city']);
              $streetAddress= mysqli_real_escape_string($conn,$_POST['customer-street']);
              $pwd= mysqli_real_escape_string($conn,$_POST['customer-password']);
              $re_pwd= mysqli_real_escape_string($conn,$_POST['customer-confirm-pass']);

        // Error handlers and validations
          if (empty($fname) || empty($lname) || empty($city) || empty($mail) || empty($pwd) || empty($re_pwd) || empty($streetAddress)) {
                  echo 'Empty fields';
                  exit();
                        }else {
                          if (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
                                echo 'Invalid text';
                                exit();

                              }else {
                                    $sql = "SELECT * FROM customers_tbl WHERE Email=?";
                                    //prepared statement
                                    $stmt=mysqli_stmt_init($conn);

                                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                                              echo "Error requesting database";
                                        }else {
                                          // Bind  parameters to the placeholder
                                          mysqli_stmt_bind_param($stmt, "s", $mail);
                                          //run parasm inside database
                                          mysqli_stmt_execute($stmt);
                                          $check = mysqli_stmt_get_result($stmt);
                                          $row= mysqli_fetch_assoc($check);
                                    if ($row>1) {
                                      echo 'Email already exists';
                                      exit();
                                    }else {
                                      $uppercase = preg_match('@[A-Z]@', $pwd);
                                      $lowercase = preg_match('@[a-z]@', $pwd);
                                      $number    = preg_match('@[0-9]@', $pwd);
                                      $specialChars = preg_match('@[^\w]@', $pwd);

                                      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pwd) < 8) {

                                          echo 'Password not strong';
                                          exit();
                                        }else {
                                            if ($re_pwd!=$pwd) {
                                            echo 'Passwords dont match';
                                            exit();
                                          }else {
                                            if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$mail)){
                                            echo 'Invalid Mail';
                                            exit();
                                            }
                                              else {
                                                $hashPassword = password_hash($pwd, PASSWORD_DEFAULT);

                                                $register = "INSERT INTO customers_tbl(Firstname , Lastname, Email,Password, City, StreetAddress)
                                                VALUES(?,?,?,?,?,?);";

                                                $stmt=mysqli_stmt_init($conn);

                                                    if (!mysqli_stmt_prepare($stmt,$register)) {
                                                          echo "Error SQL";
                                                    }else {
                                                      mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname,$mail,$hashPassword,$city,$streetAddress);


                                                      if(!mysqli_stmt_execute($stmt)){
                                                        //header("Location:../FRONTEND/LoginandRegister.html?Error-registering");
                                                        //exit();
                                                        echo "Error inserting data: ".mysqli_error($conn);
                                                        }else{
                                                          
                                                          echo 'Account created! Go to shopping';
                                                          exit();
                                                        }
                                                    }

                                                  mysqli_close($conn);
                                              }
                                            }
                                          }
                                        }
                                      }
                                    }

                    }
    //             }
 ?>
