<?php
  session_start();
  require '../Includes/connection.php';


  if (isset($_POST['action']) && $_POST['action']=="place-order") {

          $fname=$_POST['fname'];
          $lname=$_POST['lname'];
          $address=$_POST['address'];
          $city=$_POST['city'];
          $ctc_num=$_POST['contact_num'];
          $appartment=$_POST['appartment'];
          $card_no=$_POST['card_no'];
          $card_ccv=$_POST['card_ccv'];
          $card_expiry=$_POST['card_expiry'];
          $package_details=[];
          if(!empty($_SESSION['package_cart']))
          {
            foreach($_SESSION['package_cart'] as $keys => $values)
            {
              $package_details=array(
                'package_id'=>$values['package_id'],
                'name'=>$values['name'],
                'notes'=>$values['note']
              );
            }

          }


          //validation
            if (empty($fname)) {
                  echo json_encode(array(
                  'response' => 'warning',
                  'message' => 'Cannot leave firstname empty',
                  'title' => 'Oopsies',
                ));
                exit();
            }
            elseif (empty($lname)) {
                  echo json_encode(array(
                  'response' => 'warning',
                  'message' => 'Cannot leave lastname empty',
                  'title' => 'Oopsies',
                ));
                exit();

            }
            elseif (empty($address)) {
                  echo json_encode(array(
                  'response' => 'warning',
                  'message' => 'Cannot leave address empty',
                  'title' => 'Oopsies',
                ));
                exit();

            }
            elseif (empty($city)) {
                  echo json_encode(array(
                  'response' => 'warning',
                  'message' => 'Cannot leave city empty',
                  'title' => 'Oopsies',
                ));
                exit();

            }
            elseif (empty($card_no) ||  empty($card_ccv) || empty($card_expiry)) {
                  echo json_encode(array(
                  'response' => 'warning',
                  'message' => 'Please fill out the payment details',
                  'title' => 'Oopsies',
                ));
                exit();

            }
            elseif(!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/",$lname) || !preg_match("/^[a-zA-Z]*$/", $city) ){
              echo json_encode(array(
              'response' => 'warning',
              'message' => 'You entered invalid text',
              'title' => 'Oopsies',
            ));
            exit();
          }
          else {

                     $date=date('Y:m:d');
                     $sql="INSERT INTO package_orders (package_id,CID,Name, Notes,DateOfOrder) VALUES (?,?,?,?,?)";
                     $stmt=mysqli_stmt_init($conn);

                         if (!mysqli_stmt_prepare($stmt,$sql)) {
                               echo json_encode(array(
                               'response' => 'warning',
                               'message' => 'Sorry there has been an error',
                               'title' => 'Oopsies',
                             ));
                             // echo "Error placing order: ".mysqli_error($conn);
                         }
                         else {

                           mysqli_stmt_bind_param($stmt, "iisss",$package_details['package_id'],$_SESSION['customer_id'], $package_details['name'],$package_details['notes'],$date);

                           if(!mysqli_stmt_execute($stmt)){
                             echo json_encode(array(
                             'response' => 'warning',
                             'message' => 'Sorry there has been an error  ',
                             'title' => 'Oopsies',
                           ));
                             exit();
                             }
                             else{
                                $last_id = mysqli_insert_id($conn);
                               $delivery_details="INSERT INTO delivery_address (package_order_id,city,address,appartment,ctc_number) VALUES (?,?,?,?,?)";
                               $stmt=mysqli_stmt_init($conn);

                                   if (!mysqli_stmt_prepare($stmt,$delivery_details)) {
                                     echo json_encode(array(
                                     'response' => 'warning',
                                     'message' => 'Sorry there has been an error',
                                     'title' => 'Oopsies',
                                   ));
                                   exit();
                                   }else {
                                     mysqli_stmt_bind_param($stmt, "isssi",$last_id,$city,$address,$appartment,$ctc_num);


                                     if(!mysqli_stmt_execute($stmt)){
                                       echo json_encode(array(
                                       'response' => 'warning',
                                       'message' => 'Sorry there has been an error placing',
                                       'title' => 'Oopsies',
                                     ));
                                     exit();
                                       // echo "Error placing order: ".mysqli_error($conn);
                                       }
                                       else{
                                         if (isset($_SESSION['package_cart'])) {
                                           unset($_SESSION['package_cart']);
                                         }
                                         echo json_encode(array(
                                         'response' => 'success',
                                         'message' => 'Your order has been placed successfully! And will be at your doorsteps soon',
                                         'title' => 'yay',
                                       ));
                                         exit();
                                       }

                                     }

                         }

          }


  }
}

 ?>
