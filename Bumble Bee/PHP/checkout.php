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
          $card_holder=$_POST['card_holder'];



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
            elseif (empty($card_no) || empty($card_holder) || empty($card_ccv) || empty($card_expiry)) {
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
                     $sql="INSERT INTO orders_tbl (CID,DateOfOrder) VALUES (?,?)";
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
                           mysqli_stmt_bind_param($stmt, "is", $_SESSION['customer_id'],$date);

                           if(!mysqli_stmt_execute($stmt)){
                             echo json_encode(array(
                             'response' => 'warning',
                             'message' => 'Sorry there has been an error  ',
                             'title' => 'Oopsies',
                           ));
                             exit();
                             }else{
                               $last_id = mysqli_insert_id($conn);
                               if (isset($_SESSION['cart'])) {
                                 $order_details="INSERT INTO order_details (order_id, product_id,p_size,p_quantity) VALUES ";

                                 $userid = $_SESSION['customer_id'];
                                 $sqli = "SELECT Email FROM customers_tbl WHERE CustomerID = ".$userid." ";  
                                 $results = $conn->query($sqli);
                                 while($row = $results->fetch_assoc()) {
                                 
                                 $useremail= $row["Email"];
                                 
                                 
                                 }
                                 
                                 foreach ($_SESSION['cart'] as $key => $value) {

                                    $order_details .="(".$last_id.",".$value['pid'].",'".$value['p_size']."',".$value['p_quantity']."),";

                                    $total_price = $value['p_quantity'] * $value['p_price'];

                                    $email = $useremail;
    
    
                                    $subject = "Order has been placed | Fashionboys.com";
                                
                                
                                
                                
                                
                                
                                    $html = '<p>Thanks for the opportunity to serve you 24/7 in to your doorstep. we are always expecting to provide convenient place for your online shopping.</p>
                                    <h1>Dear Customer! Your Order Details</h1>
                                    <table style="font-family: arial, sans-serif;
                                      border-collapse: collapse;
                                      width: 100%;">
                                      <thead>
                                      <tr style="background-color: #dddddd;">
                                
                                      <th  style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">Order id</th>
                                
                                      <th  style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">Product Name</th>
                                
                                      <th style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">Product size</th>
                                
                                
                                      <th style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">Quantity</th>

                                      <th style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">Total Price</th>
                                
                                      </tr>
                                      </thead>
                                       <tbody> 
                                    <tr>
                                      <td style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">'.$last_id.'</td>
                                
                                      <td style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">'.$value['p_name'].'</td>
                                
                                      <td style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">'.$value['p_size'].'</td>
                                
                                      <td style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">'.$value['p_quantity'].'</td>

                                      <td style=" border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;">'.$total_price.'</td>
                                
                                
                                
                                      </tr>
                                      </tbody>
                                      </table>
                                    <h3>Customer Support <a href="http://localhost:8070/ecom/ecom5/FRONTEND/Contactpage.php">here</a></h3>';
                                    
                                    
                                    $body = $html;
                                  
                                
                                    $headers = array(
                                        'Authorization: Bearer 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',
                                        'Content-Type: application/json'
                                    );
                                
                                    $data = array(
                                        "personalizations" => array(
                                            array(
                                                "to" => array(
                                                    array(
                                                        "email" => $email,
                                                        
                                                    )
                                                )
                                            )
                                        ),
                                        "from" => array(
                                            "email" => "fashionb639@gmail.com"
                                        ),
                                        "subject" => $subject,
                                        "content" => array(
                                            array(
                                                "type" => "text/html",
                                                "value" => $body
                                            )
                                        )
                                    );
                                
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    $response = curl_exec($ch);
                                    curl_close($ch);
                                
                                    echo $response;






                                 }


                                 

                                 $final = rtrim($order_details,",");

                                 if($result=mysqli_query($conn,$final)){

                                   $delivery_details="INSERT INTO delivery_address (order_id,city,address,appartment,ctc_number) VALUES (?,?,?,?,?)";
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


                                         if(mysqli_stmt_execute($stmt)){
                                           echo json_encode(array(
                                           'response' => 'success',
                                           'message' => 'your order has been placed',
                                           'title' => 'success',
                                         ));
                                         unset($_SESSION['cart']);
                                                   exit();
                                       
                                           // echo "Error placing order: ".mysqli_error($conn);
                                           }
                                           else{
                                             foreach ($_SESSION['cart'] as $key => $value) {
                                               $size=$value['p_size'];
                                               $id=$value['pid'];
                                               $product="SELECT * FROM trouser_details WHERE TID=$id AND Size ='$size'";
                                               $output=mysqli_query($conn, $product);

                                               if ($get= mysqli_fetch_assoc($output)) {
                                                 $newQty=$get['Quantity']-$value['p_quantity'];
                                                 $updateQty="UPDATE trouser_details SET Quantity=$newQty WHERE TID=$id AND Size='$size'";
                                                 if($success=mysqli_query($conn,$updateQty)){
                                                   echo json_encode(array(
                                                     'response' => 'success',
                                                     'message' => 'Your order has been made! And will reach you soon',
                                                     'title' => 'Yay',
                                                   ));
                                                   unset($_SESSION['cart']);
                                                   exit();

                                                 }

                                               }else {
                                                 echo json_encode(array(
                                                   'response' => 'warning',
                                                   'message' => "We're sorry but there was an error. Please retry again",
                                                   'title' => 'Sorry',
                                                 ));
                                                 // echo "err ".mysqli_error($conn);
                                               }


                                             }

                                           }

                                         }
                                 }
                                 else {
                                   // echo "Error saving order details: ".mysqli_error($conn);
                                   echo json_encode(array(
                                   'response' => 'warning',
                                   'message' => 'Error placing order! Please try again',
                                   'title' => 'Sorry',
                                 ));
                                 exit();
                                 }
                               }

                             }//end of inserting order
                         }

          }


  }

 ?>
